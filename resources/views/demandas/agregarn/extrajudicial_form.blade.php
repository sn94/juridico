 
 
  <form  id="formExtrajudi"   method="post" action="<?= url("arreglo_extra")?>" onsubmit="enviarExtrajudi(event)">

  
   <?php if( $OPERACION != "V"): ?>
   
    <div class="row">
      <div class=" col-12 col-md-1">
      <button type="submit" class="btn btn-success btn-sm" >Guardar</button>
      </div>
      <div class="col-12 col-md-2">
        <div class="toast" role="alert" aria-live="polite" aria-atomic="true" data-delay="1000">
        <div role="alert" aria-live="assertive" aria-atomic="true" id="extra-msg">GUARDADO</div>
        </div>
      </div>
    </div>

<?php endif; ?>



  {{csrf_field()}} 

<div id="extrajudicial-panel">
</div>

<input id="IDNRO4"  type="hidden" name="IDNRO" value="{{isset($id_demanda)?$id_demanda:''}}"> 

      
<div class="row">

<div class="col-12 col-md-3">
<div class="form-group">
          <label for="ctactecatas">Tipo de arreglo extrajudicial:</label>
          <input name="TIPO"   value="{{ isset($ficha5)? $ficha5->TIPO : '' }}" type="text"  class="form-control form-control-sm"> 
</div>
</div>

<div class="col-12 col-md-3">
<div class="form-group">
          <label for="ctactecatas">Importe total del arreglo:</label>
          <input oninput="solo_numero(event)" value="{{isset($ficha5)? $ficha5->IMPORTE_T : '' }}"   name="IMPORTE_T"  type="text"   class="form-control form-control-sm"> 
</div>
</div>

<div class="col-12 col-md-3">
<div class="form-group">
          <label for="ctactecatas">Cantidad de cuotas:</label>
          <input oninput="solo_numero(event)" value="{{ isset($ficha5)? $ficha5->CANT_CUOTAS : '' }}"  name="CANT_CUOTAS" type="text"   class="form-control form-control-sm"> 
</div>
</div>

<div class="col-12 col-md-3 d-flex align-items-center">
<button onclick="calcular_cuotas()" type="button" class="btn btn-sm btn-info">GENERAR CUOTAS</button>

</div>
<table id="arreglojudi" class="table table-bordered">
  <thead><th>CUOTA</th><th>VENCIMIENTO</th><th>IMPORTE</th><th>FECHA_PAGO</th></thead>
  <tbody>

  
 <?php
  if(isset($ficha5)):

  $indi= 1;
  foreach( $ficha5->arreglo_extra_cuotas as $it):

  echo "
  <tr><td><input value='{$ficha5->IDNRO}' type='hidden' name='DETALLE[ARREGLO][]'>$indi</td>
  <td><input class='form-control form-control-sm' value='{$it->VENCIMIENTO}' name='DETALLE[VENCIMIENTO][]' type='date' /></td>
  <td><input name='DETALLE[IMPORTE][]' type='text' value='{$it->IMPORTE}' class='form-control form-control-sm'  readonly value='{$it->IMPORTE}'> </td>
  <td><input class='form-control form-control-sm' value='{$it->FECHA_PAGO}' type='date' name='DETALLE[FECHA_PAGO][]' /></td></tr>";
  $indi++;

  endforeach;
  endif; 
  ?>
  </tbody>
</table>
</div>



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
    let importe=$("#formExtrajudi input[name=IMPORTE_T]").val();
    let cant_c= $("#formExtrajudi input[name=CANT_CUOTAS]").val();

importe= numeroSinFormato( importe);
cant_c= numeroSinFormato( cant_c);

    let importe_cuota= parseInt( importe) /parseInt( cant_c);
    importe_cuota=  Math.round( importe_cuota);
    let idnro= $("#formExtrajudi input[name=IDNRO]").val();
    //Agregar filas
    for( let i=0; i< parseInt(cant_c) ; i++){
      
      $("#arreglojudi tbody")
      .append("<tr><td><input value='"+idnro+"' type='hidden' name='DETALLE[ARREGLO][]'>"+(i+1)+"</td><td><input class='form-control form-control-sm' name='DETALLE[VENCIMIENTO][]' type='date' /></td><td><input name='DETALLE[IMPORTE][]' type='text'  class='form-control form-control-sm'  readonly value='"+importe_cuota+"'> </td><td><input class='form-control form-control-sm' type='date' name='DETALLE[FECHA_PAGO][]' /></td></tr>");
    }
    
  }




  
function enviarExtrajudi( ev){ //ENVIO DE FORM OBSERVACION
 
 ev.preventDefault();  
 
       $.ajax(
       {
         url:  ev.target.action,
         method: "post",
         data: $("#"+ev.target.id).serialize(),
         dataType: "json",
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
         beforeSend: function(){
           $("#extrajudicial-panel").html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
         },
         success: function( res ){
            if( "error" in res){
               $("#extrajudicial-panel").html(  "" ); 
               alert(res.error);
             }else{ 
               //Mostrar mensaje 
               $("#extrajudicial-panel").html( "" ); //mensaje 
               $("#juri-msg").text( "GUARDADO!");
                $(".toast").toast("show"); 
             }
            
         },
         error: function(){
           $("#extrajudicial-panel").html( "" ); 
           alert("Problemas de conexión");
         }
       }
     );
 
}/** */


  </script>