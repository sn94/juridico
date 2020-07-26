@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">AGREGAR</li> 
@endsection

@section('content')



<?php

function fecha_f( $fe){ 
  //convertir de d/m/Y a Y/m/d
  if( $fe==""  ) return "";
  $fecha= explode("/",  $fe);
  if( sizeof( $fecha) > 1){
    if(  strlen($fecha[1])==1   )  $fecha[1]= "0".$fecha[1];
    if(  strlen($fecha[0])==1   )  $fecha[0]= "0".$fecha[0];
    echo $fecha[2] ."-".$fecha[1]."-".$fecha[0]; 
  }else
  echo $fe;
 
}

function number_f( $ar){
  $v= floatval( $ar);
  return number_format($v, 0, '', '.');
}
 ?>



<?php  if( isset($ci) ):?>  <h4>{{$ci}} - {{$nombre}}</h4>  <?php endif;?>

 
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
      
      @include("demandas.agregarn.demanda_form", [ 'OPERACION'=>$OPERACION])
       
      </div>
    </div>
    <div id="seguimiento" class="tab-pane">
      <div class="mb-3">
        <a href="#seguimiento-collapse" data-toggle="collapse">
          <i class="icon-user"></i> Seguimiento
        </a>
      </div>
      <div id="seguimiento-collapse" class="collapse" data-parent="#formOrder">
         
      @include("demandas.agregarn.notifi_form", [  'OPERACION'=>$OPERACION])
      </div>
    </div>
    <div id="observacion" class="tab-pane">
      <div class="mb-3">
        <a href="#observacion-collapse" data-toggle="collapse">
          <i class="icon-credit-card"></i> Observacion
        </a>
      </div>
      <div id="observacion-collapse" class="collapse" data-parent="#formOrder">
     
      @include("demandas.agregarn.observa_form", ['OPERACION'=>$OPERACION])

      </div>
    </div>
  
    <hr>
   
</div>
</div>

 



  
@endsection



<script>
var formDatosPerEnviado= false;
var formDemandasEnviado= false;


function enviarDatosPerso( ev){ 
 
 ev.preventDefault(); 
       $.ajax(
       {
         url:  ev.target.action,
         method: "post",
         data: $("#"+ev.target.id).serialize(),
         
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
         beforeSend: function(){
           $("#persona-collapse").html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
         },
         success: function( resp ){
           try{
             let res= JSON.parse( resp);
             if( "error" in res){
               $("#persona-collapse").html(  `<h6 style='color:red;'>${res.error}</h6>` ); 
             }else{ 
               formDatosPerEnviado= true;
               $("#CI1,#CI2,#CI3").val(  res.ci);//Asignar el numero de cedula
               //Mostrar mensaje
               var mens1= `
               <div class="alert alert-success">
               <h5>Se ha registrado a ${res.nombre} - CI° ${res.ci} </h5>
               </div>
               `;
               $("#persona-collapse").html(  mens1  ); //mensaje 
             }
           }catch(err){
             $("#persona-collapse").html(  `<h6 style='color:red;'>${err}</h6>` ); 
           } 
         },
         error: function(){
           $("#persona-collapse").html(  "<h6 style='color:red;'>Problemas de conexión</h6>" ); 
         }
       }
     );
 
 
}/** */



 
function enviar( ev){ // ENVIO FORM DEMANDA
 
  ev.preventDefault(); 
  //limpiar campo demanda 
  $("#formDeman input[name=DEMANDA]").val( quitarSeparador( $("#formDeman input[name=DEMANDA]").val() )  );
  //limpiar campo saldo
  $("#formDeman input[name=SALDO]").val( quitarSeparador( $("#formDeman input[name=SALDO]").val() )  );

  $.ajax(
    {
      url:  ev.target.action,
      method: "post",
      data: $("#"+ev.target.id).serialize(),
      
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      beforeSend: function(){
        $("#demanda-collapse").html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
      },
      success: function( resp ){
        console.log( resp);
        try{
          let res= JSON.parse( resp);
          if( "error" in res){
            $("#demanda-collapse").html(  `<h6 style='color:red;'>${res.error}</h6>` ); 
          }else{
            //Bandera formulario enviado
            formDemandasEnviado= true;
            //Mostrar mensaje
            var mens1= `
            <div class="alert alert-success">
            <h5>Se han registrado datos de demanda para el CI° ${res.ci} </h5>
            </div>
            `;
            $("#demanda-collapse").html(  mens1  ); //mensaje
            //Recuperar id de demanda
            $("#IDNRO1,#IDNRO2").val( res.id_demanda);  
          }
        }catch(err){
          $("#demanda-collapse").html(  `<h6 style='color:red;'>${err}</h6>` ); 
        } 
      },
      error: function(){
        $("#demanda-collapse").html(  "<h6 style='color:red;'>Problemas de conexión</h6>" ); 
      }
    }
  );
}

