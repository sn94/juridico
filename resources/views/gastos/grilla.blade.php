<?php

use App\Helpers\Helper;
use App\Mobile_Detect;

$dete = new Mobile_Detect();
$iconsize =  $dete->isMobile() ? "" : "fa-lg";
?>

<style>
  td p a:link,
  td p a:visited {
    color: black;
  }

  tr {
    background: #fdc673 !important;
  }
</style>

@php
$TOTAL_INGRESOS= 0;
$TOTAL_EGRESOS= 0;
$TOTAL_I_EFE= 0;
$TOTAL_I_CHE= 0;
$TOTAL_I_GIRO= 0;
$TOTAL_E_EFE= 0;
$TOTAL_E_CHE= 0;
$TOTAL_E_GIRO= 0;


foreach( $totales as $tota):

if( $tota->FLAG == "INGRESO")
{
$TOTAL_INGRESOS+= $tota->IMPORTE;
if( $tota->METODO == "EFECTIVO") $TOTAL_I_EFE+= $tota->IMPORTE;
if( $tota->METODO == "CHEQUE") $TOTAL_I_CHE+= $tota->IMPORTE;
if( $tota->METODO == "GIRO_TIGO") $TOTAL_I_GIRO+= $tota->IMPORTE;
}
else
{
$TOTAL_EGRESOS+= $tota->IMPORTE;
if( $tota->METODO == "EFECTIVO") $TOTAL_E_EFE+= $tota->IMPORTE;
if( $tota->METODO == "CHEQUE") $TOTAL_E_CHE+= $tota->IMPORTE;
if( $tota->METODO == "GIRO_TIGO") $TOTAL_E_GIRO+= $tota->IMPORTE;
}

endforeach;

$TOTAL_INGRESOS= Helper::number_f($TOTAL_INGRESOS);
$TOTAL_EGRESOS= Helper::number_f($TOTAL_EGRESOS);
$TOTAL_I_EFE= Helper::number_f( $TOTAL_I_EFE);
$TOTAL_I_CHE= Helper::number_f( $TOTAL_I_CHE);
$TOTAL_I_GIRO= Helper::number_f( $TOTAL_I_GIRO);
$TOTAL_E_EFE= Helper::number_f( $TOTAL_E_EFE);
$TOTAL_E_CHE= Helper::number_f( $TOTAL_E_CHE);
$TOTAL_E_GIRO= Helper::number_f( $TOTAL_E_GIRO);

@endphp


<div class="row">
  <div class="col-12 col-md-6">
    <table class="table table-bordered  table-striped">
      <tr  >
        <th colspan="3" class="p-0 text-center">INGRESOS</th>
      </tr>
      <tr  >
        <th colspan="3"   class="p-0 text-center" > {{$TOTAL_INGRESOS}} </th>
      </tr>
      <tr>
        <th class="text-right p-0">EFECTIVO</th>
        <th class="text-right p-0">CHEQUE</th>
        <th class="text-right p-0">GIRO_TIGO</th>
      </tr>
      <tr>
        <th class="text-right p-0"> {{$TOTAL_I_EFE}} </th>
        <th class="text-right p-0">{{$TOTAL_I_CHE}}</th>
        <th class="text-right p-0">{{$TOTAL_I_GIRO}}</th>
      </tr>
    </table>
  </div>
  <div class="col-12 col-md-6">
    <table class="table table-bordered  table-striped">
      <tr>
        <th colspan="3" class="text-center p-0">EGRESOS</th>
      </tr>
      <tr>
        <th colspan="3" class=" text-center p-0">{{$TOTAL_EGRESOS}}</th>
      </tr>
      <tr>
        <th class="text-right p-0">EFECTIVO</th>
        <th class="text-right p-0">CHEQUE</th>
        <th class="text-right p-0">GIRO_TIGO</th>
      </tr>
      <tr>
        <th class="text-right p-0"> {{$TOTAL_E_EFE}} </th>
        <th class="text-right p-0">{{$TOTAL_E_CHE}}</th>
        <th class="text-right p-0">{{$TOTAL_E_GIRO}}</th>
      </tr>
    </table>
  </div>
