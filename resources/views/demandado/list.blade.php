@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">DEMANDADOS</li> 
@endsection

@section('content')

<h3>DEMANDADOS</h3>
  
<div class="btn-group mb-2" role="group" aria-label="Basic example">
  <a href="<?=url("ndemandado")?>" class="btn btn-success">NUEVO</a>
 
</div>

<div id="tabla-dinamica">
    <table id="demandadostable" class="table table-bordered table-striped">
      <thead class="thead-dark">
          <tr> <th>CI</th>  <th>TITULAR</th> <th>DOMICILIO</th> <th>TELÉFONO</th> </tr>
      </thead>
      <tbody>
      <?php foreach( $lista as $item): ?>
          <tr><td > <a href="<?=url("vdemandado/".$item->CI)?>"><?=$item->CI?> </a> </td><td > <?= $item->TITULAR?></a> </td> <td><?= $item->DOMICILIO?></td>  <td><?= $item->TELEFONO?></td>    </tr>
      <?php  endforeach; ?>
      </tbody>
      </table>

      <script>
        document.onreadystatechange = () => {
          if (document.readyState === 'complete') {
            // document ready
            $('#demandadostable').DataTable( {    "ordering": false });
          }
        };
      </script>
  </div>


  
@endsection



<script>




document.onreadystatechange = () => {
  if (document.readyState === 'complete') {
    // document ready
    $('#demandadostable').DataTable();
  }
};


 
 
       
    </script>