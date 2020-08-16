@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">BANCOS</li> 
<li class="breadcrumb-item active" aria-current="page">INICIO</li> 
@endsection

@section('content')

 
<a onclick="mostrar_form(event)" data-toggle="modal" data-target="#showform"  href="<?=url("nbank")?>"  class="btn btn-sm btn-success">NUEVA CTA.</a>


@include("bancos.grilla")


<div id="showform" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" id="viewform">
      
    </div>
  </div>
</div>
@endsection


<script>

    
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



function guardar( ev ){//Objeto event   DIV tag selector to display   success handler
ev.preventDefault();
 let divname="#mensaje";
  $.ajax(
       {
         url:  ev.target.action,
         method: "post",
         data: $("#"+ev.target.id).serialize(),
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
         beforeSend: function(){
           $( divname).html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
         },
         success: function(res){
            $( divname).html(JSON.parse(res).ok ); 
         },
         error: function(){
           $( divname).html(  "<h6 style='color:red;'>Problemas de conexión</h6>" ); 
         }
       }
     );
}/*****end ajax call* */

</script>