function enviar2( ev){ //envio DE FORM SEGUIMIENTO
 
  ev.preventDefault();
  let operation= $("#operacion").val();
  if(  operation=="A" &&  !formDemandasEnviado){
    alert("Antes de continuar, debe guardar los datos de demanda")
  }else{
        $.ajax(
        {
          url:  ev.target.action,
          method: "post",
          data: $("#"+ev.target.id).serialize(),
          
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
          beforeSend: function(){
            $("#seguimiento-collapse").html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
          },
          success: function( resp ){
            try{
              let res= JSON.parse( resp);
              if( "error" in res){
                $("#seguimiento-collapse").html(  `<h6 style='color:red;'>${res.error}</h6>` ); 
              }else{ 
                //Mostrar mensaje
                var mens1= `
                <div class="alert alert-success">
                <h5>Se han registrado datos de seguimiento para ${res.nombre} - CI° ${res.ci} </h5>
                </div>
                `;
                $("#seguimiento-collapse").html(  mens1  ); //mensaje  
              }
            }catch(err){
              $("#seguimiento-collapse").html(  `<h6 style='color:red;'>${err}</h6>` ); 
            } 
          },
          error: function(){
            $("#seguimiento-collapse").html(  "<h6 style='color:red;'>Problemas de conexión</h6>" ); 
          }
        }
      );
  }
  
}/** */




function enviar3( ev){ //ENVIO DE FORM OBSERVACION
 
 ev.preventDefault();
 let operation= $("#operacion").val();
 if(  operation=="A"  && !formDemandasEnviado){
   alert("Antes de continuar, debe guardar los datos de demanda")
 }else{
       $.ajax(
       {
         url:  ev.target.action,
         method: "post",
         data: $("#"+ev.target.id).serialize(),
         
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
         beforeSend: function(){
           $("#observacion-collapse").html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
         },
         success: function( resp ){
           try{
             let res= JSON.parse( resp);
             if( "error" in res){
               $("#observacion-collapse").html(  `<h6 style='color:red;'>${res.error}</h6>` ); 
             }else{ 
               //Mostrar mensaje
               var mens1= `
               <div class="alert alert-success">
               <h5>Se han registrado observaciones para ${res.nombre} - CI° ${res.ci} </h5>
               </div>
               `;
               $("#observacion-collapse").html(  mens1  ); //mensaje 
             }
           }catch(err){
             $("#observacion-collapse").html(  `<h6 style='color:red;'>${err}</h6>` ); 
           } 
         },
         error: function(){
           $("#observacion-collapse").html(  "<h6 style='color:red;'>Problemas de conexión</h6>" ); 
         }
       }
     );
 }
 
}/** */

function quitarSeparador( ele){ 
return ele.replace(".", "");
}

        
  function formatear(obj){
    let val_Act= obj.value;
    val_Act= val_Act.replaceAll( new RegExp(/[\.]*[,]*/), "");
    console.log(val_Act);
    let enpuntos= new Intl.NumberFormat("de-DE").format( val_Act);
    console.log( enpuntos);
		$( obj).val( enpuntos);
	} 
    </script>