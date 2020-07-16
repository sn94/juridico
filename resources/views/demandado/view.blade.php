@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">DEMANDADOS</li> 
@endsection

@section('content')


  
<div class="row">
  <div class="col-12 col-md-4">
    <div class="form-group">
        <label for="actuaria">Cedula:</label>
        <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->CI}}">
    </div>

        <div class="form-group">
            <label for="actuaria">Titular:</label>
             <input readonly  type="text"   class="form-control form-control-sm"  value="{{$ficha->TITULAR}}">
        </div>
        
        <div class="form-group">
            <label for="actuaria">Telefono:</label>
            <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->TELEFONO}}">
        </div>
           
        <div class="form-group">
            <label for="actuaria">Celular:</label>
            <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->CELULAR}}">
        </div> 
       
  </div>
 
  <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="actuaria">Direccion:</label>
             <input readonly  type="text"   class="form-control form-control-sm   " value="{{$ficha->DOMICILIO}}">
        </div> 
        <div class="form-group">
            <label for="actuaria">Direc.laboral:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->LABORAL}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Telef.laboral:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->TEL_TRABAJ}}">
        </div>
          <div class="form-group">
            <label for="actuaria">Garante:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->GARANTE}}">
        </div>
    
       
  </div>

  <div class="col-12 col-md-4">

        <div class="form-group">
            <label for="actuaria">Celula Gte.:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->CI_GARANTE}}">
        </div>

     <div class="form-group">
            <label for="actuaria">Direccion Gte:</label>
             <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->DOM_GARANT}}">
        </div>
        
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                <label for="actuaria">Telefono Gte:</label>
                <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->TEL_GARANT}}">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                <label for="actuaria">Telef.Laboral Gte.:</label>
                <input readonly  type="text"   class="form-control form-control-sm" value="{{$ficha->TEL_LAB_G}}">
                </div>
            </div>
        </div> 
        <div class="form-group">
            <label for="actuaria">Direc.Laboral Gte.:</label>
             <input readonly  type="text"   class="form-control form-control-sm"  value="{{$ficha->LABORAL_G}}">
        </div>
  </div>
   
  
    

     
</div>
  
  
@endsection 