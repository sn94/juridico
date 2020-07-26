@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">DEMANDADOS</li> 
@endsection

@section('content')

<style>
  .busqueda{
 background-position: left center;
  
 padding-left: 17px;
  
 width:183px;
  
 background-image: url(<?= url("assets/img/search18.png")?>);
  
 background-repeat: no-repeat;
border:none;
 }

</style>
<a href="<?=url("ndemandado")?>" class="btn btn-success btn-sm">NUEVO</a>


<input style="width:100%;"  placeholder="buscar" class="busqueda col-12 col-md-3 form-control form-control-sm m-md-0 " type="text"  id="argumento" oninput="buscarRegs(this)">
 
  
 
<div id="tabla-dinamica" class="table-responsive" style="width: 100%;">

@include("demandado.list_paginate_ajax", ["lista"=>$lista]  )
  {{ $lista->links() }}
</div> 


  <script> 

  function buscarRegs(target){

     $.ajax({
       url: "<?=url("ldemandados")?>/"+target.value,
       success: function(res){
         $("#tabla-dinamica").html(  res );
       }
     });
  }
 
  </script>
  
@endsection


