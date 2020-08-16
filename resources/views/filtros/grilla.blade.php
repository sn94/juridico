<?php

use App\Mobile_Detect;

$detect= new Mobile_Detect();  
$icons_size= $detect->isMobile() ? "": " fa-lg";
if( $detect->isMobile() == false){
  ?>
<style>
  table{
    font-size:16px !important;
  }
</style>

<?php
} 
?>

 
<table class="table table-striped table-bordered <?= $detect->isMobile()?"":"table-responsive" ?>">
      <thead class="thead-dark ">
      <th class="pb-0"></th>
      <th class="pb-0"></th>
      <th class="pb-0"></th>
      <th class="pb-0">NOMBRE</th>   
       </thead>
      <tbody>
        <?php  foreach( $lista as $it) :?>
        <tr id="{{$it->NRO}}"> 
      
          <td><a onclick="editar(event)" href="<?=url("efiltro/".$it->NRO)?>" style="color:black;"><i class="mr-2 ml-2 fa fa-pencil {{$icons_size}}" aria-hidden="true"></i></a></td>
          <td><a onclick="borrar(event)" href="<?=url("dfiltro/".$it->NRO)?>" style="color:black;" ><i class="mr-2 ml-2 fa fa-trash {{$icons_size}}" aria-hidden="true"></i></a></td>
          <td> 
           <!--MANDAR A IMPRIMIR -->
           <a  href="<?= url("filtro")?>" data-toggle="modal" data-target="#show_opc_rep" onclick="mostrar_informe(event)" style="color:black;" > <i class="mr-2 ml-2 fa fa-print {{$icons_size}}" aria-hidden="true"></i>
          </a> 
          </td>
          <td>{{$it->NOMBRE }}</td>
           </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
   