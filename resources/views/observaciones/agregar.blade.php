 
 
  <form onsubmit="enviar3(event)" id="formDeman2"   method="post" action="<?=url("nobser")?>">

  
 


  {{csrf_field()}} 

  

<input id="id_demanda3" type="hidden" name="IDNRO"  >
<input type="hidden" name="CI"  id="ci3">

    
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
    <div class="form-group">
        <label for="ctactecatas">Cedula:</label>
        <input  oninput="formatear(this)"  name="CI_GAR_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
  </div>
  <div class="col-12 col-md-4">
   
    <div class="form-group">
        <label for="ctactecatas">Teléfono:</label>
        <input name="TEL_GAR_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
    <div class="form-group">
        <label for="ctactecatas">Abogado:</label>
        <input name="OBS_ABOGAD" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
    <div class="form-group">
        <label for="ctactecatas">Preventivo:</label>
        <input name="OBS_PREVEN" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
  </div>
  <div class="col-12 col-md-4">
   

    <div class="form-group">
        <label for="ctactecatas">Ejecutivo:</label>
        <input name="OBS_EJECUT" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
    
  <button type="submit" class="btn btn-info"  >GUARDAR</button>
 
  </div>
</div> 
  </form>
</div>





 