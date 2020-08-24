 
 
  <form  id="formContra"   method="post" action="<?= url("eobser")?>" onsubmit="enviar3(event)">

  
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

<div id="contraparte-panel">
</div>

<input id="IDNRO3"  type="hidden" name="IDNRO" value="{{isset($id_demanda)?$id_demanda:''}}">
<input id="CI4" type="hidden" name="CI" value="{{isset($ci)?$ci:''}}">

      
<!---HERE -->
<div class="row">
  
  <div class="col-12 col-md-8"> 
    <div class="form-group">
        <label for="ctactecatas">Abogado:</label>
        <input maxlength="32" value="{{! isset($ficha3) ? '' : $ficha3->OBS_ABOGAD}}" name="OBS_ABOGAD" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
    
  </div>
</div> 


  </form>
  <script> 
  if( document.getElementById("operacion").value=="A" || document.getElementById("operacion").value=="A+")
  habilitarCampos('formContra',false);

  if( document.getElementById("operacion").value=="M"  )
  habilitarCampos('formContra',true);

  if( document.getElementById("operacion").value=="V"  )
  habilitarCampos('formContra',false);
  </script>