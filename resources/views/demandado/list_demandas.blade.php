@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">REGISTROS DE DEMANDADO</li> 
@endsection

@section('content')

<h4>{{$ci}} - {{$nombre}}</h4>
 <!--Enlaces  --->
<a class="btn btn-info btn-sm mb-1 mt-1" href="<?=url("vdemandado/$ci")?>">DATOS PERSONALES</a> 
<a class="btn btn-info btn-sm mb-1 mt-1" href="<?=url("demandas-agregar/$idpersona")?>">NUEVO REG.JUDICIAL</a> 


<div id="tabla-dinamica">
    <table id="demandadostable" class="table table-bordered table-striped">
      <thead class="thead-dark">
          <tr> <th></th> <th></th><th>DEMANDANTE</th>  <th>ORIGEN</th> <th>PRESENTADO</th> <th>FEC_EMBARGO</th><th>COD_EMP</th>  </tr>
      </thead>
      <tbody>
      <?php foreach( $lista as $item): ?>
          <tr> <td><a href="<?= url("ficha-demanda/".$item->IDNRO)?>">VER</a> </td>  <td><a href="<?= url("demandas-editar/".$item->IDNRO)?>">EDITAR</a> </td> <td >  <?= $item->DEMANDANTE?> </td><td > <?= $item->O_DEMANDA?></a> </td> <td>{{$item->PRESENTADO}}</td><td>{{$item->EMB_FECHA}}</td> <td><?= $item->COD_EMP?></td>     </tr>
      <?php  endforeach; ?>
      </tbody>
      </table>
  </div>
@endsection