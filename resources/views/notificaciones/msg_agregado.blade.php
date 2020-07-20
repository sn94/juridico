@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">SEGUIMIENTO AGREGADO</li> 
@endsection

@section('content')


<div class="alert alert-success">

<h5>Se ha registrado seguimiento para {{$nombre}} de CI° {{ $ci}} </h5>


<div class="row">
        <div class="col-12 col-md-3">
        <a href="<?=url("enotifi/$iddeman") ?>">
        <img src="<?=url("assets/img/back.png")?>" alt=""> 
        Volver</a>
        </div>
        <div class="col-12 offset-md-1 col-md-7">
        <a href="<?= url("nobser/$iddeman") ?>">
        Cargar observaciones
        <img src="<?=url("assets/img/for.png")?>" alt="">
        </a>   
        </div> 
    </div>
 
</div>


@endsection