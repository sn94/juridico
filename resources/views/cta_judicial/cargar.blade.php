@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">CTAS.JUDICIALES</li> 
<li class="breadcrumb-item active" aria-current="page">{{ ( $OPERACION == "A")? "NUEVO MOVIMIENTO" : ( ( $OPERACION == "M") ? "EDITAR MOVIMIENTO": "DATOS MOVIMIENTO")}}</li> 
@endsection

@section('content')

<?php

$ruta="";
if( $OPERACION == "A"){ $ruta= url("ncuentajudi/$id_demanda");}
if( $OPERACION == "M"){ $ruta= url("ecuentajudi/$dato->IDNRO");}
?>
<a href="<?=  url("ctajudicial/$id_demanda")?>">VOLVER</a>






<div id="myform">
<form  id="ctajudimov" onsubmit="guardarMovJud(event)" method="post" action="<?= $ruta ?>">
{{csrf_field()}}

<?php  if( $OPERACION != "V"):?>
<button type="submit" class="btn btn-info btn-sm mt-4">GUARDAR</button>
<?php endif;?>
<input type="hidden" id="OPERACION" value="{{ isset($OPERACION)?$OPERACION:''}}">

@include("cta_judicial.form")
<br>
</form>

</div>

@endsection
<script type="text/javascript">

function cambiar(ev){
    if( ev.currentTarget.value == "D") deposito();   else extraccion();
}
function deposito(){//RADIO BUTTON DEPOSITO OPCION
$("#tipoext").addClass("invisible"); $("#chequenro").addClass("invisible");
}
 
 function extraccion(){//RADIO BUTTON EXTRACCION OPCION
    $("#tipoext").removeClass("invisible");
$("#chequenro").removeClass("invisible");
$("#tipoext").addClass("visible");
$("#chequenro").addClass("visible");

 }




 /**VALIDACIONES */
  //Borrar cualquier ocurrencias de puntos o comas en una cadena
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



/** t GUARDAR DATOS
 */
function quitarSeparador( ele){  return ele.replaceAll("[.]", ""); }


function ajaxCall( ev, divname, success_f){//Objeto event   DIV tag selector to display   success handler

      
$("#ctajudimov input[name=IMPORTE]").val( quitarSeparador( $("#ctajudimov input[name=IMPORTE]").val() )  );
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
      $( divname).html(  "<h6 style='color:red;'>Problemas de conexión</h6>" ); 
    }
  }
);
}/*****end ajax call* */


 function guardarMovJud( ev){
     ev.preventDefault();
     if($("#ctajudimov input[name=IMPORTE]").val() == "")
     alert("INGRESA EL IMPORTE");
     else{
        if( confirm("CONTINUAR?")){
            ajaxCall( ev, "#myform", function(res){
                $("#myform").html( res);
            });
        }
     }
      
 }


/*
*
INICIALIZACIONES
*/
function showToday(){
    let f= new Date();
    let mes= (f.getMonth()+1);
    if( mes<= 9)  mes= "0".concat(mes);

let d= f.getFullYear()+"-"+mes+"-"+f.getDate(); 
$("#ctajudimov input[name=FECHA]").val(  d);
} 

   //deshabilitar
   function habilitarCampos( targetId, hab){
    let target= document.getElementById(targetId);
    let context= target.elements;
    Array.prototype.forEach.call( context, function(ar){ar.disabled=!hab;   });
  }

 

  if( document.getElementById("OPERACION")== "V"){
      habilitarCampos("ctajudimov", false);
  }
  
 

</script>

