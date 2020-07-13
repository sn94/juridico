@extends('layouts.app')


@section('content')
    <table class="table table-bordered">

    <thead>
        <tr><td>BANCO</td><td>CUENTA</td><td>FECHA</td><td>NUMERO</td><td>CODIGO</td><td>IMPORTE</td><td>CONCEPTO</td><td>PROYECTO</td><td>NRO_RECIBO</td><td>PROVEEDOR</td></tr>
    </thead>

    <tbody>

    <?php foreach( $lista as $item): ?>

        <tr><td><?= $item->BANCO?></td><td><?= $item->CUENTA?></td><td><?= $item->FECHA?></td><td><?= $item->NUMERO?></td><td><?= $item->CODIGO?></td><td><?= $item->IMPORTE?></td><td><?= $item->CONCEPTO?></td><td><?= $item->PROJECTO?></td><td><?= $item->NRO_RECIBO?></td><td><?= $item->PROVEEDOR ?></td></tr>
    <?php  endforeach; ?>

    </tbody>

    </table>
@endsection



