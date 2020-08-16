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

 