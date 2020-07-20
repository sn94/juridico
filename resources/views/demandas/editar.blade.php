@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">AGREGAR</li> 
@endsection

@section('content')


<!-- EDITAR -->


<form id="formDeman" class="tab-content" method="post" action="<?=url("demandas-editar/$iddeman")?>">

{{csrf_field()}}
 

<button type="submit" class="btn btn-success" >Guardar</button>

<input type="hidden" name="CI"  value="{{$ci}}">

<div class="row">
  <div class="col-12 col-md-2">
  <h4>{{$ci}}</h4>
  </div>
  <div class="col-12 col-md-9">
  <h4>{{$nombre}}</h4>
  </div>
</div>
  



<div class="row">
  
  <div class="col-l2 col-md-3">
        <div class="form-group">
            <label for="actuaria">Origen:</label>
             <input    type="text"   class="form-control form-control-sm" value="{{$ficha->O_DEMANDA}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Demandante:</label>
             <input    type="text"   class="form-control form-control-sm" value="{{$ficha->DEMANDANTE}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Cod_emp:</label>
             <input    type="text"   class="form-control form-control-sm" value="{{$ficha->COD_EMP}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Actuaria:</label>
             <input    type="text"   class="form-control form-control-sm" value="{{$ficha->ACTUARIA}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Juez:</label>
             <input    type="text"   class="form-control form-control-sm" value="{{$ficha->JUEZ}}">
        </div>
       
    </div>
    
    <div class="col-12 col-md-3">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                <label for="actuaria">Demanda:</label>
                <input    type="text"   class="form-control form-control-sm" value="{{$ficha->DEMANDA}}">
                </div>
            </div>
            <div class="col-12 col-md-6">
            <div class="form-group">
            <label for="actuaria">Saldo:</label>
             <input    type="text"   class="form-control form-control-sm" value="{{$ficha->SALDO}}">
            </div>
            </div>
        </div>
     
        <div class="form-group">
            <label for="actuaria">Nro.Embargo:</label>
             <input    type="text"   class="form-control form-control-sm" value="{{$ficha->EMBARGO_NR}}">
        </div> 
        <div class="form-group">
            <label for="actuaria">Fecha de embargo:</label>
             <input    type="text"   class="form-control form-control-sm" value="{{$ficha->FEC_EMBARG}}">
        </div>
        <div class="form-group">
                <label for="actuaria">Institución:</label>
                 <input    type="text"   class="form-control form-control-sm" value="{{$ficha->INSTITUCIO}}">
            </div>
        <div class="form-group">
                <label for="actuaria">Tipo:</label>
                 <input    type="text"   class="form-control form-control-sm" value="{{$ficha->INST_TIPO}}">
        </div>
        
    </div>
     
    <div class="col-12 col-md-3">
    <div class="form-group">
                <label for="actuaria">Juzgado:</label>
                 <input    type="text"   class="form-control form-control-sm" value="{{$ficha->JUZGADO}}">
        </div>
        <div class="form-group">
                <label for="actuaria">Domic.denunciado:</label>
                 <input    type="text"   class="form-control form-control-sm" value="{{$ficha->DOC_DENUNC}}">
            </div> 
        <div class="form-group">
                <label for="actuaria">Localidad:</label>
                <input    type="text"   class="form-control form-control-sm" value="{{$ficha->LOCALIDAD}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Localidad del Gte.:</label>
            <input    type="text"   class="form-control form-control-sm" value="{{$ficha->LOCALIDA_G}}">
        </div>
        <div class="form-group">
                <label for="actuaria">Dom.denun.Gte:</label>
                 <input    type="text"   class="form-control form-control-sm" value="{{$ficha->DOC_DEN_GA}}">
        </div>
      
    </div>

    <div class="col-12 col-md-3">
       <div class="form-group">
            <label for="actuaria">Nro. Finca:</label>
             <input    type="text"   class="form-control form-control-sm" value="{{$ficha->FINCA_NRO}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Cta.Cte:</label>
             <input    type="text"   class="form-control form-control-sm" value="{{$ficha->CTA_BANCO}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Banco:</label>
             <input    type="text"   class="form-control form-control-sm" value="{{$ficha->BANCO}}">
        </div>
        <div class="form-group">
            <label for="actuaria">Cta.Catastral:</label>
             <input    type="text"   class="form-control form-control-sm" value="{{$ficha->CTA_CATAST}}">
        </div>
    </div>
</div>
  
</form>

  

  
@endsection



<script>
 


function enviar( ev){
  ev.preventDefault();
  $.ajax(
    {
      url:"<?= url("demandas-agregar")?>",
      method: "post",
      data: $("#formDeman").serialize(),
      
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      beforeSend: function(){
        $("#showSpinner").html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
      },
      success: function( res ){
        $("#showSpinner").html( res  ); //mensaje
        //$("#formDeman").reset();//limpiar formulario
      },
      error: function(){
        $("#showSpinner").html(  "" ); 
      }
    }
  );
}




 
       
    </script>