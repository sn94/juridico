@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">DEMANDAS CON FECHAS DE NOTIFICACIÓN VENCIDAS</li>  
@endsection



@section('content')

 

    <div class="container-fluid">
    <table id="demandatable" class="table table-bordered table-striped">

        <thead class="thead-dark">
            <tr><th>TITULAR</th><th class="">DEMANDANTE</th> <th  class="">COD_EMP</th> <th  class="">JUZGADO</th> <th  class="">ACTUARIA</th> <th  class="">JUEZ</th><th  class="">DEMANDA</th><th  class="">SALDO</th>  <th  class="">OBS</th></tr>
        </thead>
        <tbody>
        <?php foreach( $lista as $item): ?>

            <tr ><td ><?= $item->TITULAR?></td><td  class=""><?= $item->DEMANDANTE?></td><td  class=""><a href="<?=url("ficha-demanda/".$item->COD_EMP)?>"><?= $item->COD_EMP?></a></td><td  class=""><?= $item->JUZGADO?></td><td  class=""><?= $item->ACTUARIA?></td><td  class=""><?= $item->JUEZ?></td><td  class=""><?= $item->DEMANDA?></td><td  class=""><?= $item->SALDO?></td> <td  class=""><?= $item->OBS?></td></tr>
        <?php  endforeach; ?>
        </tbody>

      </table>
    </div>

  
@endsection



<script>

document.onreadystatechange = () => {
  if (document.readyState === 'complete') {
    // document ready
    $('#demandatable').DataTable(
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