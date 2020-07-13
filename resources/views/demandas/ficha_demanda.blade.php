@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">FICHA DE DEMANDA</li> 
@endsection

@section('content')


  
<div class="row">
  <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="actuaria">Titular:</label>
             <input readonly  type="text"   class="form-control form-control-sm"  value="{{$ficha->TITULAR}}">
        </div>
       
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="actuaria">Cedula:</label>
                    <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->CI}}">
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="actuaria">Telefono:</label>
                    <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->TELEFONO}}">
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="actuaria">Celular:</label>
                    <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->CELULAR}}">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="actuaria">Direccion:</label>
             <input readonly  type="text"   class="form-control form-control-sm   " value="{{$ficha->DOMICILIO}}">
        </div> 
       
      
        <div class="form-group">
            <label for="actuaria">Direc.laboral:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->LABORAL}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Telef.laboral:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->TEL_TRABAJ}}">
        </div>
  </div>
 
  <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="actuaria">Garante:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->GARANTE}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Celula Gte.:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->CI_GARANTE}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Direccion Gte:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->DOM_GARANT}}">
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="actuaria">Telefono Gte:</label>
                    <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->TEL_GARANT}}">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="actuaria">Telef.Laboral Gte.:</label>
                    <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->TEL_LAB_G}}">
                </div>
            </div>
        </div>
        
     
        <div class="form-group">
            <label for="actuaria">Direc.Laboral Gte.:</label>
             <input readonly  type="text"   class="form-control form-control-sm"  value="{{$ficha->LABORAL_G}}">
        </div>
  </div>
   
  <div class="col-l2 col-md-4">
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
    

     
</div>
 
<div class="row">
<div class="col-12 col-md-2">
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

    <div class="col-12 col-md-2">
        <div class="form-group">
            <label for="actuaria">Demanda:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->DEMANDA}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Saldo:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->SALDO}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Nro.Embargo:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->EMBARGO_NR}}">
        </div> 
        <div class="form-group">
            <label for="actuaria">Fecha de embargo:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->FEC_EMBARG}}">
        </div>
       
      </div>
      <div class="col-12 col-md-8">
        <div class="form-group">
                <label for="actuaria">Institución:</label>
                 <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->INSTITUCIO}}">
            </div>
            <div class="form-group">
                <label for="actuaria">Domic.denunciado:</label>
                 <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->DOC_DENUNC}}">
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="actuaria">Localidad:</label>
                        <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->LOCALIDAD}}">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="actuaria">Localidad del Gte.:</label>
                        <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->LOCALIDA_G}}">
                    </div>
                </div>
            </div>
           
            <div class="form-group">
                <label for="actuaria">Dom.denun.Gte:</label>
                 <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->DOC_DEN_GA}}">
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