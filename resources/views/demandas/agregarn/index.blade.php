
@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">{{ ($OPERACION=="A" || $OPERACION=="A+")? "AGREGAR":  ($OPERACION=="M"? "EDITAR":"FICHA") }}</li> 
@endsection

@section('content')

 
<?php

use App\Mobile_Detect; 

$detect= new Mobile_Detect();
if ($detect->isMobile() == false):?>
 <h4>{{ isset($ci) ? $ci." - ". $nombre  : ""}}</h4>  
<?php else: ?>
  <p class="name-titular">{{ isset($ci) ? $ci." - ". $nombre  : ""}}</p>  
<?php endif; ?>
 

  <?php if( $OPERACION=="M" || $OPERACION=="V"): ?>
    <a  class="btn btn-info btn-sm" href="<?=url("liquida/".$ficha->IDNRO)?>">LIQUIDACIÓN</a>
    <a  class="btn btn-info btn-sm" href="<?=url("ctajudicial/".$ficha->IDNRO)?>">CTAS.JUDICIALES</a>
  <?php endif;?>
 
<input type="hidden" id="operacion" value="{{$OPERACION}}">

<div class="nav-tabs-responsive">
  <ul class="nav nav-tabs mb-4">
  <li class="nav-item">
      <a href="#persona" class="nav-link active" data-toggle="tab">
        <i class="icon-lock"></i> Datos personales
      </a>
    </li>
    <li class="nav-item">
      <a href="#demanda" class="nav-link" data-toggle="tab">
        <i class="icon-lock"></i> Demanda
      </a>
    </li>
    <li class="nav-item">
      <a href="#seguimiento" class="nav-link" data-toggle="tab">
        <i class="icon-user"></i> Seguimiento
      </a>
    </li>
    <li class="nav-item">
      <a href="#observacion" class="nav-link" data-toggle="tab">
        <i class="icon-credit-card"></i> Observacion
      </a>
    </li>

    <li class="nav-item">
      <a href="#contraparte" class="nav-link" data-toggle="tab">
        <i class="icon-credit-card"></i> Interv. contraparte
      </a>
    </li>

    <li class="nav-item">
      <a href="#extrajudicial" class="nav-link" data-toggle="tab">
        <i class="icon-credit-card"></i> Arreglo Extrajud.
      </a>
    </li>
    
    <li class="nav-item">
      <a href="#honorarios" class="nav-link" data-toggle="tab">
        <i class="icon-credit-card"></i> Honorarios
      </a>
    </li>

  </ul>
  <div id="formOrder" class="tab-content">
  <div id="persona" class="tab-pane show active">
      <div class="mb-3">
        <a href="#persona-collapse" data-toggle="collapse">
          <i class="icon-credit-card"></i> Datos personales
        </a>
      </div>
      <div id="persona-collapse" class="collapse" data-parent="#formOrder">
     
      @include("demandas.agregarn.demandado_form", [ 'OPERACION'=>$OPERACION])

      </div>
    </div>

    <div id="demanda" class="tab-pane">
      <div class="mb-3">
        <a href="#demanda-collapse" data-toggle="collapse">
          <i class="icon-lock"></i> Demanda
        </a>
      </div>
      <div id="demanda-collapse" class="collapse show" data-parent="#formOrder">
      
      <?php  if( isset($ci) ):?>
        @include("demandas.agregarn.demanda_form",  [ 'ci'=>$ci, 'OPERACION'=>$OPERACION])
      <?php else:?>
        @include("demandas.agregarn.demanda_form",  [  'OPERACION'=>$OPERACION])
      <?php endif;?>
     
       
      </div>
    </div>
    <div id="seguimiento" class="tab-pane">
      <div class="mb-3">
        <a href="#seguimiento-collapse" data-toggle="collapse">
          <i class="icon-user"></i> Seguimiento
        </a>
      </div>
      <div id="seguimiento-collapse" class="collapse" data-parent="#formOrder">
         
      @include("demandas.agregarn.notifi_form")
      </div>
    </div>
    <div id="observacion" class="tab-pane">
      <div class="mb-3">
        <a href="#observacion-collapse" data-toggle="collapse">
          <i class="icon-credit-card"></i> Observacion
        </a>
      </div>
      <div id="observacion-collapse" class="collapse" data-parent="#formOrder">
     
      @include("demandas.agregarn.observa_form")

      </div>
    </div>

    <div id="contraparte" class="tab-pane">
      <div class="mb-3">
        <a href="#contraparte-collapse" data-toggle="collapse">
          <i class="icon-credit-card"></i> Interv. contraparte
        </a>
      </div>
      <div id="contraparte-collapse" class="collapse" data-parent="#formOrder">
     
      @include("demandas.agregarn.contraparte_form")

      </div>
    </div>

    <div id="extrajudicial" class="tab-pane">
      <div class="mb-3">
        <a href="#extrajudicial-collapse" data-toggle="collapse">
          <i class="icon-credit-card"></i> Arreglo Extrajudicial
        </a>
      </div>
      <div id="extrajudicial-collapse" class="collapse" data-parent="#formOrder">
     
      @include("demandas.agregarn.extrajudicial_form")

      </div>
    </div>

    <div id="honorarios" class="tab-pane">
      <div class="mb-3">
        <a href="#honorarios-collapse" data-toggle="collapse">
          <i class="icon-credit-card"></i> Honorarios
        </a>
      </div>
      <div id="honorarios-collapse" class="collapse" data-parent="#formOrder">
     
      @include("demandas.agregarn.contraparte_form")

      </div>
    </div>
  
    <hr>
   
