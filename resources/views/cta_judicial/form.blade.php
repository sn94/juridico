<?php 
use App\Helpers\Helper; 
 
?>

<input type="hidden" name="ID_DEMA" value="{{isset($dato->ID_DEMA)? $id_demanda:''}}">
<input type="hidden" name="IDNRO" value="{{isset($dato->IDNRO)? $dato->IDNRO: ''}}">


<div class="row">
<div class="col-12 col-md-2">
        <label >CI°:</label>
        <input readonly value="{{isset( $dato->CI)?$dato->CI:''}}" name="CI"  type="text"  class="form-control form-control-sm">
    </div>
    <div class="col-12 col-md-3">
        <label >TITULAR:</label>
        <input readonly value="{{isset($dato->TITULAR) ? $dato->TITULAR: $TITULAR}}" name="TITULAR"  type="text"  class="form-control form-control-sm">
    </div>
    <div class="col-12 col-md-2">
        <!--CREACION DE CTA JUDICIAL -->
        <label >BANCO:</label>
        <input readonly value="{{isset($dato->BANCO)? $dato->BANCO: $BANCO}}" name="BANCO"  type="text"  class="form-control form-control-sm">
        <!--END CREACION DE CTA JUDICIAL -->

    </div>
    <div class="col-12 col-md-2">
        <label >NÚMERO CTA.BANCO:</label>
        <input readonly value="{{isset($dato->CTA_JUDICI)?$dato->CTA_JUDICI: $dato->CTA_BANCO}}" name="CTA_JUDICI"  type="text"  class="form-control form-control-sm">
    </div>
    <div class="col-12 col-md-2">
        <label >TIPO. CTA:</label>
        <div class="form-check">
        <input {{ isset($dato->TIPO_CTA) ? ( substr($dato->TIPO_CTA,0,1)=="D"?'checked':'') : 'checked' }} onchange="cambiar(event)"  class="form-check-input" type="radio" name="TIPO_CTA" id="inlineRadio1" value="C">
        <label class="form-check-label" for="inlineRadio1">CAPITAL</label>
        </div>
        <div class="form-check">
        <input {{isset($dato->TIPO_CTA)? (  substr($dato->TIPO_CTA,0,1)=="E"? 'checked': ''): ''}}  onchange="cambiar(event)" class="form-check-input" type="radio" name="TIPO_CTA" id="inlineRadio2" value="L">
        <label class="form-check-label" for="inlineRadio2">LIQUIDACIÓN</label>
        </div>
 
    </div>
  
</div>

<div class="row">

    <div class="col-12 col-md-12">
        <label >TIPO DE MOVIMIENTO:</label><br>
        <div class="form-check">
        <input {{isset($dato->TIPO_MOVI)? ( substr($dato->TIPO_MOVI,0,1)=="D"?"checked":"") : 'checked'}} onchange="cambiar(event)"  class="form-check-input" type="radio" name="TIPO_MOVI" id="inlineRadio1" value="D">
        <label class="form-check-label" for="inlineRadio1">DEPÓSITO</label>
        </div>
        <div class="form-check">
        <input {{isset($dato->TIPO_MOVI)? (  substr($dato->TIPO_MOVI,0,1)=="E"?"checked":""): ''}}  onchange="cambiar(event)" class="form-check-input" type="radio" name="TIPO_MOVI" id="inlineRadio2" value="E">
        <label class="form-check-label" for="inlineRadio2">EXTRACCIÓN</label>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-12 col-md-3">
            <label >Fecha:</label>
            <input name="FECHA"  value="{{ isset($dato->FECHA)? Helper::fecha_f($dato->FECHA) : ''}}"  type="date"  class="form-control form-control-sm">
    </div>
    <div class="col-12 col-md-3">
            <label >Importe:</label>
            <input  value="{{ isset($dato->IMPORTE)?Helper::number_f($dato->IMPORTE):''}}"   oninput="formatear(event)" name="IMPORTE" type="text"  class="form-control form-control-sm">
    </div>
    <?php if( $OPERACION != "A"  &&   substr($dato->TIPO_MOVI,0,1)=="E"): ?>
    <div id="tipoext" class="col-12 col-md-3" >
            <label >Tipo de extracción:</label>
            <input value="{{ isset($dato->TIPO_EXT)?$dato->TIPO_EXT: ''}}" name="TIPO_EXT" type="text"  class="form-control form-control-sm">
    </div>
    <div id="chequenro" class="col-12 col-md-3">
            <label >Cheque:</label>
            <input value="{{ isset($dato->CHEQUE_NRO)? $dato->CHEQUE_NRO: ''}}" name="CHEQUE_NRO" type="text"  class="form-control form-control-sm"> 
    </div>
    <?php else: ?>
        <div id="tipoext" class="col-12 col-md-3 invisible" >
            <label >Tipo de extracción:</label>
            <input value="{{ isset($dato->TIPO_EXT)?$dato->TIPO_EXT: ''}}" name="TIPO_EXT" type="text"  class="form-control form-control-sm">
    </div>
    <div id="chequenro" class="col-12 col-md-3 invisible">
            <label >Cheque:</label>
            <input value="{{ isset($dato->CHEQUE_NRO)? $dato->CHEQUE_NRO: ''}}" name="CHEQUE_NRO" type="text"  class="form-control form-control-sm"> 
    </div>
    <?php endif; ?>
</div>
 

 