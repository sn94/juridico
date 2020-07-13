@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">LIQUIDACIONES</li> 
<li class="breadcrumb-item active" aria-current="page">LIQUIDACIONES</li> 
@endsection



@section('content')
 
<a href="<?=url("demandas-liquidar")?>" class="btn btn-success">Liquidar</a>
 

<br>
<h5>Origen de demanda: </h5>
<select id="ODEMANDA" class="form-control mb-1" onchange="filtrar_por_origen(event)">
<?php foreach( $odemanda as $it): ?>
<option value="{{$it->CODIGO}}">{{$it->NOMBRES}}</option>
<?php endforeach;?>
</select>

  <div id="tabla-dinamica">
    <table id="demandatable" class="table table-bordered table-striped">
      <thead class="thead-dark">
          <tr> <th>COD_EMP</th><th>CI</th>  <th>TITULAR</th> <th>DEMANDANTE</th> <th>CTA_BANCO</th> </tr>
      </thead>
      <tbody>
      <?php foreach( $lista as $item): ?>
          <tr><td > <a href="<?=url("ficha-demanda/".$item->COD_EMP)?>"><?= $item->COD_EMP?></a> </td> <td><?= $item->CI?></td>  <td><?= $item->TITULAR?></td><td><?= $item->DEMANDANTE?></td><td><?= $item->CTA_BANCO?></td> </tr>
      <?php  endforeach; ?>
      </tbody>
      </table>

      <script>
        document.onreadystatechange = () => {
          if (document.readyState === 'complete') {
            // document ready
            $('#demandatable').DataTable( {    "ordering": false });
          }
        };
      </script>
  </div>
  
  
@endsection



<script>
function filtrar_por_origen(ev){
  let odemanda= ev.target.value ;
  $.ajax( {
    url:"/demandas_p_liquidi_b_o/"+odemanda,
    beforeSend: function(){
      $("#tabla-dinamica").html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
    },
    success: function( res){
      $("#tabla-dinamica").html( res );
    },
    error( xhr){
      $("#tabla-dinamica").html( res );
    }
    }) ;
}

 

       
    </script>