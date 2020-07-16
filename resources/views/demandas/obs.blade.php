@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">NUEVA OBSERVACIÓN</li> 
@endsection

@section('content')





<form id="formDeman" class="tab-content" method="post" action="<?=url("demandas-agregar/$ci")?>">

{{csrf_field()}}

<button type="submit" class="btn btn-success" >Guardar</button>

<input type="hidden" name="CI"  value="{{$ci}}">

<div class="row">
  <div class="col-12 col-md-1">
  <h4>{{$ci}}</h4>
  </div>
  <div class="col-12 col-md-11">
  <h4>{{$nombre}}</h4>
  </div>
</div>
 
<!---HERE -->
<div class="row">
  <div class="col-12 col-md-4">
      <div class="form-group">
          <label for="ctactecatas">Tercer garante:</label>
          <input name="GARANTE_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
      </div>
      <div class="form-group">
        <label for="ctactecatas">Domicilio:</label>
        <input name="DIR_GAR_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
  </div>
  <div class="col-12 col-md-4">
    <div class="form-group">
        <label for="ctactecatas">Cedula:</label>
        <input name="CI_GAR_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
    <div class="form-group">
        <label for="ctactecatas">Teléfono:</label>
        <input name="TEL_GAR_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
  </div>
  <div class="col-12 col-md-4">
    <div class="form-group">
        <label for="ctactecatas">Abogado:</label>
        <input name="OBS_ABOGAD" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
    <div class="form-group">
        <label for="ctactecatas">Preventivo:</label>
        <input name="OBS_PREVEN" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
    <div class="form-group">
        <label for="ctactecatas">Ejecutivo:</label>
        <input name="OBS_EJECUT" type="text" id="ctactecatas" class="form-control form-control-sm   ">
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