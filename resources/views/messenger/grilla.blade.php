<?php

use App\Mobile_Detect;

$detect= new Mobile_Detect();
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


<table class="table table-striped table-bordered table-responsive">
      <thead class="thead-dark ">
      <th class="pb-0"></th>
      <th class="pb-0"></th>
      <th class="pb-0">ASUNTO</th> 
        <th class="pb-0">MENSAJE</th> 
     </thead>
      <tbody>
        <?php  foreach( $lista as  $it) :?>
        <tr id="{{$it->IDNRO}}"> 
          <td><a onclick="editar(event)" href="<?=url("ver-msg/".$it->IDNRO)?>"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
          <td><a onclick="borrar(event)" href="<?=url("del-msg/".$it->IDNRO)?>" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>
          <td> {{ $it->ASUNTO }}   </td>  
          <td> {{ $it->MENSAJE }}   </td>  
      </tr>
        <?php endforeach; ?>
      </tbody>
    </table>