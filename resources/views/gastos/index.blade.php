@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">GASTOS</li>  
@endsection

@section('content')


@php
use App\Mobile_Detect;

$dete= new Mobile_Detect();
$iconsize=  $dete->isMobile() ? "": "fa-lg";

echo link_to('gasto', $title = "AGREGAR", $attributes = [ "class"=>"btn btn-sm btn-success" ,  "data-toggle"=>"modal", "data-target"=>"#showform", "onclick"=> "mostrar_form(event)"], $secure = null);
 
@endphp
 

  <!--MANDAR A IMPRIMIR -->
<a  href="<?= url("rep-gastos")?>" data-toggle="modal" data-target="#show_opc_rep" onclick="mostrar_informe(event)" style="color:black;" > <i class="mr-2 ml-2 fa fa-print {{$iconsize}}" aria-hidden="true"></i></a>



<form id="gastos-search" action="<?=url("grillgastos")?>" method="post"  onsubmit="actualizar_grill_parametros(event)">
  <!--Parametros de fecha --> 
<div class="row">
<div class="col-2 col-sm-1 col-md-2  col-lg-1">
<span style="font-size: 10pt; font-weight: 600;">Desde:</span> 
</div>
  <div class="col-10 col-sm-4 col-md-4 col-lg-2">
  <input class="form-control form-control-sm" type="date" id="Desde" name="Desde"> 
  </div>

  <div class="col-2 col-sm-1 col-md-2 col-lg-1">
  <span style="font-size: 10pt; font-weight: 600;">Hasta: </span>
</div>

<div class="col-10 col-sm-4 col-md-4 col-lg-2">
 <input class="form-control form-control-sm"  type="date" id="Hasta" name="Hasta">
  </div>
  <div class="col-6 col-sm-2 col-md-3 col-lg-1 d-flex">
 <button type="submit" class="btn btn-sm btn-info">BUSCAR</button>
  </div>
</div>
</form>

<div id="grilla">
@include("gastos.grilla")
</div>


<div id="showform" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" id="viewform">
      
    </div>
  </div>
</div>


 
<!-- MODAL TIPO DE INFORME -->
<div id="show_opc_rep" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" >
    <a  id="info-xls" onclick="callToXlsGen(event, '{{$TITULO}}')" class="btn btn-sm btn-info" href="#" ><i class="fa fa-file-excel-o fa-2x" aria-hidden="true"></i> <h3>EXCEL</h3></a>
   
    <a  id="info-pdf"  class="btn btn-sm btn-info" href="#"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i><h3>PDF</h3></a>
    <a  id="info-print" class="btn btn-sm btn-info" href="#"><i class="fa fa-print fa-2x" aria-hidden="true"></i><h3>Printer</h3></a>
    </div>
  </div>
</div>
    
@endsection


<script>


/**REPORTE */ 

function mostrar_informe(ev){
    ev.preventDefault();
    let pdf= ev.target.action+"/pdf";
    let xls= ev.target.action+"/xls";
   // ajaxCall(, "#grilla", function(resu){ $("#grilla").html( resu)  ; } );
   
     $("#info-xls").attr("href", xls );
     $("#info-pdf").attr("href", pdf  ); 
  }



/**VALIDACIONES */
    
function solo_numero(ev){
   
    if( ev.data.charCodeAt() < 48 || ev.data.charCodeAt() > 57){ 
      ev.target.value= 
      ev.target.value.substr( 0, ev.target.selectionStart-1) + 
      ev.target.value.substr( ev.target.selectionStart ); 
    } 
    let val_Act= ev.target.value;  
  val_Act= val_Act.replaceAll( new RegExp(/[\.]*[,]*/), ""); 
    let enpuntos= new Intl.NumberFormat("de-DE").format( val_Act);
		$( ev.target).val(  enpuntos);
	} 



//Recibe: Un campo de tipo numerico
//Efecto: Da formato de puntos al valor del campo
function numero_con_puntuacion( obj ) {
    let val_Act= obj.value;  
    let enpuntos= new Intl.NumberFormat("de-DE").format( val_Act);
		$(obj).val(  enpuntos);
   }

  function quitarSeparador( ele){ 
 ele.value=  ele.value.replaceAll("[.]", "");
}


