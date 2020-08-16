

<?php 
use App\Helpers\Helper; 
 
?>

<form id="ctabcoform" onsubmit="guardar(event)" action="<?=url("nbank")?>" method="post">

@csrf
 
<h6 class="text-center">NUEVA CUENTA</h6>
<p id="mensaje" style="text-align: center; font-weight: bold; color: #05560c;"></p>
<div class="row p-2">
<div class="col-12 col-md-12">
        <label >TITULAR:</label>
        <input  value="{{isset( $dato->TITULAR)?$dato->TITULAR:''}}" name="TITULAR"  type="text"  class="form-control form-control-sm">
    </div>
    <div class="col-12 col-md-12">
        <label >BANCO:</label>
        <input  value="{{isset($dato->BANCO) ? $dato->BANCO : '' }}" name="BANCO"  type="text"  class="form-control form-control-sm">
    </div>
    <div class="col-12 col-md-12"> 
        <label >CUENTA:</label>
        <input  value="{{isset($dato->CUENTA)? $dato->CUENTA: ''}}" name="CUENTA"  type="text"  class="form-control form-control-sm">
     </div>
    <div class="col-12 col-md-12">
        <label >TIPO DE CTA.:</label>
        <input  value="{{isset($dato->TIPO_CTA)?$dato->TIPO_CTA: ''}}" name="TIPO_CTA"  type="text"  class="form-control form-control-sm">
    </div>
    <div class="col-12 col-md-12 d-flex align-items-center">
    <button class="btn btn-sm btn-info" type="submit">GUARDAR</button>
    </div>
</div> 

</form>

 
