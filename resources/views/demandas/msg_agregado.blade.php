@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">DEMANDADOS</li> 
@endsection

@section('content')


<div class="alert alert-success">

<h5>Se han registrado datos de demanda para el  CI° {{ $ci}} </h5>
¿Continuar?
<a href="<?= url("nnotifi/$iddeman") ?>">Cargar ficha de notificaciones</a>
</div>

@endsection