@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">DEMANDADOS</li> 
@endsection

@section('content')

<h3>DATOS PERSONALES - DEMANDADO</h3>
<form id="formDeman"  method="post" action="<?=url("ndemandado")?>">

{{csrf_field()}}

<input class="btn btn-success btn-sm" type="submit" value="ENVIAR">
<div class="row">

<div class="col-12 col-md-6">
      <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="titular">Titular:</label>
              <input name="TITULAR" type="text" id="titular" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="ci">CI:</label>
              <input name="CI" type="text" id="ci" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="direccion">Direccion:</label>
              <input name="DOMICILIO" type="text" id="direccion" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="telefono">Telefono:</label>
              <input  name="TELEFONO" type="text" id="telefono" class="form-control form-control-sm   ">
            </div>
        </div>
        <div class="col-12 col-md-6">
            
            <div class="form-group">
              <label for="celular">Celular</label>
              <input name="CELULAR" type="text" id="celular" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="laboral">Direccion laboral:</label>
              <input name="LABORAL" type="text" id="laboral" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
            <label for="tel_trabaj">Telefono laboral:</label>
            <input name="TEL_TRABAJ" type="text" id="tel_trabaj" class="form-control form-control-sm   ">
            </div>
        </div>
        
      </div>
</div>
<div class="col-12 col-md-6">
    <div class="row">
      <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="garante">Garante:</label>
            <input name="GARANTE" type="text" id="garante" class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="cigarante">CI Garante:</label>
            <input name="CI_GARANTE" type="text" id="cigarante" class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="dgarante">Direccion Garante:</label>
            <input name="DOM_GARANT" type="text" id="dgarante" class="form-control form-control-sm   ">
          </div>
      </div>
      <div class="col-12 col-md-6">
      
          <div class="form-group">
            <label for="tgarante">Telefono Garante:</label>
            <input name="TEL_GARANT" type="text" id="tgarante" class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="tlabogarante">Tel.Lab.Garante:</label>
            <input name="TEL_LAB_G" type="text" id="tlabogarante" class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="dlabogarante">Dir.Lab.Garante:</label>
            <input name="LABORAL_G" type="text" id="dlabogarante" class="form-control form-control-sm   ">
          </div>
      </div>
     
    </div>
</div>
</div>


 
</form>


  
@endsection



<script>




document.onreadystatechange = () => {
  if (document.readyState === 'complete') {
    // document ready
    $('#demandatable').DataTable();
  }
};


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




function showMenuBanco(){
  
}
       
    </script>