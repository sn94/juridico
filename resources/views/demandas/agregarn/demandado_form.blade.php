
<?php

$RUTA= $OPERACION == "A" ? url("ndemandado") : url("edemandado/$ci");

?>

<form  id="form-person" onsubmit="enviarDatosPerso(event)" method="post" action="<?= $RUTA ?>">

{{csrf_field()}}

<div id="mensaje"></div>
<input class="btn btn-success btn-sm" type="submit" value="Guardar">
<div class="row">

<div class="col-12 col-md-6">
      <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="titular">Titular:</label>
              <input value="{{! isset($ficha0) ? '' : $ficha0->TITULAR}}" name="TITULAR" type="text" id="titular" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="ci">CI:</label>
              <input  value="{{! isset($ficha0) ? '' : $ficha0->CI}}" name="CI" type="text" id="ci" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="direccion">Direccion:</label>
              <input  value="{{! isset($ficha0) ? '' : $ficha0->DOMICILIO}}" name="DOMICILIO" type="text" id="direccion" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="telefono">Telefono:</label>
              <input value="{{! isset($ficha0) ? '' : $ficha0->TELEFONO}}" name="TELEFONO" type="text" id="telefono" class="form-control form-control-sm   ">
            </div>
        </div>
        <div class="col-12 col-md-6">
            
            <div class="form-group">
              <label for="celular">Celular</label>
              <input value="{{! isset($ficha0) ? '' : $ficha0->CELULAR}}" name="CELULAR" type="text" id="celular" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="laboral">Direccion laboral:</label>
              <input value="{{! isset($ficha0) ? '' : $ficha0->LABORAL}}"  name="LABORAL" type="text" id="laboral" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
            <label for="tel_trabaj">Telefono laboral:</label>
            <input value="{{! isset($ficha0) ? '' : $ficha0->TEL_TRABAJ}}" name="TEL_TRABAJ" type="text" id="tel_trabaj" class="form-control form-control-sm   ">
            </div>
        </div>
        
      </div>
</div>
<div class="col-12 col-md-6">
    <div class="row">
      <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="garante">Garante:</label>
            <input value="{{! isset($ficha0) ? '' : $ficha0->GARANTE}}"  name="GARANTE" type="text" id="garante" class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="cigarante">CI Garante:</label>
            <input value="{{! isset($ficha0) ? '' : $ficha0->CI_GARANTE}}"  name="CI_GARANTE" type="text" id="cigarante" class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="dgarante">Direccion Garante:</label>
            <input value="{{! isset($ficha0) ? '' : $ficha0->DOM_GARANT}}"  name="DOM_GARANT" type="text" id="dgarante" class="form-control form-control-sm   ">
          </div>
      </div>
      <div class="col-12 col-md-6">
      
          <div class="form-group">
            <label for="tgarante">Telefono Garante:</label>
            <input value="{{! isset($ficha0) ? '' : $ficha0->TEL_GARANT}}" name="TEL_GARANT" type="text" id="tgarante" class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="tlabogarante">Tel.Lab.Garante:</label>
            <input value="{{! isset($ficha0) ? '' : $ficha0->TEL_LAB_G}}" name="TEL_LAB_G" type="text" id="tlabogarante" class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="dlabogarante">Dir.Lab.Garante:</label>
            <input value="{{! isset($ficha0) ? '' : $ficha0->LABORAL_G}}" name="LABORAL_G" type="text" id="dlabogarante" class="form-control form-control-sm   ">
          </div>
      </div>
     
    </div>
</div>
</div>


 
</form>
 
  
