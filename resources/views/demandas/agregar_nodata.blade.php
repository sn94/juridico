@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">AGREGAR</li> 
@endsection

@section('content')





<form id="formDeman" class="tab-content" method="post" action="<?=url("demandas-agregar")?>">

{{csrf_field()}}

<button type="submit" class="btn btn-success" >Guardar</button>

<input type="hidden" name="CI"  >

<!-- Aqui colocar los campos para seleccionar persona -->
<div class="row">
  <div class="col-12 col-md-1">
    <div class="form-group">
        <label for="origen">Demandado CI°:</label>
        <input name="CI" type="text"   class="form-control form-control-sm   ">
    </div> 
  </div>
</div>
 
<div class="row">
          <div class="col-12 col-md-3">
              <div class="form-group">
                <label for="origen">Origen:</label>
                <input name="O_DEMANDA" type="text" id="origen" class="form-control form-control-sm   ">
              </div>
                <div class="form-group">
                  <label for="demandante">Demandante:</label>
                  <input name="DEMANDANTE" type="text" id="demandante" class="form-control form-control-sm   ">
                </div>
                
                <div class="form-group">
                  <label for="codemp">Cod. Emp.:</label>
                  <input name="COD_EMP" type="text" id="codemp" class="form-control form-control-sm   ">
                </div>
                <div class="form-group">
                  <label for="actuaria">Actuaria:</label>
                  <input name="ACTUARIA" type="text" id="actuaria" class="form-control form-control-sm   ">
                </div>
                <div class="form-group">
                  <label for="juez">Juez:</label>
                  <input name="JUEZ" type="text" id="juez" class="form-control form-control-sm   ">
                </div>
          </div>
          <div class="col-12 col-md-3">
                <div class="form-group">
                  <label for="deman">Demanda:</label>
                  <input name="DEMANDA" type="text" id="deman" class="form-control form-control-sm " value="0">
                </div>
                <div class="form-group">
                  <label for="saldo">Saldo:</label>
                  <input name="SALDO" type="text" id="saldo" class="form-control form-control-sm " value="0">
                </div>
                <div class="form-group">
                  <label for="nroemb">Nro.de Embargo:</label>
                  <input name="EMBARGO_NR" type="text" id="nroemb" class="form-control form-control-sm   ">
                </div>
                <div class="form-group">
                  <label for="fechaemb">Fecha de embargo:</label>
                  <input value="2018-07-22" 	min="2000-01-01" max="2050-12-31" name="FEC_EMBARG" type="date" id="fechaemb" class="form-control form-control-sm   ">
                </div>
                <div class="form-group">
                  <label for="institu">Institucion:</label>
                  <input name="INSTITUCIO" type="text" id="institu" class="form-control form-control-sm   ">
                </div>
          </div>
          <div class="col-12 col-md-3">
            
                <div class="form-group">
                  <label for="juzgado">Juzgado:</label>
                  <input name="JUZGADO" type="text" id="juzgado" class="form-control form-control-sm   ">
                </div>
                <div class="form-group">
                  <label for="domdenunciado">Domic. denunciado:</label>
                  <input name="DOC_DENUNC" type="text" id="domdenunciado" class="form-control form-control-sm   ">
                </div>
                <div class="form-group">
                  <label for="localdenun">Localidad de denunciado:</label>
                  <input name="LOCALIDAD" type="text" id="localdenun" class="form-control form-control-sm   ">
                </div>
                <div class="form-group">
                  <label for="localgarante">Localidad del gte.:</label>
                  <input name="LOCALIDA_G" type="text" id="localgarante" class="form-control form-control-sm   ">
                </div>
                <div class="form-group">
                  <label for="domdenungte">Dom.Denun.Gte:</label>
                  <input name="DOC_DEN_GA" type="text" id="domdenungte" class="form-control form-control-sm   ">
                </div>
          </div>
          <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label for="nrofinca">Nro.de finca:</label>
                    <input name="FINCA_NRO" type="text" id="nrofinca" class="form-control form-control-sm   ">
                  </div>
                  <div class="form-group">
                    <label for="ctacte">Cta. Cte:</label>
                    <input name="CTA_BANCO" type="text" id="ctacte" class="form-control form-control-sm   ">
                  </div>
                  <div class="form-group">
                    <label for="domdenungte">Banco:</label>
                    <input name="BANCO" type="text" id="domdenungte" class="form-control form-control-sm   ">
                  </div>
                  <div class="form-group">
                    <label for="ctactecatas">Cta.Cte.Catastral:</label>
                    <input name="CTA_CATAST" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                  </div>
          </div>
        </div>
</form>

  

  
@endsection



<script>
 


function enviar( ev){
  ev.preventDefault();
  $.ajax(
    {
      url:"<?= url("demandas-agregar")?>",
      method: "post",
      data: $("#formDeman").serialize(),
      
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      beforeSend: function(){
        $("#showSpinner").html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
      },
      success: function( res ){
        $("#showSpinner").html( res  ); //mensaje
        //$("#formDeman").reset();//limpiar formulario
      },
      error: function(){
        $("#showSpinner").html(  "" ); 
      }
    }
  );
}




 
       
    </script>