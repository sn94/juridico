@extends('layouts.app')


@section('content')

<?php

use App\Helpers\Helper;


?>


<div class="row">

    <div class="col-12 col-md-5 col-lg-3">
        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header bg-dark  text-center">DEMANDAS </div>
        <div class="card-body">
            <h4 class="card-title text-center">{{ Helper::number_f($demanda)}}Gs.</h4> 
        </div>
        </div>
    </div>
    <div class="col-12 col-md-5 col-lg-3">
        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header bg-dark  text-center">SALDOS</div>
        <div class="card-body">
            <h4 class="card-title text-center">{{Helper::number_f($saldo_judi)}}Gs.</h4> 
        </div>
        </div>
    </div>
    <div class="col-12 col-md-5 col-lg-3">
        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header  bg-dark text-center ">SALDO CAPITAL.</div>
        <div class="card-body">
            <h4 class="card-title text-center">{{ Helper::number_f($saldo_c)}}Gs</h4>
        </div>
        </div>
    </div> 
    <div class="col-12 col-md-5 col-lg-3">
        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header bg-dark text-center ">SALDO LIQUIDACIÓN</div>
        <div class="card-body">
            <h4 class="card-title text-center">{{Helper::number_f($saldo_l)}}Gs.</h4>  </div>
        </div>
    </div>
   
    
</div>
 

 



 

 
@endsection 