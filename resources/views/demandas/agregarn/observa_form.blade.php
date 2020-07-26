 


<?php

$ruta= $OPERACION == "A" ? url("nobser"): url("eobser") ;
?>


  <form id="formObser"   method="post" action="<?= $ruta?>" onsubmit="enviar3(event)">

   <button type="submit" class="btn btn-info btn-sm"  >Guardar</button>
 
 


  {{csrf_field()}} 

  

<input id="IDNRO2"  type="hidden" name="IDNRO" value="{{isset($id_demanda)?$id_demanda:''}}">
<input id="CI3" type="hidden" name="CI" value="{{isset($ci)?$ci:''}}">

      
<!---HERE -->
<div class="row">
  <div class="col-12 col-md-4">
      <div class="form-group">
          <label for="ctactecatas">Tercer garante:</label>
          <input value="{{! isset($ficha3) ? '' : $ficha3->GARANTE_3}}" name="GARANTE_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
      </div>
      <div class="form-group">
        <label for="ctactecatas">Domicilio:</label>
        <input value="{{! isset($ficha3) ? '' : $ficha3->DIR_GAR_3}}" name="DIR_GAR_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
  </div>
  <div class="col-12 col-md-4">
    <div class="form-group">
        <label for="ctactecatas">Cedula:</label>
        <input  oninput="formatear(this)"  value="{{! isset($ficha3) ? '' : $ficha3->CI_GAR_3}}" name="CI_GAR_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
    <div class="form-group">
        <label for="ctactecatas">Teléfono:</label>
        <input value="{{! isset($ficha3) ? '' : $ficha3->TEL_GAR_3}}" name="TEL_GAR_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
  </div>
  <div class="col-12 col-md-4">
    <div class="form-group">
        <label for="ctactecatas">Abogado:</label>
        <input value="{{! isset($ficha3) ? '' : $ficha3->OBS_ABOGAD}}" name="OBS_ABOGAD" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
    <div class="form-group">
        <label for="ctactecatas">Preventivo:</label>
        <input value="{{! isset($ficha3) ? '' : $ficha3->OBS_PREVEN}}" name="OBS_PREVEN" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
    <div class="form-group">
        <label for="ctactecatas">Ejecutivo:</label>
        <input  value="{{! isset($ficha3) ? '' : $ficha3->OBS_EJECUT}}" name="OBS_EJECUT" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
  </div>
</div> 


  </form>