@extends('layouts.app')


@section('content')
    <table class="table table-bordered">

    <thead>
        <tr><td>CTA_BANCO</td><td>FECHA</td><td>IMPORTE</td><td>TITULAR</td></tr>
    </thead>

    <tbody>

    <?php foreach( $lista as $item): ?>

        <tr><td><?= $item->CTA_BANCO?></td><td><?= $item->FECHA?></td><td><?= $item->IMPORTE?></td><td><?= $item->TITULAR?></td></tr>
    <?php  endforeach; ?>

    </tbody>

    </table>
@endsection



