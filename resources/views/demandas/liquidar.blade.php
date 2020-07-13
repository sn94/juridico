@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">LIQUIDAR</li> 
@endsection

@section('content')


 
<h3>ZUCHINI, MIRIAN CUEVAS DE</h3>
<h4>Cta. Bancaria: 201982/2</h4>
<div class="row">
  <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="actuaria">Capital:</label>
            <input name="ACTUARIA" type="text" id="actuaria" class="form-control form-control-sm   ">
        </div>
        <div class="form-group">
            <label for="actuaria">Último pago:</label>
            <input name="ACTUARIA" type="text" id="actuaria" class="form-control form-control-sm">
        </div>
        <div class="form-group">
            <label for="actuaria">Último cheque:</label>
            <input name="ACTUARIA" type="text" id="actuaria" class="form-control form-control-sm   ">
        </div>
        <div class="form-group">
            <label for="actuaria">Cta.meses:</label>
            <input name="ACTUARIA" type="text" id="actuaria" class="form-control form-control-sm   ">
        </div>
        <div class="form-group">
            <label for="actuaria">Intereses %:</label>
            <input name="ACTUARIA" type="text" id="actuaria" class="form-control form-control-sm   ">
        </div>
        <div class="form-group">
            <label for="actuaria">Imp.intereses:</label>
            <input name="ACTUARIA" type="text" id="actuaria" class="form-control form-control-sm   ">
        </div>
  </div>
 
  <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="actuaria">Gst.Notificación:</label>
            <input name="ACTUARIA" type="text" id="actuaria" class="form-control form-control-sm   ">
        </div>
        <div class="form-group">
            <label for="actuaria">Gst.Notif.Gte.:</label>
            <input name="ACTUARIA" type="text" id="actuaria" class="form-control form-control-sm   ">
        </div>
        <div class="form-group">
            <label for="actuaria">Gst.Embargo.:</label>
            <input name="ACTUARIA" type="text" id="actuaria" class="form-control form-control-sm   ">
        </div>
        <div class="form-group">
            <label for="actuaria">Gst.Intimación.:</label>
            <input name="ACTUARIA" type="text" id="actuaria" class="form-control form-control-sm   ">
        </div>
        <div class="form-group">
            <label for="actuaria">Honorarios.:</label>
            <input name="ACTUARIA" type="text" id="actuaria" class="form-control form-control-sm   ">
        </div>
        <div class="form-group">
            <label for="actuaria">IVA.:</label>
            <input name="ACTUARIA" type="text" id="actuaria" class="form-control form-control-sm   ">
        </div>
  </div>
   
 
  <div class="col-6 col-md-4">
        <div class="form-group">
            <label for="actuaria">Finiquito:</label>
            <input name="ACTUARIA" type="text" id="actuaria" class="form-control form-control-sm   ">
        </div>
        <div class="form-group">
            <label for="actuaria">Total:</label>
            <input name="ACTUARIA" type="text" id="actuaria" class="form-control form-control-sm   ">
        </div>
        <div class="form-group">
            <label for="actuaria">Imp.extraído:</label>
            <input name="ACTUARIA" type="text" id="actuaria" class="form-control form-control-sm   ">
        </div>
        <div class="form-group">
            <label for="actuaria">Saldo:</label>
            <input name="ACTUARIA" type="text" id="actuaria" class="form-control form-control-sm   ">
        </div>
        <div class="form-group">
            <label for="actuaria">Extrac.Líquid.:</label>
            <input name="ACTUARIA" type="text" id="actuaria" class="form-control form-control-sm   ">
        </div>
        <div class="form-group">
            <label for="actuaria">Nuevo Saldo:</label>
            <input name="ACTUARIA" type="text" id="actuaria" class="form-control form-control-sm   ">
        </div>
      </div>
</div>

<div class="btn-group" role="group" aria-label="Basic example"> 
  <button type="button" class="btn btn-secondary">Guardar</button>
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