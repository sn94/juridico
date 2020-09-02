
 
<?php

use App\Helpers\Helper;
use App\Mobile_Detect;

$dete= new Mobile_Detect();
$iconsize=  $dete->isMobile() ? "": "fa-lg";
?>

<style>
  td p a:link,   td p a:visited{
    color:black;
  }
  tr{
    background: #e9fca7 !important;
  }
</style>

<table id="gastos" class="table  table-sm table-bordered table-responsive table-striped">
        <thead class="thead-dark">
            <tr><th></th><th></th> <th>FECHA</th><th >NUMERO</th><th>DETALLE 1</th>
            <th >DETALLE 2</th><th class="text-right">IMPORTE</th> </tr>
        </thead>
        <tbody>
          <!--CADA CTA TENDRA ALGUN DEPOSITO, EXTRACCION O EXTRACCION POR PROYECTO-->
          <?php  foreach( $movi as $it):?>
            <tr id="{{$it->IDNRO}}">
               
              <td><p class="pt-1 mr-1 ml-1 mb-0 text-center"><a onclick="mostrar_form(event)" data-toggle="modal" data-target="#showform"   href="<?= url("gasto/M/".$it->IDNRO) ?>"><i class="fa fa-pencil {{$iconsize}}" aria-hidden="true"></i></a></p></td>
              <td><p class="pt-1 mr-1 ml-1 mb-0 text-center"><a   onclick="borrar(event)" href="<?= url("dgasto/".$it->IDNRO) ?>"><i class="fa fa-trash {{$iconsize}}" aria-hidden="true"></i></a></p></td>
           
              <td  class="text-right"><p class="pt-1 mr-1 ml-1 mb-0">{{ $it->FECHA }}</p></td>
              <td  class="text-right"><p class="pt-1 mr-1 ml-1 mb-0">{{$it->NUMERO}}</p></td>
              <td class="text-right"><p class="pt-1 mr-1 ml-1 mb-0">{{$it->DETALLE1}}</p></td>
              <td class="text-right"><p class="pt-1 mr-1 ml-1 mb-0">{{$it->DETALLE2}}</p></td>
              <td class="text-right"><p class="pt-1 mr-1 ml-1 mb-0 text-right">{{ Helper::number_f( $it->IMPORTE ) }}</p></td>
            </tr>

          <?php  endforeach; ?>
        </tbody>
    </table> 

    @if ( method_exists(  $movi, "links") )
    {{ $movi->links()}}
    @endif