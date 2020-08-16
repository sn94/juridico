@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">BANCOS</li> 
<li class="breadcrumb-item active" aria-current="page">OPERACIONES</li> 
@endsection

@section('content')

<?php 
use App\Helpers\Helper; 
 
?>


<h5> {{isset( $dato->TITULAR)?$dato->TITULAR:''}} &nbsp;CTA.NRO.:{{isset( $dato->CUENTA)?$dato->CUENTA:''}}</h5>


<div class="form-check form-check-inline">
  <input onclick="hab_Depo()" checked class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
  <label class="form-check-label" for="inlineRadio1">DEPÓSITO</label>
</div>
<div class="form-check form-check-inline">
  <input onclick="hab_Extr()" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
  <label class="form-check-label" for="inlineRadio2">EXTRACCIÓN</label>
</div>


<form id="deposito" action="<?=url("depobank")?>" method="post"  >

@csrf

<!-- deposito -->
<div class="row">
<div class="col-12 col-md-2">
        <label >FECHA:</label>
        <input   name="FECHA"  type="text"  class="form-control form-control-sm">
    </div>
    <div class="col-12 col-md-3">
        <label >NRO. DE DEPÓSITO:</label>
        <input  name="NUMERO"  type="text"  class="form-control form-control-sm">
    </div>
    <div class="col-12 col-md-2"> 
        <label >IMPORTE:</label>
        <input readonly value="{{isset($dato->BANCO)? $dato->BANCO: $BANCO}}" name="BANCO"  type="text"  class="form-control form-control-sm">
         

    </div>
    <div class="col-12 col-md-2">
        <label >CONCEPTO:</label>
        <input readonly value="{{isset($dato->CTA_JUDICI)?$dato->CTA_JUDICI: $dato->CTA_BANCO}}" name="CTA_JUDICI"  type="text"  class="form-control form-control-sm">
    </div>
    
  
</div><!--End deposito -->

</form>
 





<form id="extraccion" action="<?=url("extrbank")?>" method="post"  style="display: none;" >

@csrf

<!-- Extraccion -->
<div class="row">
<div class="col-12 col-md-2">
        <label >FECHA DE OPERACIÓN:</label>
        <input   name="FECHA"  type="text"  class="form-control form-control-sm">
    </div>
    <div class="col-12 col-md-2">
        <label >COD. DE GASTO:</label>
        <input   name="CODIGO"  type="text"  class="form-control form-control-sm">
    </div>
    <div class="col-12 col-md-2"> 
        <label >NRO.CHEQUE/EXTRACCIÓN:</label>
        <input name="NUMERO"  type="text"  class="form-control form-control-sm">
    </div>

    <div class="col-12 col-md-2">
        <label >IMPORTE:</label>
        <input   name="IMPORTE"  type="text"  class="form-control form-control-sm">
    </div>
    <div class="col-12 col-md-2">
        <label >CONCEPTO:</label>
        <input name="CONCEPTO"  type="text"  class="form-control form-control-sm">
    </div>
    
  
</div><!--End extraccion -->


 



</form>

@endsection
 <script>

     function hab_Depo(){
        $("#deposito").css("display", "block");
        $("#extraccion").css("display", "none");
     }
     function hab_Extr(){
        $("#deposito").css("display", "none");
        $("#extraccion").css("display", "block");
        }
 </script>