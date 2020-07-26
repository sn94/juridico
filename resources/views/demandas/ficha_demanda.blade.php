@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">FICHA DE DEMANDA</li> 
@endsection

@section('content')

<!-- Nombre Y CI de Titular -->

   
<div class="row ml-1">  <h5>{{$ficha->CI}} - {{ $nom }}</h5>     </div>
 
<!--Enlaces a seguimiento , observacion --->
<a  class="btn btn-info btn-sm mt-1 mb-1" href="<?=url("vnotifi/$idnro")?>">SEGUIMIENTO</a>
<a  class="btn btn-info btn-sm mt-1 mb-1" href="<?=url("vobser/$idnro")?>">OBSERVACION</a>
<a  class="btn btn-primary btn-sm mt-1 mb-1" href="<?=url("demandas-editar/".$ficha->IDNRO)?>">EDITAR DATOS JUDIC.</a>
<a  class="btn btn-info btn-sm mt-1 mb-1" href="<?=url("vnotifi/$idnro")?>">CTAS.JUDICIALES</a>
<a  class="btn btn-info btn-sm mt-1 mb-1" href="<?=url("vobser/$idnro")?>">LIQUIDACIÓN</a>

  <div class="row">
  
  <div class="col-l2 col-md-3">
        <div class="form-group">
            <label for="actuaria">Origen:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->O_DEMANDA}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Demandante:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->DEMANDANTE}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Cod_emp:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->COD_EMP}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Actuaria:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->ACTUARIA}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Juez:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->JUEZ}}">
        </div>
       
    </div>
    
    <div class="col-12 col-md-3">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                <label for="actuaria">Demanda:</label>
                <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->DEMANDA}}">
                </div>
            </div>
            <div class="col-12 col-md-6">
            <div class="form-group">
            <label for="actuaria">Saldo:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->SALDO}}">
            </div>
            </div>
        </div>
     
        <div class="form-group">
            <label for="actuaria">Nro.Embargo:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->EMBARGO_NR}}">
        </div> 
        <div class="form-group">
            <label for="actuaria">Fecha de embargo:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->FEC_EMBARG}}">
        </div>
        <div class="form-group">
                <label for="actuaria">Institución:</label>
                 <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->INSTITUCIO}}">
            </div>
        <div class="form-group">
                <label for="actuaria">Tipo:</label>
                 <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->INST_TIPO}}">
        </div>
        
    </div>
     
    <div class="col-12 col-md-3">
    <div class="form-group">
                <label for="actuaria">Juzgado:</label>
                 <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->JUZGADO}}">
        </div>
        <div class="form-group">
                <label for="actuaria">Domic.denunciado:</label>
                 <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->DOC_DENUNC}}">
            </div> 
        <div class="form-group">
                <label for="actuaria">Localidad:</label>
                <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->LOCALIDAD}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Localidad del Gte.:</label>
            <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->LOCALIDA_G}}">
        </div>
        <div class="form-group">
                <label for="actuaria">Dom.denun.Gte:</label>
                 <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->DOC_DEN_GA}}">
        </div>
      
    </div>

    <div class="col-12 col-md-3">
       <div class="form-group">
            <label for="actuaria">Nro. Finca:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->FINCA_NRO}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Cta.Cte:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->CTA_BANCO}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Banco:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->BANCO}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Cta.Catastral:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->CTA_CATAST}}">
        </div>
    </div>
</div>
  
  
@endsection



<script>

document.onreadystatechange = () => {
  if (document.readyState === 'complete') {
    // document ready
    $('#demandatable').DataTable();
  }
};



       
    </script>