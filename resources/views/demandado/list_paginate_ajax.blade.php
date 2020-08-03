<?php
//require_once "libs/Mobile_Detect.php";

use App\Mobile_Detect;

$detect= new Mobile_Detect();
if ($detect->isMobile() == false) {
   // Detecta si NO es un móvil
  ?>
 
 <table id="demandadostable" class="table table-responsive table-bordered table-striped">
  <thead class="thead-dark">
      <tr> <th></th> <th></th><th>CI</th>  <th >TITULAR</th> <th>DOMICILIO</th> <th>TELÉFONO</th><th>Nro.Juicios</th> </tr>
  </thead>
  <tbody>
  <?php foreach( $lista as $item): ?>
      <tr  id="{{$item->CI}}" > 
    <td >  <a href="<?=url("demandas-by-ci/".$item->CI)?>" ><i class="fa fa-eye" aria-hidden="true"></i></a>   </td> 
    <td > <p  > <a href="<?=url("ddemandado/".$item->CI)?>" onclick="procesar_borrar(event,'{{$item->CI}}')"><i class="fa fa-trash" aria-hidden="true"></i></a></p> </td> 
    <td >  <?=$item->CI?> </td>
    <td >  <?= $item->TITULAR?> </td> 
    <td  > <?= $item->DOMICILIO?> </td>  
    <td  > <?= $item->TELEFONO?> </td>   
    <td style="text-align: center;">{{ isset($item->nro)? $item->nro : ""}}</td>
  </tr>
  <?php  endforeach; ?>
  </tbody>
  </table>
  {{ $lista->links() }}

<?php
  }else{
?>


<table id="demandadostable" class="table table-responsive table-bordered table-striped">
  <thead class="thead-dark">
      <tr> <th></th> <th></th><th>CI</th>  <th >TITULAR</th><th>Nro.Juicios</th> </tr>
  </thead>
  <tbody>
  <?php foreach( $lista as $item): ?>
      <tr id="{{$item->CI}}">  
    <td> <p  class="p-0 m-0" ><a href="<?=url("demandas-by-ci/".$item->CI)?>" ><i class="fa fa-eye" aria-hidden="true"></i></a></p>  </td> 
    <td> <p  class="p-0 m-0"  > <a href="<?=url("ddemandado/".$item->CI)?>" onclick="procesar_borrar(event)"><i class="fa fa-trash" aria-hidden="true"></i></a></p> </td> 
    <td> <p  class="p-0 m-0"  > <?=$item->CI?> </p> </td>
    <td> <p  class="p-0 m-0"  style="width: 150px;" ><?= $item->TITULAR?></p></td>  
    <td  style="text-align: center;"> <p class="p-0  m-0" >{{ isset($item->nro)? $item->nro : ""}}</p></td>
  </tr>
  <?php  endforeach; ?>
  </tbody>
  </table>



<?php
  } 
?>
   

  

      