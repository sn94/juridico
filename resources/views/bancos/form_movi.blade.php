
<h6  style=" background-color: #041402; color: white;" class="text-center mb-0">
{{ $TIPO_MOV=="D" ? "DEPÓSITO" : "EXTRACCIÓN" }}
</h6>
<h6  style=" background-color: #041402; color: white;"  class="text-center">{{$TITULAR}}-{{$CUENTA}}</h6>

<p id="mensaje-movi" style="text-align: center; font-weight: bold; color: #05560c;"></p>

<form class="p-2" id="formmovi" action="{{$RUTA}}" method="post"    onsubmit="movimiento(event)" >

@csrf
<input type="hidden" name="IDNRO" value="{{isset($dato->IDNRO)? $dato->IDNRO:''}}">
<input type="hidden" name="CUENTA" value="{{$CUENTA}}">
<input type="hidden" name="BANCO" value="{{$BANCO}}">
<input type="hidden" name="TIPO_MOV" value="{{$TIPO_MOV}}">
<!-- Extraccion -->
<div class="row">
<div class="col-12 col-md-12">
        <label >FECHA DE OPERACIÓN:</label>
        <input  value="{{isset($dato->FECHA)? $dato->FECHA:''}}"  name="FECHA"  type="date"  class="form-control form-control-sm">
    </div>
    <?php  if( $TIPO_MOV == "E"):?>
        <div class="col-12 col-md-12">
        <label >COD. DE GASTO:</label>
        <input  value="{{isset($dato->CODIGO)? $dato->CODIGO:''}}" name="CODIGO"  type="text"  class="form-control form-control-sm">
    </div>
    <?php endif; ?>

  
    <div class="col-12 col-md-12"> 
        <label >{{ $TIPO_MOV=="E" ? "NRO.CHEQUE/EXTRACCIÓN:" : "NRO. DE DEPÓSITO"}}</label>
        <input value="{{isset($dato->NUMERO)? $dato->NUMERO:''}}"  name="NUMERO"  type="text"  class="form-control form-control-sm">
    </div>

    <div class="col-12 col-md-12">
        <label >IMPORTE:</label>
        <input oninput="solo_numero(event)"  name="IMPORTE" value="{{isset($dato->IMPORTE)? $dato->IMPORTE:''}}"  type="text"  class="form-control form-control-sm">
    </div>
    <div class="col-12 col-md-12">
        <label >CONCEPTO:</label>
        <input name="CONCEPTO"  value="{{isset($dato->CONCEPTO)? $dato->CONCEPTO:''}}" type="text"  class="form-control form-control-sm">
    </div>
    
  
</div><!--End extraccion -->
<button class="btn btn-sm btn-info" type="submit">GUARDAR</button>
</form>

<script>

function setDefaultDate(){
        //fechas por defecto
        if( $("input[type=date]").val() == "" )
        {
            let FeCha= new Date();
            let mes= (FeCha.getMonth()+1) <10 ?  "0".concat(FeCha.getMonth()+1) :  (FeCha.getMonth()+1);
            console.log( FeCha.getFullYear()+"-"+mes+"-"+FeCha.getDate());
            $("input[type=date]").val( FeCha.getFullYear()+"-"+mes+"-"+FeCha.getDate());
        }
    }

    setDefaultDate();
    
</script>