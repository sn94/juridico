 
 
  <form  id="formObser"   method="post" action="<?= url("eobser")?>" onsubmit="enviar3(event)">

  
   <?php if( $OPERACION != "V"): ?>
    <button type="submit" class="btn btn-success btn-sm" >Guardar</button>

<?php endif; ?>



  {{csrf_field()}} 

  

<input id="IDNRO2"  type="hidden" name="IDNRO" value="{{isset($id_demanda)?$id_demanda:''}}">
<input id="CI3" type="hidden" name="CI" value="{{isset($ci)?$ci:''}}">

      
<!---HERE -->
<div class="row">
  <div class="col-12 col-md-4">
  <div class="form-group">
        <label for="ctactecatas">Cedula:</label>
        <input  oninput="formatear(event)"  value="{{! isset($ficha3) ? '' : $ficha3->CI_GAR_3}}" name="CI_GAR_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
      <div class="form-group">
          <label for="ctactecatas">Tercer garante:</label>
          <input value="{{! isset($ficha3) ? '' : $ficha3->GARANTE_3}}" name="GARANTE_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
      </div>
      <div class="form-group">
        <label for="ctactecatas">Domicilio:</label>
        <input value="{{! isset($ficha3) ? '' : $ficha3->DIR_GAR_3}}" name="DIR_GAR_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
    <div class="form-group">
        <label for="ctactecatas">Teléfono:</label>
        <input value="{{! isset($ficha3) ? '' : $ficha3->TEL_GAR_3}}" name="TEL_GAR_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
  </div>
  <div class="col-12 col-md-8"> 
    <div class="form-group">
        <label for="ctactecatas">Abogado:</label>
        <input value="{{! isset($ficha3) ? '' : $ficha3->OBS_ABOGAD}}" name="OBS_ABOGAD" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
          <div class="form-group">
          <label for="ctactecatas">Preventivo:</label>
          <textarea name="OBS_PREVEN"   cols="30" rows="5" class="form-control form-control-sm   ">
            {{! isset($ficha3) ? '' : $ficha3->OBS_PREVEN}}</textarea> 
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="form-group">
          <label for="ctactecatas">Ejecutivo:</label>
          <textarea name="OBS_EJECUT"   cols="30" rows="5" class="form-control form-control-sm   ">
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