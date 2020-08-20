
<?php

$RUTA= $OPERACION == "A" ? url("ndemandado") : url("edemandado");

?>

<form  id="form-person" onsubmit="enviarDatosPerso(event)" method="post" action="<?= $RUTA ?>">

{{csrf_field()}}



<div id="persona-panel"></div>


<?php if( $OPERACION != "V"): ?>
    
    <div class="row">
      <div class=" col-12 col-md-1">
      <button type="submit" class="btn btn-success btn-sm mb-1" >Guardar</button>
      </div>
      <div class="col-12 col-md-2">
        <div class="toast" role="alert" aria-live="polite" aria-atomic="true" data-delay="1000">
        <div role="alert" aria-live="assertive" aria-atomic="true" id="pers-msg">GUARDADO</div>
        </div>
      </div>
    </div>


<?php endif; ?>

 
<div class="row">

<div class="col-12 col-md-6" style="background-color: #81c784; border-color: #87a8f5;">
      <div class="row" >
        <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="titular">Titular:</label>
              <input maxlength="60" value="{{! isset($ficha0) ? '' : $ficha0->TITULAR}}" name="TITULAR" type="text" id="titular" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="ci">CI:</label>
              <input type="hidden" id="CI-DEFAULT" value="{{! isset($ficha0) ? '' : $ficha0->CI}}">
              <input oninput="solo_numero(event)" maxlength="9"  value="{{! isset($ficha0) ? '' : $ficha0->CI}}" name="CI" type="text" id="ci" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="direccion">Direccion:</label>
              <input maxlength="78" value="{{! isset($ficha0) ? '' : $ficha0->DOMICILIO}}" name="DOMICILIO" type="text" id="direccion" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="telefono">Telefono:</label>
              <input maxlength="20" value="{{! isset($ficha0) ? '' : $ficha0->TELEFONO}}" name="TELEFONO" type="text" id="telefono" class="form-control form-control-sm   ">
            </div>
        </div>
        <div class="col-12 col-md-6">
            
            <div class="form-group">
              <label for="celular">Celular</label>
              <input maxlength="20" value="{{! isset($ficha0) ? '' : $ficha0->CELULAR}}" name="CELULAR" type="text"   class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="laboral">Lugar de trabajo:</label>
              <input maxlength="30" value="{{! isset($ficha0) ? '' : $ficha0->TRABAJO}}"  name="TRABAJO" type="text"   class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="laboral">Direccion laboral:</label>
              <input maxlength="79" value="{{! isset($ficha0) ? '' : $ficha0->LABORAL}}"  name="LABORAL" type="text"   class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
            <label for="tel_trabaj">Telefono laboral:</label>
            <input maxlength="21" value="{{! isset($ficha0) ? '' : $ficha0->TEL_TRABAJ}}" name="TEL_TRABAJ" type="text" id="tel_trabaj" class="form-control form-control-sm   ">
            </div>
        </div>
        
      </div>
</div>
<div class="col-12 col-md-6" style="background-color: #aed581; border-color: #78fc8c;">
    <div class="row" >
      <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="garante">Garante:</label>
            <input maxlength="35" value="{{! isset($ficha0) ? '' : $ficha0->GARANTE}}"  name="GARANTE" type="text" id="garante" class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="cigarante">CI Garante:</label>
            <input maxlength="9" value="{{! isset($ficha0) ? '' : $ficha0->CI_GARANTE}}"  name="CI_GARANTE" type="text" id="cigarante" class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="dgarante">Direccion Garante:</label>
            <input maxlength="75" value="{{! isset($ficha0) ? '' : $ficha0->DOM_GARANT}}"  name="DOM_GARANT" type="text" id="dgarante" class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="tgarante">Telefono Garante:</label>
            <input  maxlength="20" value="{{! isset($ficha0) ? '' : $ficha0->TEL_GARANT}}" name="TEL_GARANT" type="text" id="tgarante" class="form-control form-control-sm   ">
          </div>
      </div>
      <div class="col-12 col-md-6">
      
      <div class="form-group">
            <label for="dlabogarante">Celular Garante:</label>
            <input maxlength="20" value="{{! isset($ficha0) ? '' : $ficha0->CEL_GARANT}}" name="CEL_GARANT" type="text"   class="form-control form-control-sm   ">
          </div>

      <div class="form-group">
            <label for="dlabogarante">Trabajo/Garante:</label>
            <input maxlength="30" value="{{! isset($ficha0) ? '' : $ficha0->TRABAJO_G}}" name="TRABAJO_G" type="text"   class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="dlabogarante">Dir.Lab.Garante:</label>
            <input maxlength="75" value="{{! isset($ficha0) ? '' : $ficha0->LABORAL_G}}" name="LABORAL_G" type="text"   class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="tlabogarante">Tel.Lab.Garante:</label>
            <input maxlength="20" value="{{! isset($ficha0) ? '' : $ficha0->TEL_LAB_G}}" name="TEL_LAB_G" type="text"   class="form-control form-control-sm   ">
          </div>
      </div>
     
    </div>
</div>
</div>

<div class="row"  style="background-color: #a5d6a7; border-color: #87a8f5;">
<div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
                 <label for="actuaria">Domic.denunciado:</label>
                  <input name="DOC_DENUNC"   type="text"   class="form-control form-control-sm" value="{{ !isset($ficha0)? '' : $ficha0->DOC_DENUNC}}">
             </div> 
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
                 <label for="actuaria">Localidad:</label>
                 <select name="LOCALIDAD" class="form-control form-control-sm">
                    <?php 

                     $loc=  !isset($ficha0)? '' : $ficha0->LOCALIDAD;
                    foreach($localidades as $it): 
                         if( $loc == $it->DESCR || $loc == $it->IDNRO)//Ojo
                           echo "<option selected value='{$it->IDNRO}'>{$it->DESCR}</option>"; 
                         else{
                              echo "<option value='{$it->IDNRO}'>{$it->DESCR}</option>";      
                         }
                         
                    endforeach;  ?>
             </select> 
         </div>
    </div>

    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
                 <label for="actuaria">Dom.denun.Gte:</label>
                  <input  name="DOC_DEN_GA"  type="text"   class="form-control form-control-sm" value="{{ !isset($ficha0)? '' : $ficha0->DOC_DEN_GA}}">
         </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
             <label for="actuaria">Localidad del Gte.:</label>
             <select name="LOCALIDA_G" class="form-control form-control-sm">
                    <?php 

                     $loc=  !isset($ficha0)? '' : $ficha0->LOCALIDA_G;
                    foreach($localidades as $it): 
                         if( $loc == $it->DESCR || $loc == $it->IDNRO)//Ojo
                           echo "<option selected value='{$it->IDNRO}'>{$it->DESCR}</option>"; 
                         else{
                              echo "<option value='{$it->IDNRO}'>{$it->DESCR}</option>";      
                         }
                         
                    endforeach;  ?>
             </select>  
         </div>
    </div>
   
</div>

 
</form>
 
<script>
  var operacSt= document.getElementById("operacion").value;
if(    operacSt == "V")
habilitarCampos('form-person',false);

</script>
