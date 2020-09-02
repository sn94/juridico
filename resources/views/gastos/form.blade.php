

<?php 
 
use App\Helpers\Helper; 

?>


<h6  style=" background-color: #041402; color: white;"  class="text-center">
CARGA DE GASTOS
</h6>

<form id="gastosform" onsubmit="guardar(event)" action="{{$RUTA}}" method="post">

@csrf
<?php if( isset($OPERACION) && $OPERACION == "M"): ?>
<input type="hidden" name="IDNRO" value="{{$dato->IDNRO}}" >
<?php endif;?>

 

<p id="mensaje" style="text-align: center; font-weight: bold; color: #05560c;"></p>

<div class="row p-2">
<div class="col-12 col-md-12">
        <label >CÓD. DE GASTO:</label>
        @if ($OPERACION == "A")
        {!! Form::select('CODIGO', $CODGASTO, null, ['class'=>'form-control form-control-sm']  ) !!} 
       @endif
       @if ($OPERACION == "M")
        {!! Form::select('CODIGO', $CODGASTO, $dato->CODIGO, ['class'=>'form-control form-control-sm']  ) !!} 
       @endif
         
    </div>
    <div class="col-12 col-md-12">
        <label >FECHA:</label>
        <input   value="{{isset($dato->FECHA) ? $dato->FECHA : '' }}" name="FECHA"  type="date"  class="form-control form-control-sm">
    </div>
    <div class="col-12 col-md-12"> 
        <label >N° DE DOCUMENTO:</label>
        <input maxlength="10"  value="{{isset($dato->NUMERO)? $dato->NUMERO: ''}}" name="NUMERO"  type="text"  class="form-control form-control-sm">
     </div>
     <div class="col-12 col-md-12"> 
        <label >IMPORTE:</label>
        <input  oninput="solo_numero(event)" maxlength="10"  value="{{isset($dato->IMPORTE)? Helper::number_f($dato->IMPORTE) : ''}}" name="IMPORTE"  type="text"  class="form-control form-control-sm number-format">
     </div>
    <div class="col-12 col-md-12">
        <label >DESCRIPCIÓN:</label>
        <input maxlength="50" value="{{isset($dato->DETALLE1)?$dato->DETALLE1: ''}}" name="DETALLE1"  type="text"  class="form-control form-control-sm">
        <input maxlength="46"   value="{{isset($dato->DETALLE2)?$dato->DETALLE2: ''}}" name="DETALLE2"  type="text"  class="form-control form-control-sm">
    </div>

    <div class="col-12 col-md-12 d-flex align-items-center mt-1">
    <button class="btn btn-sm btn-info" type="submit">GUARDAR</button>
    </div>
</div> 

</form>

<script>
  

setDefaultDate();
    
</script>
 
