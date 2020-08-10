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
     <div id="show_opc_rep" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" >
    <a  id="info-xls" onclick="callToXlsGen(event, 'FILTRO')" class="btn btn-sm btn-info" href="<?=url("jsonliquida")?>"><i class="fa fa-file-excel-o fa-2x" aria-hidden="true"></i> <h3>EXCEL</h3></a>
   
    <a  id="info-pdf"  class="btn btn-sm btn-info" href="<?=url("pdfliquida")?>"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i><h3>PDF</h3></a>
    <a  id="info-print" class="btn btn-sm btn-info" href="<?=url("jsonliquida")?>"><i class="fa fa-print fa-2x" aria-hidden="true"></i><h3>Printer</h3></a>
    </div>
  </div>
</div>
 
@endsection 

<script>

 
 

 
function mostrar_informe(ev){
    ev.preventDefault();
   // let id= ev.currentTarget.parentNode.parentNode.id;
    let xls= $("#RUTA1").val();
    let pdf= $("#RUTA2").val();

    $("#info-xls").attr("href", xls );
    $("#info-pdf").attr("href", pdf );
    $("#info-print").attr("href", $("#info-print").attr("href") );
    ev.currentTarget.href.concat( id ) ;
  }


</script>