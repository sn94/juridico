
 
<?php

use App\Helpers\Helper;

?>
<table id="tctajudicial" class="table  table-sm table-bordered table-striped">
        <thead class="thead-dark">
            <tr><th></th><th></th><th></th><th class="text-right">FECHA</th><th class="text-right">IMPORTE</th><th class="text-right">TIPO MOV.</th></tr>
        </thead>
        <tbody>
          <?php  foreach( $movi as $it):?>
            <tr id="{{$it->IDNRO}}">
              <td ><p class="p-0 m-0"><a   href="<?= url("vcuentajudi/".$it->IDNRO) ?>"><i class="fa fa-eye" aria-hidden="true"></i></a></p></td>
              <td><p class="p-0 m-0"><a    href="<?= url("ecuentajudi/".$it->IDNRO) ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></p></td>
              <td><p class="p-0 m-0"><a   onclick="borrar(event)" href="<?= url("dcuentajudi/".$it->IDNRO) ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></p></td>
              <td class="text-right"><p class="p-0 m-0">{{$it->FECHA}}</p></td>
              <td  class="text-right"><p class="p-0 m-0">{{ Helper::number_f($it->IMPORTE)}}</p></td>
              <td  class="text-right"><p class="p-0 m-0">{{$it->TIPO_MOVI=="D" ?"DEPOSITO":"EXTRACCION"}}</p></td>
            </tr>

          <?php  endforeach; ?>
        </tbody>
    </table> 