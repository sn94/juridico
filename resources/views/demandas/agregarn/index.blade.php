@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">{{ ($OPERACION=="A" || $OPERACION=="A+")? "AGREGAR":  ($OPERACION=="M"? "EDITAR":"FICHA") }}</li> 
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

  <h4>{{ isset($ci) ? $ci." - ". $nombre  : ""}}</h4>  


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
  
    <hr>
   
</div>
</div>

 



  
@endsection



<script>
 
var formDatosPerEnviado= false;


function existeCI( handler){
  let ci= $("#form-person input[name=CI]").val();//Numero de cedula ingresado
  let rta= "<?=url("existe-ci")?>/"+ci; console.log("respuesta ci eval", rta);
  $.ajax( {url: rta, success: (re)=>{
    let resp=jsonReceiveHandler(re);console.log("respuesta ci eval", resp);
    if( typeof resp != "boolean"){
        if( resp.existe == "s"){   alert("EL CI N° "+ci+" ya existe"); 
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
           $( divname).html(  "<h6 style='color:red;'>Problemas de conexión</h6>" ); 
         }
       }
     );
}/*****end ajax call* */



function enviarDatosPerso( ev){ 
 
  ev.preventDefault(); 
  let campos_vacios= function(){
    if( $("#titular").val()=="") alert("INGRESE EL NOMBRE COMPLETO");
    if( $("#ci").val()=="") alert("INGRESE EL NUMERO DE CEDULA");
    return  ($("#titular").val()==""  ||   $("#ci").val()=="");
  };
  if( ! confirm("CONTINUAR?") ) return;
  if( campos_vacios() ) return;
  let handler= function(){ 
    let divname= "#persona-collapse";
    let success= function( resp ){
    let res= jsonReceiveHandler( resp, divname);
    if( typeof res != "boolean" ){
                formDatosPerEnviado= true;
                //Asignar ID DE DEMANDA
                $("#IDNRO0,#IDNRO1,#IDNRO2").val( res.id_demanda);
                //Asignar el numero de cedula
                $("#CI1,#CI2,#CI3").val(  res.ci);
                //HABILITAR FORMULARIOS RESTANTES
                habilitarCampos("formDeman",true);  habilitarCampos("formNoti",true); habilitarCampos("formObser",true);
                //Mostrar mensaje
                var mens1= `
                <div class="alert alert-success">
                <h5>Se ha registrado a ${res.nombre} - CI° ${res.ci} </h5>
                </div>
                `;
                $(divname).html(  mens1  ); //mensaje 
    }
};
 ajaxCall(ev, divname, success);  }   ;//end handler
 existeCI(  handler) ;
}/** */



 
function enviar( ev){ // ENVIO FORM DEMANDA
 if(  !confirm("CONTINUAR?") ) return;
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
          try{
            let res= JSON.parse( resp);
            if( "error" in res){
              $("#demanda-collapse").html(  `<h6 style='color:red;'>${res.error}</h6>` ); 
            }else{ 
              //Mostrar mensaje
              var mens1= `
              <div class="alert alert-success">
              <h5>Los cambios en "Demanda" para el CI° ${res.ci}  han sido guardados </h5>
              </div>
              `;
              $("#demanda-collapse").html(  mens1  ); //mensaje 
              if($("#operacion").val() == "A+"){
                  //Asignar ID DE DEMANDA
                  $("#IDNRO1,#IDNRO2").val( res.id_demanda);
                //Asignar el numero de cedula
                $("#CI2,#CI3").val(  res.ci);
                //HABILITAR FORMULARIOS RESTANTES
                 habilitarCampos("formNoti",true); habilitarCampos("formObser",true);
               
              }/*** */
              
            }
          }catch(err){      $("#demanda-collapse").html(  `<h6 style='color:red;'>${err}</h6>` );    } 
        },
        error: function(){  $("#demanda-collapse").html(  "<h6 style='color:red;'>Problemas de conexión</h6>" );   }
      }
    );//fin ajax

}


function limpiar_campos_seg(){
  //limpiar campos 
  $("#formNoti input[name=AI_NRO]").val( quitarSeparador( $("#formNoti input[name=AI_NRO]").val() )  );
 $("#formNoti input[name=LIQUIDACIO]").val( quitarSeparador( $("#formNoti input[name=LIQUIDACIO]").val() )  );
 $("#formNoti input[name=ADJ_APROBA]").val( quitarSeparador( $("#formNoti input[name=ADJ_APROBA]").val() )  );
 $("#formNoti input[name=APROB_IMPO]").val( quitarSeparador( $("#formNoti input[name=APROB_IMPO]").val() )  );
 $("#formNoti input[name=SALDO_EXT]").val( quitarSeparador( $("#formNoti input[name=SALDO_EXT]").val() )  );
 $("#formNoti input[name=EMBARGO_N]").val( quitarSeparador( $("#formNoti input[name=EMBARGO_N]").val() )  );
 $("#formNoti input[name=EMBAR_EJEC]").val( quitarSeparador( $("#formNoti input[name=EMBAR_EJEC]").val() )  );
 $("#formNoti input[name=INIVISION]").val( quitarSeparador( $("#formNoti input[name=INIVISION]").val() )  );
 $("#formNoti input[name=LEVANTA]").val( quitarSeparador( $("#formNoti input[name=LEVANTA]").val() )  );
 $("#formNoti input[name=DEPOSITADO]").val( quitarSeparador( $("#formNoti input[name=DEPOSITADO]").val() )  );
 $("#formNoti input[name=EXTRAIDO_C]").val( quitarSeparador( $("#formNoti input[name=EXTRAIDO_C]").val() )  );
 $("#formNoti input[name=EXTRAIDO_L]").val( quitarSeparador( $("#formNoti input[name=EXTRAIDO_L]").val() )  );
}
function enviar2( ev){ //envio DE FORM SEGUIMIENTO
 

  ev.preventDefault();  
  if(  !confirm("CONTINUAR?") ) return;
  limpiar_campos_seg();
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
                <h5>Datos de Seguimiento guardados para ${res.nombre} - CI° ${res.ci} </h5>
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
  
}/** */




function enviar3( ev){ //ENVIO DE FORM OBSERVACION
 
 ev.preventDefault();  
 if(  !confirm("CONTINUAR?") ) return;
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
               <h5> Observaciones guardadas para ${res.nombre} - CI° ${res.ci} </h5>
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
 
}/** */

function quitarSeparador( ele){ 
return ele.replaceAll("[.]", "");
}

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

  function habilitarCampos( targetId, hab){
    let target= document.getElementById(targetId);
    let context= target.elements;
    Array.prototype.forEach.call( context, function(ar){ar.disabled=!hab;   });
  }

 
 



    </script>