@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">LIQUIDACIONES</li> 
<li class="breadcrumb-item active" aria-current="page">MOVIMIENTOS</li> 
@endsection

@section('content')

 
<?php

use App\Mobile_Detect; 

$detect= new Mobile_Detect();
if ($detect->isMobile() == false):?>
 <h4>{{ isset($CI) ? $CI." - ". $TITULAR  : ""}}</h4>  
 <h4>Cuenta bancaria: {{$CTA_BANCO}}</h4>
<?php else: ?>
  <p class="name-titular">{{ isset($CI) ? $CI." - ". $TITULAR  : ""}}</p>  
  <p class="name-titular">Cuenta bancaria:{{ $CTA_BANCO}}</p>  
<?php endif; ?>



 <a href="<?= url("nliquida/$id_demanda") ?>" class="btn btn-info btn-sm mb-2">AGREGAR</a>
 
  
 
 <!--TABLA-->
 <div class="table-responsive mt-2" id="tablamovi">
   @include("liquidaciones.grilla", ["lista"=> $lista])
     
 </div>



  



<script type="text/javascript">

  
 

    function borrar(ev){//form vista , edit

    ev.preventDefault();
    console.log( ev.target, ev.currentTarget);
      if(confirm("Seguro que desea borrarlo?")){
        $.ajax( {
            url: ev.currentTarget.href,
            success: function(res){ 
              let ob=JSON.parse( res );

               $("#myform").html( " <div class='alert alert-success'>  <h6>Movimiento borrado</h6>  </div> "); 
              actualizarGrill();
               },
            beforeSend: function(){  
                  $("#myform").html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" );       
            }, 
            error: function(err){  $("#myform").html( "<h6 style='color:red;'>"+err+"</h6>" ); }
        });
      }
    }




function actualizarGrill(){
  $.ajax( {
            url: "<?= url("lliquida/$id_demanda")?>",
            success: function(res){  
               $("#tablamovi").html( res);  
               },
            beforeSend: function(){  
                  $("#tablamovi").html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" );       
            }, 
            error: function(err){  $("#tablamovi").html( "<h6 style='color:red;'>"+err+"</h6>" ); }
        });
}

   
  /*
  Recibe una cadena de numeros
  Devuelve la cadena con separadores de puntos
  */
  function formatear_string(obj){
    let val_Act= String( obj);
    val_Act= val_Act.replaceAll( new RegExp(/[\.]*[,]*/), ""); 
    let enpuntos= new Intl.NumberFormat("de-DE").format( val_Act);
		return enpuntos;
	} 

  function jsonReceiveHandler( data, divname){// string JSON to convert     div Html Tag to display errors
  try{
             let res= JSON.parse( data);
             if( "error" in res){
               $( divname).html(  "<h6 style='color:red;'>"+res.error+"</h6>" ); return false; 
             }else{   return res;  }
           }catch(err){
             $(divname).html(  "<h6 style='color:red;'>"+err+"</h6>" );  return false;
           } return false;
}/***End Json Receiver Handler */



    


 


 
 


/**Verificar tabla vacia */
window.onload= function(){
  if( $("#tlistaliquida tbody").children().length <= 0 )
  alert("NO SE REGISTRAN LIQUIDACIONES EN ESTE JUICIO");
};


</script>  


            


@endsection 