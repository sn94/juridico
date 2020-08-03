@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">PARÁMETROS</li>  
@endsection

@section('content')
   
<button onclick="ver_form()" data-toggle="modal" data-target="#formparam"  type="button" class="mb-2 btn btn-sm btn-info">NUEVO</button>
 <div id="espera"></div>
<div id="grilla">
@include("parametros.grilla", ['lista'=> $lista] )
</div>

<div id="formparam" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" id="viewform">
      
    </div>
  </div>
</div>

<!--
ODEMANDA
INT_X_MES
HONO_PORCE
CANTDIA_P_VTO_DE_NOTIF
IVA
-->
@endsection 


<script>


function ver_form(){
let divname= "#viewform";
  $.ajax(
       {
         url:  "<?=url("nparam")?>", 
         beforeSend: function(){
           $( divname).html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
         },
         success: function(res){ $(divname).html( res );        },
         error: function(){
           $( divname).html(  "<h6 style='color:red;'>Problemas de conexión</h6>" ); 
         }
       }
     );
}

function act_grilla(){
  $.ajax({
    url:"<?= url("lparams")?>",
    beforeSend: function(){
         $( "#espera").html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
       },
    success: function(res){    $("#grilla").html( res ); $( "#espera").html( "");    },
    error: function(xhr){     $( "#espera").html( "");    }
  })
}
function borrar( ev){//Objeto event   DIV tag selector to display   success handler
ev.preventDefault();  
if(confirm("SEGURO QUE DESEA BORRARLO?") ){
     $.ajax(
     {
       url:  ev.currentTarget.href,
       method: "get", 
       headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
       beforeSend: function(){
         $( "#espera").html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
       },
       success: function(res){
         alert("BORRADO"); $( "#espera").html( "");
         act_grilla();
       },
       error: function(xhr){
        $( "#espera").html( xhr);
         alert(xhr);
       }
     }
   );}
}/*****end ajax call* */


    

</script>