</div>
</div>

 



  
@endsection



<script>
 
var formEnviado= false;


function existeCI( handler){

  let ci= $("#form-person input[name=CI]").val();//Numero de cedula ingresado
  let rta= "<?=url("existe-ci")?>/"+ci; console.log("respuesta ci eval", rta);
  $.ajax( {url: rta, success: (re)=>{
    let resp=jsonReceiveHandler(re);console.log("respuesta ci eval", resp);
    if( typeof resp != "boolean"){
        if( resp.existe == "s"){  
          if( $("#CI-DEFAULT").val()== $("#form-person input[name=CI]").val())
           handler();
           else alert("EL CI N° "+ci+" ya existe"); 
        }else{
          //permitir grabar
          handler();
        } 
    }  
    }    }  )
}/***End existe ci */

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

function ajaxCall( ev, divname, success_f){//Objeto event   DIV tag selector to display   success handler
  $.ajax(
       {
         url:  ev.target.action,
         method: "post",
         data: $("#"+ev.target.id).serialize(),
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
         beforeSend: function(){
           $( divname).html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 

         },
         success: success_f,
         error: function(){
           $( divname).html(  "" ); 
           alert("Problemas de conexión");
         }
       }
     );
}/*****end ajax call* */



function enviarso( ev){ 
 
  ev.preventDefault(); 
  let campos_vacios= function(){
    if( $("#titular").val()=="") alert("INGRESE EL NOMBRE COMPLETO");
    if( $("#ci").val()=="") alert("INGRESE EL NUMERO DE CEDULA");
    return  ($("#titular").val()==""  ||   $("#ci").val()=="");
  };

  if( campos_vacios() ) return;
  let handler= function(){ 
    let divname= "#persona-panel";
    let success= function( resp ){
    let res= jsonReceiveHandler( resp, divname);
    if( typeof res != "boolean" ){
                formEnviado= true;
                //Asignar ID DE DEMANDA si existe
                if( "id_demanda" in res) 
                $("#IDNRO0,#IDNRO1,#IDNRO2,#IDNRO3,#IDNRO4").val( res.id_demanda);
                //Asignar el numero de cedula
                $("#CI1,#CI2,#CI3,#CI4,#CI5").val(  res.ci);
                //HABILITAR FORMULARIOS RESTANTES
                habilitarCampos("formDeman",true);  habilitarCampos("formNoti",true); habilitarCampos("formObser",true);
                //Mostrar mensaje 
                $(divname).html(  ""  ); //mensaje 
                $("#pers-msg").text( "GUARDADO!");
                $(".toast").toast("show");
                //alert("Se ha registrado a "+res.nombre+" - CI° "+res.ci );
    }
};
 ajaxCall(ev, divname, success);  }   ;//end handler
 existeCI(  handler) ;
}/** */


