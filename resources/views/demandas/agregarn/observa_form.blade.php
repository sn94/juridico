 
 
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

      

<div class="form-group col-12 col-md-6">
          <label for="ctactecatas">Preventivo:</label>
          <textarea maxlength="100" name="OBS_PREVEN"   cols="30" rows="3" class="form-control form-control-sm   ">
            {{! isset($ficha3) ? '' : $ficha3->OBS_PREVEN}}</textarea> 
          </div>


          <div class="form-group col-12 col-md-6">
          <label for="ctactecatas">Ejecutivo:</label>
          <textarea maxlength="100" name="OBS_EJECUT"   cols="30" rows="3" class="form-control form-control-sm   ">
            {{! isset($ficha3) ? '' : $ficha3->OBS_EJECUT}}</textarea> 
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