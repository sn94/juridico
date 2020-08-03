@extends('layouts.app')


@section('content')

<?php 
function number_f( $ar){
  $v= floatval( $ar);
  return number_format($v, 0, '', '.');  
}
?>

<div class="row">

    <div class="col-12 col-md-2">
        <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
        <div class="card-header bg-primary text-center">JUICIOS</div>
        <div class="card-body">
            <h3 class="card-title text-center">{{$demanda}}</h3> 
        </div>
        </div>
    </div>
    <div class="col-12 col-md-2">
        <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
        <div class="card-header bg-primary text-center">DEMANDADOS</div>
        <div class="card-body">
            <h3 class="card-title text-center">{{$demandado}}</h3> 
        </div>
        </div>
    </div>
    <div class="col-12 col-md-2">
        <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
        <div class="card-header  bg-secondary text-center ">NOTIF.VENC.</div>
        <div class="card-body">
            <h3 class="card-title text-center">{{$notiven}}</h3>
        </div>
        </div>
    </div> 
    <div class="col-12 col-md-3">
        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header bg-success text-center ">SALDO EN CUENTA</div>
        <div class="card-body">
            <h3 class="card-title text-center">{{number_f($saldo_n_c)." Gs"}}</h3>  </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header bg-success text-center ">SALDO JUDICIAL</div>
        <div class="card-body">
            <h3 class="card-title text-center">{{number_f($saldo_judi)." Gs"}}</h3>  </div>
        </div>
    </div>
    
</div>
 

 



 

 
@endsection 