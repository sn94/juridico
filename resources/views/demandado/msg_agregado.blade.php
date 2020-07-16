@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">DEMANDADOS</li> 
@endsection

@section('content')


<div class="alert alert-success">

<h5>Se han registrado datos personales para el CI° {{ $ci}} </h5>
¿Continuar?
<a href="<?=url("demandas-agregar/$lastid") ?>">Cargar datos de demanda</a>
</div>


@endsection