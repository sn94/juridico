 
 
  <form  id="formExtrajudi"   method="post" action="<?= url("eobser")?>" onsubmit="enviar3(event)">

  
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

<div id="extrajudicial-panel">
</div>

<input id="IDNRO4"  type="hidden" name="IDNRO" value="{{isset($id_demanda)?$id_demanda:''}}">
<input id="CI5" type="hidden" name="CI" value="{{isset($ci)?$ci:''}}">

      
<div class="row">

<div class="col-12 col-md-3">
<div class="form-group">
          <label for="ctactecatas">Tipo de arreglo extrajudicial:</label>
          <input name="TIPO"   type="text"  class="form-control form-control-sm"> 
</div>
</div>

<div class="col-12 col-md-3">
<div class="form-group">
          <label for="ctactecatas">Importe total del arreglo:</label>
          <input oninput="solo_numero(event)" name="IMPORTE"  type="text"   class="form-control form-control-sm"> 
</div>
</div>

<div class="col-12 col-md-3">
<div class="form-group">
          <label for="ctactecatas">Cantidad de cuotas:</label>
          <input oninput="solo_numero(event)" name="CANT_CUOTAS" type="text"   class="form-control form-control-sm"> 
</div>
</div>

<div class="col-12 col-md-3 d-flex align-items-center">
<button onclick="calcular_cuotas()" type="button" class="btn btn-sm btn-info">GENERAR CUOTAS</button>

</div>

</div>






<table id="arreglojudi" class="table table-bordered">
  <thead><th>CUOTA</th><th>VENCIMIENTO</th><th>IMPORTE</th><th>FECHA_PAGO</th></thead>
  <tbody>

  </tbody>
</table>

  </form>
  <script> 
  if( document.getElementById("operacion").value=="A" || document.getElementById("operacion").value=="A+")
  habilitarCampos('formExtrajudi',false);

  if( document.getElementById("operacion").value=="M"  )
  habilitarCampos('formExtrajudi',true);

  if( document.getElementById("operacion").value=="V"  )
  habilitarCampos('formExtrajudi',false);



  function calcular_cuotas(){
    $("#arreglojudi tbody").empty();
    let importe=$("#formExtrajudi input[name=IMPORTE]").val();
    let cant_c= $("#formExtrajudi input[name=CANT_CUOTAS]").val();

importe= numeroSinFormato( importe);
cant_c= numeroSinFormato( cant_c);

    let importe_cuota= parseInt( importe) /parseInt( cant_c);
    importe_cuota=  Math.round( importe_cuota);
    //Agregar filas
    for( let i=0; i< parseInt(cant_c) ; i++){
      $("#arreglojudi tbody")
      .append("<tr><td>"+(i+1)+"</td><td><input type='date' /></td><td>"+importe_cuota+"</td><td><input type='date' /></td></tr>");
    }
    
  }
  </script>