function limpiar_campos_dema(){
  //limpiar campos 
  $("#formDeman .number-format").each( function( indice, obj){    quitarSeparador( obj); } );
}
function rec_formato_numerico_dema(){ 
  $("#formDeman .number-format").each( function( indice, obj){    numero_con_puntuacion( obj); } );
}

 
function enviar( ev){ // ENVIO FORM DEMANDA
  
  ev.preventDefault();  
 //limpiar campo demanda 
limpiar_campos_dema();
      $.ajax(
      {
        url:  ev.target.action,
        method: "post",
        data: $("#"+ev.target.id).serialize(),
        
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        beforeSend: function(){
          $("#demanda-panel").html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
          
        },
        success: function( resp ){ 
          try{
            let res= JSON.parse( resp);
            if( "error" in res){
              $("#demanda-panel").html( "" ); 
              alert( res.error);
            }else{ 
              //Mostrar mensaje 
              $("#demanda-panel").html(  ""  ); //mensaje 
              $("#dema-msg").text( "GUARDADO!");
                $(".toast").toast("show");
             // alert("Los cambios en Demanda para el CI° "+res.ci+" han sido guardados ");

              if($("#operacion").val() == "A+"){
                  //Asignar ID DE DEMANDA
                  $("#IDNRO1,#IDNRO2").val( res.id_demanda);
                //Asignar el numero de cedula
                $("#CI2,#CI3").val(  res.ci);
                //HABILITAR FORMULARIOS RESTANTES
                 habilitarCampos("formNoti",true); habilitarCampos("formObser",true);
               
              } 
            }
            rec_formato_numerico_dema();
          }catch(err){     
             $("#demanda-panel").html( "");
             alert(err); 
             rec_formato_numerico_dema();
          } 
        },
        error: function(){ 
           $("#demanda-panel").html(  "" );
           alert("Problemas de conexión");
           rec_formato_numerico_dema();
              }
      }
    );//fin ajax

}


function limpiar_campos_seg(){
  //limpiar campos 
  $("#formNoti .number-format").each( function( indice, obj){    quitarSeparador( obj); } );
}
function rec_formato_numerico_noti(){ 
  $("#formNoti .number-format").each( function( indice, obj){    numero_con_puntuacion( obj); } );
}

function enviar2( ev){ //envio DE FORM SEGUIMIENTO
 

  ev.preventDefault();  
 
  limpiar_campos_seg();
        $.ajax(
        {
          url:  ev.target.action,
          method: "post",
          data: $("#"+ev.target.id).serialize(),
          
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
          beforeSend: function(){
            $("#seguimiento-panel").html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
          },
          success: function( resp ){
            try{
             
              let res= JSON.parse( resp);
              if( "error" in res){ 
                $("#seguimiento-panel").html( "" ); 
                alert(res.error);
              }else{ 
                //Mostrar mensaje 
                $("#seguimiento-panel").html( "" ); 
                $("#noti-msg").text( "GUARDADO!");
                $(".toast").toast("show");
              //  alert("Datos de Seguimiento guardados para "+res.nombre+"- CI° "+res.ci);
              
              }
              rec_formato_numerico_noti();
            }catch(err){
              $("#seguimiento-panel").html( "" ); 
              alert( err); 
              rec_formato_numerico_noti();
            } 
          },
          error: function(){
            $("#seguimiento-panel").html( "" ); 
            alert(  "Problemas de conexión ");
            rec_formato_numerico_noti();
          }
        }
      );
  
}/** */




function enviar3( ev){ //ENVIO DE FORM OBSERVACION
 
 ev.preventDefault();  
 
       $.ajax(
       {
         url:  ev.target.action,
         method: "post",
         data: $("#"+ev.target.id).serialize(),
         
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
         beforeSend: function(){
           $("#observacion-panel").html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
         },
         success: function( resp ){
           try{
             let res= JSON.parse( resp);
             if( "error" in res){
               $("#observacion-panel").html(  "" ); 
               alert(res.error);
             }else{ 
               //Mostrar mensaje 
               $("#observacion-panel").html( "" ); //mensaje 
               $("#obse-msg").text( "GUARDADO!");
                $(".toast").toast("show");
             //  alert("Observaciones guardadas para "+res.nombre+" - CI° "+res.ci);
             }
           }catch(err){
             $("#observacion-panel").html(  "" ); 
             alert(err);
           } 
         },
         error: function(){
           $("#observacion-panel").html( "" ); 
           alert("Problemas de conexión");
         }
       }
     );
 
}/** */

function numeroSinFormato( ele){ 
  if( ele =="") return 0;
  else return ele.replaceAll("[.]", "");
}

function quitarSeparador( obj){ 
let w=  obj.value.replaceAll("[.]", "");
obj.value= w;
}
   
   function solo_numero(ev){
    if( ev.data.charCodeAt() < 48 || ev.data.charCodeAt() > 57){ 
      ev.target.value= 
      ev.target.value.substr( 0, ev.target.selectionStart-1) + 
      ev.target.value.substr( ev.target.selectionStart );
    }
     
   }

   function numero_con_puntuacion( obj ) {
    let val_Act= obj.value;  
    let enpuntos= new Intl.NumberFormat("de-DE").format( val_Act);
		$(obj).val(  enpuntos);
   }

  function formatear(ev){
    console.log( ev.target.selectionStart, ev);
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

  function habilitarCampos( targetId, hab){
    let target= document.getElementById(targetId);
    let context= target.elements;
    Array.prototype.forEach.call( context, function(ar){ar.disabled=!hab;   });
  }

 
 

 


    </script>