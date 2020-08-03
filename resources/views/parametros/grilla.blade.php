<table class="table table-striped table-bordered">
  <thead class="thead-dark"><th></th><th></th><th>DESCRIPCION</th><th>VALOR</th></thead>

  <tbody>
<?php  foreach($lista as $it):?>
  <tr id="{{$it->IDNRO}}">
    <td> <a   href="<?= url("vcuentajudi/".$it->IDNRO) ?>"><i class="fa fa-eye" aria-hidden="true"></i></a> </td>
    <td><a onclick="borrar(event)"   href="<?= url("dparam/".$it->IDNRO) ?>"><i class="fa fa-trash" aria-hidden="true"></i></a> </td>
    <td>{{$it->DESCR}}</td>
    <td>{{$it->VALOR}}</td>
  </tr>
<?php endforeach; ?>
  
  </tbody>
</table>