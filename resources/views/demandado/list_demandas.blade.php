@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">REGISTROS DE DEMANDADO</li> 
@endsection

@section('content')

<h4>{{$ci}} - {{$nombre}}</h4>
<h3>DEMANDAS</h3>
 <!--Enlaces  --->
<a href="<?=url("vdemandado/$ci")?>">VOLVER A DATOS PERSONALES</a> 


<div id="tabla-dinamica">
    <table id="demandadostable" class="table table-bordered table-striped">
      <thead class="thead-dark">
          <tr> <th>DEMANDANTE</th>  <th>ORIGEN DEMANDA</th> <th>COD_EMP</th> <th></th> </tr>
      </thead>
      <tbody>
      <?php foreach( $lista as $item): ?>
          <tr><td >  <?= $item->DEMANDANTE?> </td><td > <?= $item->O_DEMANDA?></a> </td> <td><?= $item->COD_EMP?></td>  <td><a href="<?= url("ficha-demanda/".$item->IDNRO)?>">Ver mas</a> </td>    </tr>
      <?php  endforeach; ?>
      </tbody>
      </table>

      <script>
        document.onreadystatechange = () => {
          if (document.readyState === 'complete') {
            // document ready
            $('#demandadostable').DataTable(
              {   
            "ordering": false,
            "language": {
              "url": "<?=url("assets/Spanish.json")?>"
            }
          }
            );
          }
        };
      </script>
  </div>


  
@endsection



<script>




document.onreadystatechange = () => {
  if (document.readyState === 'complete') {
    // document ready
    $('#demandadostable').DataTable(
      {   
            "ordering": false,
            "language": {
              "url": "<?=url("assets/Spanish.json")?>"
            }
          }
    );
  }
};


 
 
       
    </script>