</div>






<table id="gastos" class="table  table-sm table-bordered  table-striped">
  <thead class="thead-dark">
    <tr>
      <th></th>


      <th></th>


      <th>FECHA
        <a onclick="ordena_grilla('FECHA','A')" href="#"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        <a onclick="ordena_grilla('FECHA','D')" href="#"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
      </th>

      <th>MOTIVO
        <a onclick="ordena_grilla('ID_DEMA','A')" href="#"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        <a onclick="ordena_grilla('ID_DEMA','D')" href="#"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
      </th>

      <th>CODIGO
        <a onclick="ordena_grilla('CODIGO','A')" href="#"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        <a onclick="ordena_grilla('CODIGO','D')" href="#"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
      </th>

      <th>NUMERO
        <a onclick="ordena_grilla('NUMERO','A')" href="#"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        <a onclick="ordena_grilla('NUMERO','D')" href="#"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
      </th>

      <th>DETALLE 1</th>

      <th class="text-right">IMPORTE
        <a onclick="ordena_grilla('IMPORTE','A')" href="#"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        <a onclick="ordena_grilla('IMPORTE','D')" href="#"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
      </th>

      <th>REGISTRO</th>
    </tr>
  </thead>
  <tbody>
    <!--CADA CTA TENDRA ALGUN DEPOSITO, EXTRACCION O EXTRACCION POR PROYECTO-->
    <?php foreach ($movi as $it) : ?>

      @php
      //es gasto o ingreso
      $style_row= $it->FLAG =="GASTO" ? "table-danger" : "table-success";
      @endphp

      <tr id="{{$it->IDNRO}}" class="{{$style_row}}">

        <td>
          <p class="pt-1 mr-1 ml-1 mb-0 text-center"><a onclick="mostrar_form(event)" data-toggle="modal" data-target="#showform" href="<?= url("gasto/M/" . $it->IDNRO) ?>"><i class="fa fa-pencil {{$iconsize}}" aria-hidden="true"></i></a></p>
        </td>


        <td>
          <p class="pt-1 mr-1 ml-1 mb-0 text-center"><a onclick="borrar(event)" href="<?= url("dgasto/" . $it->IDNRO) ?>"><i class="fa fa-trash {{$iconsize}}" aria-hidden="true"></i></a></p>
        </td>


        <td class="text-right">
          <p class="pt-1 mr-1 ml-1 mb-0"> {{ Helper::fecha_dma($it->FECHA) }} </p>
        </td>

        <td class="text-left">
          <p class="pt-1 mr-1 ml-1 mb-0">
            @if (is_null( $it->ID_DEMA) )
            VARIOS
            @else
            <a style="text-decoration: underline;" href="<?= url("ficha-demanda/" . $it->ID_DEMA) ?>">DEMANDA ( {{$it->COD_EMP}})</a>
            @endif
          </p>
        </td>

        <td class="text-right">
          <p class="pt-1 mr-1 ml-1 mb-0">{{ $it->COD_GASTO }}</p>
        </td>
        <td class="text-right">
          <p class="pt-1 mr-1 ml-1 mb-0">{{$it->NUMERO}}</p>
        </td>
        <td class="text-right">
          <p class="pt-1 mr-1 ml-1 mb-0">{{$it->DETALLE1}}</p>
        </td>

        <td class="text-right">
          <p class="pt-1 mr-1 ml-1 mb-0 text-right">{{ Helper::number_f(  abs( $it->IMPORTE)  ) }}</p>
        </td>
        <td class="text-right">
          <p class="pt-1 mr-1 ml-1 mb-0">{{ Helper::beautyDate($it->created_at) }}</p>
        </td>
      </tr>

    <?php endforeach; ?>
  </tbody>
</table>

@if( $movi->count())
{{ $movi->links()}}
@endif


<script>
  /*
    window.onload= function(){
        $('#gastos').DataTable( {
          "ordering": true,
          "autoWidth": false,
          paging: false,
          "language": {   "url": "<?= url("assets/Spanish.json") ?>"  }
        } );
    };
 */
</script>