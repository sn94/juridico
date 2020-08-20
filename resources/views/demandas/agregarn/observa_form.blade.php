 
 
  <form  id="formObser"   method="post" action="<?= url("eobser")?>" onsubmit="enviar3(event)">

  
   <?php if( $OPERACION != "V"): ?>
   
    <div class="row">
      <div class=" col-12 col-md-1">
      <button type="submit" class="btn btn-success btn-sm" >Guardar</button>
      </div>
      <div class="col-12 col-md-2">
        <div class="toast" role="alert" aria-live="polite" aria-atomic="true" data-delay="1000">
        <div role="alert" aria-live="assertive" aria-atomic="true" id="obse-msg">GUARDADO</div>
        </div>
      </div>
    </div>

<?php endif; ?>



  {{csrf_field()}} 

<div id="observacion-panel">
</div>

<input id="IDNRO2"  type="hidden" name="IDNRO" value="{{isset($id_demanda)?$id_demanda:''}}">
<input id="CI3" type="hidden" name="CI" value="{{isset($ci)?$ci:''}}">

      
<!---HERE -->
<div class="row">
  <div class="col-12 col-md-4">
  <div class="form-group">
        <label for="ctactecatas">Cedula de Garante:</label>
        <input maxlength="8"  oninput="solo_numero(event)"  value="{{! isset($ficha3) ? '' : $ficha3->CI_GAR_3}}" name="CI_GAR_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
      <div class="form-group">
          <label for="ctactecatas">Tercer garante:</label>
          <input maxlength="35" value="{{! isset($ficha3) ? '' : $ficha3->GARANTE_3}}" name="GARANTE_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
      </div>
      <div class="form-group">
        <label for="ctactecatas">Domicilio:</label>
        <input maxlength="50" value="{{! isset($ficha3) ? '' : $ficha3->DIR_GAR_3}}" name="DIR_GAR_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
    <div class="form-group">
        <label for="ctactecatas">Teléfono:</label>
        <input maxlength="17" value="{{! isset($ficha3) ? '' : $ficha3->TEL_GAR_3}}" name="TEL_GAR_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
  </div>
  <div class="col-12 col-md-8"> 
    <div class="form-group">
        <label for="ctactecatas">Abogado:</label>
        <input maxlength="32" value="{{! isset($ficha3) ? '' : $ficha3->OBS_ABOGAD}}" name="OBS_ABOGAD" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
          <div class="form-group">
          <label for="ctactecatas">Preventivo:</label>
          <textarea maxlength="100" name="OBS_PREVEN"   cols="30" rows="5" class="form-control form-control-sm   ">
            {{! isset($ficha3) ? '' : $ficha3->OBS_PREVEN}}</textarea> 
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="form-group">
          <label for="ctactecatas">Ejecutivo:</label>
          <textarea maxlength="100" name="OBS_EJECUT"   cols="30" rows="5" class="form-control form-control-sm   ">
            {{! isset($ficha3) ? '' : $ficha3->OBS_EJECUT}}</textarea> 
          </div>
        </div>
    </div>
    
    
  </div>
</div> 


  </form>
  <script> 
  if( document.getElementById("operacion").value=="A" || document.getElementById("operacion").value=="A+")
  habilitarCampos('formObser',false);

  if( document.getElementById("operacion").value=="M"  )
  habilitarCampos('formObser',true);

  if( document.getElementById("operacion").value=="V"  )
  habilitarCampos('formObser',false);
  </script>