function mostrar_form(ev){
let divname= "#viewform";
  $.ajax(
       {
         url:  ev.currentTarget.href, 
         beforeSend: function(){
           $( divname).html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
         },
         success: function(res){  $(divname).html(  res );
         },
         error: function(){
           $( divname).html(  "<h6 style='color:red;'>Problemas de conexión</h6>" ); 
         }
       }
     );
}
    

function jsonReceiveHandler( data, divname){// string JSON to convert     div Html Tag to display errors
  try{
             let res= JSON.parse( data);
             if( "error" in res){
               $( divname).html(  `<h6 style='color:red;'>${res.error}</h6>` ); return false; 
             }else{   return res;  }
           }catch(err){
             $(divname).html(  `<h6 style='color:red;'>${err}</h6>` );  return false;
           } return false;
}/***End Json Receiver Handler */

function borrar(ev){
    ev.preventDefault();
if( !confirm("SEGURO QUE DESEA BORRARLO?") ) return;
let divname= "#viewform";
  $.ajax(
       {
         url:  ev.currentTarget.href, 
         beforeSend: function(){
           $( divname).html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
         },
         success: function(res){  
            let r= jsonReceiveHandler( res );
                      if( typeof r != "boolean"){
                          if( "error" in r) alert( r.error);
                          else{ 
                            alert("CUENTA BORRADA.");
                            $("#"+r.IDNRO).remove();
                            }
                      }/************* */
         },
         error: function(){
           $( divname).html(  "<h6 style='color:red;'>Problemas de conexión</h6>" ); 
         }
       }
     );
}


function actualizar_grill(){
  $.ajax({
    url: "<?=url("grillgastos")?>",
    beforeSend: function(){  $("#grilla").html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" )},
    success: function(resu){ $("#grilla").html( resu)  ; },
    error: function(){$("#grilla").html( "<h6>Error al recuperar datos</h6>")  ;}
  })
}


function actualizar_grill_parametros(e){ 
  e.preventDefault(); 
  ajaxCall(e, "#grilla", function(resu){ $("#grilla").html( resu)  ; } );
}


 
function ajaxCall( e, divnam, succes){

  let urL= e;
  if( typeof e == "object")  urL= e.target.action;
  let divname=divnam;
  $.ajax(
       {
         url:  urL,
         method: "post",
         data: $("#"+e.target.id).serialize(),
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
         beforeSend: function(){
           $( divname).html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
         },
         success: succes,
         error: function(){
           $( divname).html(  "<h6 style='color:red;'>Problemas de conexión</h6>" ); 
         }
       }
     );
}
function guardar( ev ){//Objeto event   DIV tag selector to display   success handler
ev.preventDefault();
if( $("#gastosform input[name=IMPORTE]").val()==""){ alert("INGRESE EL IMPORTE!"); return;}
//quitar formato
$("#gastosform .number-format").each( function( indice, obj){    quitarSeparador( obj); } );


 ajaxCall( ev, "#mensaje", function(res){
            $( "#mensaje").html(JSON.parse(res).ok ); 
    
            actualizar_grill();
            //recuperar formato
          $("#gastosform .number-format").each( function( indice, obj){    numero_con_puntuacion( obj); } );

         });
}/*****end ajax call* */

  
function setDefaultDate(){
        //fechas por defecto
        if( $("input[type=date]").val() == "" )
        {
            let FeCha= new Date();
            let mes= (FeCha.getMonth()+1) <10 ?  "0".concat(FeCha.getMonth()+1) :  (FeCha.getMonth()+1);
            console.log( FeCha.getFullYear()+"-"+mes+"-"+FeCha.getDate());
            $("input[type=date]").val( FeCha.getFullYear()+"-"+mes+"-"+FeCha.getDate());
        }
    }

    window.onload= function(){
      setDefaultDate();
    }
</script>

