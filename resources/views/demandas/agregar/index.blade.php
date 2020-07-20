@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">AGREGAR</li> 
@endsection

@section('content')

<?php  if( isset($ci) ):?>  <h4>{{$ci}} - {{$nombre}}</h4>  <?php endif;?>


  <input type="hidden" id="iddemanda">
 
<div class="nav-tabs-responsive">
  <ul class="nav nav-tabs mb-4">
    <li class="nav-item">
      <a href="#demanda" class="nav-link active" data-toggle="tab">
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
    <div id="demanda" class="tab-pane show active">
      <div class="mb-3">
        <a href="#demanda-collapse" data-toggle="collapse">
          <i class="icon-lock"></i> Demanda
        </a>
      </div>
      <div id="demanda-collapse" class="collapse show" data-parent="#formOrder">
        
     
      @include("demandas.agregar.create")
      </div>
    </div>
    <div id="seguimiento" class="tab-pane">
      <div class="mb-3">
        <a href="#seguimiento-collapse" data-toggle="collapse">
          <i class="icon-user"></i> Seguimiento
        </a>
      </div>
      <div id="seguimiento-collapse" class="collapse" data-parent="#formOrder">
         
      @include("notificaciones.agregar")
      </div>
    </div>
    <div id="observacion" class="tab-pane">
      <div class="mb-3">
        <a href="#observacion-collapse" data-toggle="collapse">
          <i class="icon-credit-card"></i> Observacion
        </a>
      </div>
      <div id="observacion-collapse" class="collapse" data-parent="#formOrder">
     
      @include("observaciones.agregar")

      </div>
    </div>
    <hr>
   
</div>
</div>

 



  
@endsection



<script>

var formDemandasEnviado= false;


function enviar( ev){ 
 
  ev.preventDefault();
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
            <h5>Se han registrado datos de demanda para ${res.nombre} - CI° ${res.ci} </h5>
            </div>
            `;
            $("#demanda-collapse").html(  mens1  ); //mensaje
            //Recuperar id de demanda
            $("#iddemanda").val( res.id_demanda);
            $("#id_demanda2").val( res.id_demanda);$("#ci2").val( res.ci);
            $("#id_demanda3").val( res.id_demanda);$("#ci3").val( res.ci);
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

function enviar2( ev){ 
 
  ev.preventDefault();
  if( ! formDemandasEnviado){
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




function enviar3( ev){ 
 
 ev.preventDefault();
 if( ! formDemandasEnviado){
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

function showMenuBanco(){
  
}
       
    </script>