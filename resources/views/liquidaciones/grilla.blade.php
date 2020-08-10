
 
<?php

use App\Helpers\Helper;

?>
<table id="tlistaliquida" class="table  table-sm table-bordered table-striped table-responsive">
        <thead class="thead-dark">
            <tr><th></th><th></th><th></th><th></th><th class="text-right">SALDO</th><th class="text-right">ULT_PAGO</th><th class="text-right">TOTAL</th></tr>
        </thead>
        <tbody>
          <?php  foreach( $lista as $it):?>
            <tr id="{{$it->IDNRO}}">

              <td ><p class="p-0 m-0"><a  style="color:black;" href="<?= url("vliquida/".$it->IDNRO) ?>"><i class="fa fa-eye" aria-hidden="true"></i></a></p></td>
              <td><p class="p-0 m-0"><a  style="color:black;"   href="<?= url("eliquida/".$it->IDNRO) ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></p></td>
              <td><p class="p-0 m-0"><a style="color:black;"  onclick="borrar(event)" href="<?= url("dliquida/".$it->IDNRO) ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></p></td>
              <td>
          <!--MANDAR A IMPRIMIR -->
          <a  data-toggle="modal" data-target="#show_opc_rep" onclick="mostrar_informe(event)" style="color:black;" > <i class="fa fa-print  fa-2x " aria-hidden="true"></i>
          </a> 
          </td>
              <td class="text-right"><p class="p-0 m-0">{{Helper::number_f($it->SALDO)}}</p></td>
              <td  class="text-right"><p class="p-0 m-0">{{ $it->ULT_PAGO }}</p></td>
              <td  class="text-right"><p class="p-0 m-0">{{Helper::number_f($it->TOTAL) }}</p></td>
            </tr>

          <?php  endforeach; ?>
        </tbody>
    </table> 


     <!-- MODAL TIPO DE INFORME -->
 <div id="show_opc_rep" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" >
    <a  id="info-xls" onclick="callToXlsGen(event, 'LIQUIDACION')" class="btn btn-sm btn-info" href="<?=url("jsonliquida")?>"><i class="fa fa-file-excel-o fa-2x" aria-hidden="true"></i> <h3>EXCEL</h3></a>
   
    <a  id="info-pdf"  class="btn btn-sm btn-info" href="<?=url("pdfliquida")?>"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i><h3>PDF</h3></a>
    <a  id="info-print" class="btn btn-sm btn-info" href="<?=url("jsonliquida")?>"><i class="fa fa-print fa-2x" aria-hidden="true"></i><h3>Printer</h3></a>
    </div>
  </div>
</div>


<script type="text/javascript">


function mostrar_informe(ev){
    ev.preventDefault();
    let id= ev.currentTarget.parentNode.parentNode.id;
    let xls= "<?=url("jsonliquida")?>";
    let pdf= "<?=url("pdfliquida")?>";

    $("#info-xls").attr("href", xls+"/"+id );
    $("#info-pdf").attr("href", pdf+"/"+id );
    $("#info-print").attr("href", $("#info-print").attr("href")+"/"+id );
    ev.currentTarget.href.concat( id ) ;
  }


</script>