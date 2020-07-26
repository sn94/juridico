@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">DEMANDADOS</li> 
@endsection

@section('content')
 
<form id="formDeman"  method="post" action="<?=url("edemandado/$lastid")?>">

{{csrf_field()}}

<div id="mensaje"></div>

<input class="btn btn-success btn-sm" type="submit" value="GUARDAR">
<div class="row">

<div class="col-12 col-md-6">
      <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="titular">Titular:</label>
              <input value="{{$ficha->TITULAR}}" name="TITULAR" type="text" id="titular" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="ci">CI:</label>
              <input  value="{{$ficha->CI}}" name="CI" type="text" id="ci" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="direccion">Direccion:</label>
              <input  value="{{$ficha->DOMICILIO}}" name="DOMICILIO" type="text" id="direccion" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="telefono">Telefono:</label>
              <input value="{{$ficha->TELEFONO}}" name="TELEFONO" type="text" id="telefono" class="form-control form-control-sm   ">
            </div>
        </div>
        <div class="col-12 col-md-6">
            
            <div class="form-group">
              <label for="celular">Celular</label>
              <input value="{{$ficha->CELULAR}}" name="CELULAR" type="text" id="celular" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="laboral">Direccion laboral:</label>
              <input value="{{$ficha->LABORAL}}"  name="LABORAL" type="text" id="laboral" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
            <label for="tel_trabaj">Telefono laboral:</label>
            <input value="{{$ficha->TEL_TRABAJ}}" name="TEL_TRABAJ" type="text" id="tel_trabaj" class="form-control form-control-sm   ">
            </div>
        </div>
        
      </div>
</div>
<div class="col-12 col-md-6">
    <div class="row">
      <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="garante">Garante:</label>
            <input value="{{$ficha->GARANTE}}"  name="GARANTE" type="text" id="garante" class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="cigarante">CI Garante:</label>
            <input value="{{$ficha->CI_GARANTE}}"  name="CI_GARANTE" type="text" id="cigarante" class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="dgarante">Direccion Garante:</label>
            <input value="{{$ficha->DOM_GARANT}}"  name="DOM_GARANT" type="text" id="dgarante" class="form-control form-control-sm   ">
          </div>
      </div>
      <div class="col-12 col-md-6">
      
          <div class="form-group">
            <label for="tgarante">Telefono Garante:</label>
            <input value="{{$ficha->TEL_GARANT}}" name="TEL_GARANT" type="text" id="tgarante" class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="tlabogarante">Tel.Lab.Garante:</label>
            <input value="{{$ficha->TEL_LAB_G}}" name="TEL_LAB_G" type="text" id="tlabogarante" class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="dlabogarante">Dir.Lab.Garante:</label>
            <input value="{{$ficha->LABORAL_G}}" name="LABORAL_G" type="text" id="dlabogarante" class="form-control form-control-sm   ">
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