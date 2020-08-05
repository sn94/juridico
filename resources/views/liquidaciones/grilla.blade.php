
 
<?php

use App\Helpers\Helper;

?>
<table id="tlistaliquida" class="table  table-sm table-bordered table-striped">
        <thead class="thead-dark">
            <tr><th></th><th></th><th></th><th></th><th class="text-right">SALDO</th><th class="text-right">ULT_PAGO</th><th class="text-right">TOTAL</th></tr>
        </thead>
        <tbody>
          <?php  foreach( $lista as $it):?>
            <tr id="{{$it->IDNRO}}">
            <td ><p class="p-0 m-0"><a style="color:black;" onclick="gen_xls_liquida(event)"  href="<?= url("jsonliquida/".$it->IDNRO) ?>"><i class="fa fa-print" aria-hidden="true"></i></a></p></td>
              <td ><p class="p-0 m-0"><a  style="color:black;" href="<?= url("vliquida/".$it->IDNRO) ?>"><i class="fa fa-eye" aria-hidden="true"></i></a></p></td>
              <td><p class="p-0 m-0"><a  style="color:black;"   href="<?= url("eliquida/".$it->IDNRO) ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></p></td>
              <td><p class="p-0 m-0"><a style="color:black;"  onclick="borrar(event)" href="<?= url("dliquida/".$it->IDNRO) ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></p></td>
              <td class="text-right"><p class="p-0 m-0">{{$it->SALDO}}</p></td>
              <td  class="text-right"><p class="p-0 m-0">{{ $it->ULT_PAGO }}</p></td>
              <td  class="text-right"><p class="p-0 m-0">{{$it->TOTAL }}</p></td>
            </tr>

          <?php  endforeach; ?>
        </tbody>
    </table> 