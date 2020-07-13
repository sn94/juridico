@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">AGREGAR</li> 
@endsection

@section('content')

<div class="btn-group" role="group" aria-label="Basic example">
  <button type="button" class="btn btn-secondary">Seguimiento</button>
  <button type="button" class="btn btn-secondary">Observación</button>
  <button type="button" class="btn btn-secondary">Guardar</button>
</div>


<div class="nav-tabs-responsive">
  <ul class="nav nav-tabs-progress nav-tabs-4 mb-4">
    <li class="nav-item">
      <a href="#account" class="nav-link active" data-toggle="tab">
        <span class="font-lg">1.</span> Datos de titular
        <small class="d-block text-secondary">
          Lorem ipsum dolor sit amet, venenatis adipiscing
        </small>
      </a>
    </li>
    <li class="nav-item">
      <a href="#personal" class="nav-link" data-toggle="tab">
        <span class="font-lg">2.</span> Datos de garante
        <small class="d-block text-secondary">
          Lorem ipsum dolor sit amet, venenatis adipiscing
        </small>
      </a>
    </li>
    <li class="nav-item">
      <a href="#payment" class="nav-link" data-toggle="tab">
        <span class="font-lg">3.</span> Datos de demanda&embargo
        <small class="d-block text-secondary">
          Lorem ipsum dolor sit amet, venenatis adipiscing
        </small>
      </a>
    </li>
    <li class="nav-item">
      <a href="#confirmation" class="nav-link" data-toggle="tab">
        <span class="font-lg">4.</span> Otros Datos
        <small class="d-block text-secondary">
          Lorem ipsum dolor sit amet, venenatis adipiscing
        </small>
      </a>
    </li>
  </ul>
  <form id="formOrder" class="tab-content">
    <div id="account" class="tab-pane show active">
      <div class="mb-3">
        <a href="#account-collapse" data-toggle="collapse">
          <span class="font-lg">1.</span> Account information
          <small class="d-block text-secondary">
            Lorem ipsum dolor sit amet, venenatis adipiscing
          </small>
        </a>
      </div>
      <div id="account-collapse" class="collapse show" data-parent="#formOrder">
        
      <div class="row">
              <div class="col-12 col-md-4">
                  <div class="form-group">
                    <label for="titular">Titular:</label>
                    <input name="TITULAR" type="text" id="titular" class="form-control  ">
                  </div>
                  <div class="form-group">
                    <label for="ci">CI:</label>
                    <input name="CI" type="text" id="ci" class="form-control  ">
                  </div>
                  <div class="form-group">
                    <label for="direccion">Direccion:</label>
                    <input name="DIRECCION" type="text" id="direccion" class="form-control  ">
        </div>
              </div>
              <div class="col-12 col-md-4">
                  <div class="form-group">
                    <label for="telefono">Telefono:</label>
                    <input  name="TELEFONO" type="text" id="telefono" class="form-control  ">
                  </div>
                  <div class="form-group">
                    <label for="celular">Celular</label>
                    <input name="CELULAR" type="text" id="celular" class="form-control  ">
                  </div>
                  <div class="form-group">
                    <label for="laboral">Direccion laboral:</label>
                    <input name="LABORAL" type="text" id="laboral" class="form-control  ">
                  </div>
              </div>
              <div class="col-12 col-md-4">
                  <div class="form-group">
                  <label for="tel_trabaj">Telefono laboral:</label>
                  <input name="TEL_TRABAJ" type="text" id="tel_trabaj" class="form-control  ">
                </div>
              </div>
            </div>
       
       
         
       
      </div>
    </div>
    <div id="personal" class="tab-pane">
      <div class="mb-3">
        <a href="#personal-collapse" data-toggle="collapse">
          <span class="font-lg">2.</span> Personal information
          <small class="d-block text-secondary">
            Lorem ipsum dolor sit amet, venenatis adipiscing
          </small>
        </a>
      </div>
      <div id="personal-collapse" class="collapse" data-parent="#formOrder">
      <div class="row">
          <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="garante">Garante:</label>
                <input name="GARANTE" type="text" id="garante" class="form-control  ">
              </div>
              <div class="form-group">
                <label for="cigarante">CI Garante:</label>
                <input name="CI_GARANTE" type="text" id="cigarante" class="form-control  ">
              </div>
          </div>
          <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="dgarante">Direccion Garante:</label>
                <input name="DOM_GARANT" type="text" id="dgarante" class="form-control  ">
              </div>
              <div class="form-group">
                <label for="tgarante">Telefono Garante:</label>
                <input name="TEL_GARANT" type="text" id="tgarante" class="form-control  ">
              </div>
          </div>
          <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="tlabogarante">Tel.Lab.Garante:</label>
                <input name="TEL_LAB_G" type="text" id="tlabogarante" class="form-control  ">
              </div>
              <div class="form-group">
                <label for="dlabogarante">Dir.Lab.Garante:</label>
                <input name="LABORAL_G" type="text" id="dlabogarante" class="form-control  ">
              </div>
          </div>
        </div>

      </div>
    </div>
    <div id="payment" class="tab-pane">
      <div class="mb-3">
        <a href="#payment-collapse" data-toggle="collapse">
          <span class="font-lg">3.</span> Payment information
          <small class="d-block text-secondary">
            Lorem ipsum dolor sit amet, venenatis adipiscing
          </small>
        </a>
      </div>
      <div id="payment-collapse" class="collapse" data-parent="#formOrder">
      <div class="form-group">
                <label for="deman">Demanda:</label>
                <input name="JUEZ" type="text" id="deman" class="form-control" value="0">
              </div>
              <div class="form-group">
                <label for="saldo">Saldo:</label>
                <input name="JUEZ" type="text" id="saldo" class="form-control" value="0">
              </div>
              <div class="form-group">
                <label for="nroemb">Nro.de Embargo:</label>
                <input name="JUEZ" type="text" id="nroemb" class="form-control  ">
              </div>
              <div class="form-group">
                <label for="fechaemb">Fecha de embargo:</label>
                <input name="JUEZ" type="text" id="fechaemb" class="form-control  ">
              </div>
              <div class="form-group">
            <label for="origen">Origen:</label>
            <input name="O_DEMANDA" type="text" id="origen" class="form-control  ">
          </div>
          <div class="form-group">
            <label for="demandante">Demandante:</label>
            <input name="DEMANDANTE" type="text" id="demandante" class="form-control  ">
          </div>
              <div class="form-group">
                <label for="institu">Institucion:</label>
                <input name="JUEZ" type="text" id="institu" class="form-control  ">
              </div>
              <div class="form-group">
                <label for="juzgado">Juzgado:</label>
                <input name="JUEZ" type="text" id="juzgado" class="form-control  ">
              </div>
              <div class="form-group">
                <label for="domdenunciado">Domic. denunciado:</label>
                <input name="JUEZ" type="text" id="domdenunciado" class="form-control  ">
              </div>
              <div class="form-group">
                <label for="localdenun">Localidad de denunciado:</label>
                <input name="JUEZ" type="text" id="localdenun" class="form-control  ">
              </div>
              <div class="form-group">
                <label for="localgarante">Localidad del gte.:</label>
                <input name="JUEZ" type="text" id="localgarante" class="form-control  ">
              </div>
              <div class="form-group">
                <label for="domdenungte">Dom.Denun.Gte:</label>
                <input name="JUEZ" type="text" id="domdenungte" class="form-control  ">
              </div>
             
        
      </div>
    </div>
    <div id="confirmation" class="tab-pane">
      <div class="mb-3">
        <a href="#confirmation-collapse" data-toggle="collapse">
          <span class="font-lg">4.</span> Confirm your details
          <small class="d-block text-secondary">
            Lorem ipsum dolor sit amet, venenatis adipiscing
          </small>
        </a>
      </div>
      <div id="confirmation-collapse" class="collapse" data-parent="#formOrder">
      
          <div class="form-group">
            <label for="codemp">Cod. Emp.:</label>
            <input name="COD_EMP" type="text" id="codemp" class="form-control  ">
          </div>
          <div class="form-group">
            <label for="actuaria">Actuaria:</label>
            <input name="ACTUARIA" type="text" id="actuaria" class="form-control  ">
          </div>
          <div class="form-group">
            <label for="juez">Juez:</label>
            <input name="JUEZ" type="text" id="juez" class="form-control  ">
          </div>
          <div class="form-group">
                <label for="nrofinca">Nro.de finca:</label>
                <input name="JUEZ" type="text" id="nrofinca" class="form-control  ">
              </div>
              <div class="form-group">
                <label for="ctacte">Cta. Cte:</label>
                <input name="JUEZ" type="text" id="ctacte" class="form-control  ">
              </div>
              <div class="form-group">
                <label for="domdenungte">Banco:</label>
                <input name="JUEZ" type="text" id="domdenungte" class="form-control  ">
              </div>
              <div class="form-group">
                <label for="ctactecatas">Cta.Cte.Catastral:</label>
                <input name="JUEZ" type="text" id="ctactecatas" class="form-control  ">
              </div>
      </div>
    </div>
  </form>
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