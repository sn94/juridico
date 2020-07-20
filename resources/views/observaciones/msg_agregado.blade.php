@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">OBSERVACIONES</li> 
@endsection

@section('content')


<div class="alert alert-success">

<h5>Se han registrado observaciones de la demanda de {{$nombre}} con CI° {{ $ci}} </h5>

<div class="row">
        <div class="col-12 col-md-3">
        <a href="<?=url("eobser/$iddeman") ?>">
        <img src="<?=url("assets/img/back.png")?>" alt=""> 
        Volver a Observaciones</a>
        </div>
        
    </div>

<a href="<?= url("/") ?>">Inicio</a>

</div>


@endsection