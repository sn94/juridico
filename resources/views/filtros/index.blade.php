@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">FILTROS</li>  
@endsection

@section('content')
 
 

<input type="hidden" id="RUTA1" value="{{$ejecucionxls}}">
<input type="hidden" id="RUTA2" value="{{$ejecucionpdf}}">

<div class="row">
  <div class="col-2 col-sm-2 col-md-2 col-lg-1">
  <a class="btn btn-sm btn-info" href="<?= url("nfiltro") ?>">NUEVO</a>
  </div> 
</div>


         
<div id="statusform">

</div>
<div id="grilla">
@include("filtros.grilla" )
{{ $lista->links() }}
</div> 

	
 


     <!-- MODAL TIPO DE INFORME -->

     @include("layouts.report", ["TITULO"=>"FILTROS" ]  )
 
@endsection 

 
<script>

  
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
let divname= "#statusform";
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
                            alert("FILTRO BORRADO.");
                            $("#"+r.IDNRO).remove();
                            }
                      }/************* */
                      $( divname).html("");
         },
         error: function(){
           $( divname).html(  "<h6 style='color:red;'>Problemas de conexión</h6>" ); 
         }
       }
     );
}


</script>