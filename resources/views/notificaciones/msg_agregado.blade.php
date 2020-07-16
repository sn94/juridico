@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">SEGUIMIENTO AGREGADO</li> 
@endsection

@section('content')


<div class="alert alert-success">

<h5>Se ha registrado seguimiento para {{$nombre}} de CI° {{ $ci}} </h5>
¿Continuar?
<a href="<?= url("nobser/{{$iddeman}}") ?>">Cargar observaciones</a>

</div>


@endsection