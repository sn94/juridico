@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">DEMANDADOS</li> 
@endsection

@section('content')


<div class="alert alert-success">
<h5>Se han registrado datos personales para el CI° {{ $ci}} </h5>

 
    <div class="row">
        <div class="col-12 col-md-3">
        <a href="<?=url("edemandado/$lastid") ?>">
        <img src="<?=url("assets/img/back.png")?>" alt=""> 
        Volver</a>
        </div>
        <div class="col-12 offset-md-1 col-md-3">
        <a href="<?=url("demandas-agregar/$lastid") ?>">Cargar datos de demanda
        <img src="<?=url("assets/img/for.png")?>" alt=""></a>
        </div>
    </div>

</div>


@endsection