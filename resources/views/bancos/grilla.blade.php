
 
<?php

use App\Helpers\Helper;
use App\Mobile_Detect;

$dete= new Mobile_Detect();
$iconsize=  $dete->isMobile() ? "": "fa-lg";
?>

<table id="ctabancos" class="table  table-sm table-bordered table-striped">
        <thead class="thead-dark">
            <tr><th></th><th></th><th></th><th class="text-right">BANCO</th><th class="text-right">CUENTA</th><th class="text-right">TIPO CTA.</th><th>TITULAR</th><th>SALDO</th></tr>
        </thead>
        <tbody>
          <!--CADA CTA TENDRA ALGUN DEPOSITO, EXTRACCION O EXTRACCION POR PROYECTO-->
          <?php  foreach( $movi as $it):?>
            <tr id="{{$it->IDNRO}}">
              <td ><p class="p-0 m-0"><a   href="<?= url("vbank/".$it->IDNRO) ?>"><i class="fa fa-eye {{$iconsize}}" aria-hidden="true"></i></a></p></td>
              <td><p class="p-0 m-0"><a onclick="mostrar_form(event)" data-toggle="modal" data-target="#showform"   href="<?= url("ebank/".$it->IDNRO) ?>"><i class="fa fa-pencil {{$iconsize}}" aria-hidden="true"></i></a></p></td>
              <td><p class="p-0 m-0"><a   onclick="borrar(event)" href="<?= url("dbank/".$it->IDNRO) ?>"><i class="fa fa-trash {{$iconsize}}" aria-hidden="true"></i></a></p></td>
              <td class="text-right"><p class="p-0 m-0">{{$it->BANCO}}</p></td>
              <td  class="text-right"><p class="p-0 m-0">{{ Helper::number_f($it->CUENTA)}}</p></td>
              <td  class="text-right"><p class="p-0 m-0">{{$it->TIPO_CTA}}</p></td>
              <td class="text-right"><p class="p-0 m-0">{{$it->TITULAR}}</p></td>
            </tr>

          <?php  endforeach; ?>
        </tbody>
    </table> 