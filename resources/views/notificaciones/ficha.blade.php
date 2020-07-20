@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">FICHA DE SEGUIMIENTOS</li> 
@endsection

@section('content')

<div class="row">
  <div class="col-12 col-md-1">
  <h4>{{$ci}}</h4>
  </div>
  <div class="col-12 col-md-11">
  <h4>{{$nombre}}</h4>
  </div>
</div>



<!--Enlaces  --->
<a href="<?=url("vdemandado/$ci")?>">VER DATOS PERSONALES</a>
<a href="<?=url("ficha-demanda/$idnro")?>">VER DEMANDA</a>
<a href="<?=url("vobser/$idnro")?>">VER OBSERVACION</a>

<div class="row"> 
        
            <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="ctactecatas">Presentado:</label>
                <input readonly value="{{$ficha->PRESENTADO}}" name="PRESENTADO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Providencia:</label>
                <input readonly value="{{$ficha->PROVI_1}}" name="PROVI_1" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Notificación:</label>
                <input readonly value="{{$ficha->NOTIFI_1}}" name="NOTIFI_1" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Adjunto I.A.:</label>
                <input readonly value="{{$ficha->ADJ_AI}}" name="ADJ_AI" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="row">
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">A.I. Nro.:</label>
                <input readonly value="{{$ficha->AI_NRO}}" name="AI_NRO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">A.I. Fecha:</label>
                <input readonly value="{{$ficha->AI_FECHA}}" name="AI_FECHA" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
            </div>
            
          
           

      </div><!--end col 1 -->
      <div class="col-12 col-md-3">
      <div class="row">
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">Intimación:</label>
                <input readonly value="{{$ficha->INTIMACI_1}}" name="INTIMACI_1" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">Notificación:</label>
                <input readonly value="{{$ficha->INTIMACI_2}}" name="INTIMACI_2" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
            </div>
            <div class="form-group">
                <label for="ctactecatas">Citación:</label>
                <input readonly value="{{$ficha->CITACION}}" name="CITACION" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Providencia de Citación:</label>
                <input readonly value="{{$ficha->PROVI_CITA}}" name="PROVI_CITA" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Notificación:</label>
                <input readonly value="{{$ficha->NOTIFI_2}}" name="NOTIFI_2" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Adjunto S.D.:</label>
                <input readonly value="{{$ficha->ADJ_SD}}" name="ADJ_SD" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
      </div> <!--end col 2 -->
 
      <div class="col-12 col-md-3">
        
      <div class="row">
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">S.D.:</label>
                <input readonly value="{{$ficha->SD_NRO}}" name="SD_NRO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">Fecha:</label>
                <input readonly  value="{{$ficha->SD_FECHA}}" 	   type="date"  name="SD_FECHA"   id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
            </div>
            <div class="form-group">
                <label for="ctactecatas">Notificación:</label>
                <input readonly value="{{$ficha->NOTIFI_3}}" name="NOTIFI_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Adjunto liquidación:</label>
                <input readonly value="{{$ficha->ADJ_LIQUI}}" name="ADJ_LIQUI" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>

            <div class="form-group">
                  <label for="ctactecatas">Liquidación:</label>
                  <input readonly value="{{$ficha->LIQUIDACIO}}" name="LIQUIDACIO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="row">
              <div class="col-12 col-md-6">
              <div class="form-group">
                  <label for="ctactecatas">Providencia:</label>
                  <input readonly value="{{$ficha->PROVI_2}}" name="PROVI_2" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
              <div class="col-12 col-md-6">
              <div class="form-group">
                  <label for="ctactecatas">Notifica:</label>
                  <input readonly value="{{$ficha->NOTIFI_4}}" name="NOTIFI_4" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
            </div>
      
      </div><!--end col 3 -->
     

 


</div>
<div class="row">
<div class="col-12 col-md-5">

    <div class="form-group">
            <label for="ctactecatas">Adjunto aprobación:</label>
            <input readonly value="{{$ficha->ADJ_APROBA}}" name="ADJ_APROBA" type="text" id="ctactecatas" class="form-control form-control-sm   ">
      </div>

      <div class="row">
        <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="ctactecatas">Aprobación A.I:</label>
            <input readonly  value="{{$ficha->APROBA_AI}}" name="APROBA_AI" type="text" id="ctactecatas" class="form-control form-control-sm   ">
        </div> 
        </div>
        <div class="col-12 col-md-6">
        <div class="form-group">
              <label for="ctactecatas">Fecha aprob. AI:</label>
              <input readonly value="{{$ficha->APRO_FECHA}}" 	 type="date"  name="APRO_FECHA"   id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="form-group">
              <label for="ctactecatas">Importe aprobado AI:</label>
              <input readonly value="{{$ficha->APROB_IMPO}}" name="APROB_IMPO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="form-group">
              <label for="ctactecatas">Saldo:</label>
              <input readonly value="{{$ficha->SALDO_EXT}}" name="SALDO_EXT" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="form-group">
              <label for="ctactecatas">Adj.Oficio:</label>
              <input readonly value="{{$ficha->ADJ_OFICIO}}" name="ADJ_OFICIO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="form-group">
              <label for="ctactecatas">Notifica:</label>
              <input readonly value="{{$ficha->NOTIFI_5}}" name="NOTIFI_5" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-4">
          <div class="form-group">
              <label for="ctactecatas">Embargo N°:</label>
              <input readonly value="{{$ficha->EMBARGO_N}}" name="EMBARGO_N" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="form-group">
              <label for="ctactecatas">Fecha:</label>
              <input readonly value="{{$ficha->EMB_FECHA}}" 	   type="date"  name="EMB_FECHA"   id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="form-group">
              <label for="ctactecatas">Monto:</label>
              <input readonly value="{{$ficha->EMBAR_EJEC}}" name="EMBAR_EJEC" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
         </div>
      </div>
      <div class="row">
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="SD_FINIQUI">SD Finiquito:</label>
                  <input readonly  value="{{$ficha->SD_FINIQUI}}" name="SD_FINIQUI" type="text" id="ctactecatas" class="form-control form-control-sm   "> 
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ctactecatas">Fecha:</label>
                    <input readonly value="{{$ficha->FEC_FINIQU}}" name="FEC_FINIQU" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                </div>
              </div>
            </div>
 
            <div class="form-group">
                    <label for="ctactecatas">Otra Institución:</label>
                    <input readonly value="{{$ficha->OTRA_INSTI}}" name="OTRA_INSTI" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>

</div> <!-- col 4 -->
<div class="col-12 col-md-5">
  <div class="row" style="background-color: #bcfda6;">
    <!-- --> 
      <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="ctactecatas">Inhibición:</label>
            <input readonly  value="{{$ficha->INIVISION}}" name="INIVISION" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="ctactecatas">Fecha:</label>
            <input readonly value="{{$ficha->FEC_INIVI}}" 	min="2000-01-01" max="2050-12-31" type="date"  name="FEC_INIVI"   id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        <div class="form-group">
          <label for="ctactecatas">Arreglo Ex.J:</label>
          <input readonly  value="{{$ficha->ARREGLO_EX}}" name="ARREGLO_EX" type="text" id="ctactecatas" class="form-control form-control-sm   ">
        </div>
        <div class="form-group">
          <label for="ctactecatas">Levantamiento N° i=S:</label>
          <input readonly value="{{$ficha->LEVANTA}}" name="LEVANTA" type="text" id="ctactecatas" class="form-control form-control-sm   ">
        </div> 
        
      </div>
      <div class="col-12 col-md-4">
    
            <div class="form-group">
              <label for="ctactecatas">Fecha:</label>
              <input readonly value="{{$ficha->FEC_LEVANT}}" 	min="2000-01-01" max="2050-12-31"   type="date"  name="FEC_LEVANT"   id="ctactecatas" class="form-control form-control-sm   ">
            </div>  
            <div class="form-group">
              <label for="ctactecatas">Excepción:</label>
              <input readonly name="EXCEPCION" value="{{$ficha->EXCEPCION}}" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="ctactecatas">Apelación:</label>
              <input readonly name="APELACION" value="{{$ficha->APELACION}}" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="ctactecatas">Incidente:</label>
              <input readonly value="{{$ficha->INCIDENTE}}" name="INCIDENTE" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
          
      </div>
      
      <div class="col-12 col-md-4">
        <label for="">Depósito</label>{{$ficha->DEPOSITADO}}<br>
        <label for="">Extracción. C</label>{{$ficha->EXTRAIDO_C}}<br>
        <label for="">Extracción. L</label> {{$ficha->EXTRAIDO_L}}
                      <br>
                      <button class="btn btn-success mb-1">CANCELAR</button>
                      <br>
                      <button onclick="showMenuBanco()" class="btn btn-success" type="button">CTA BANCO</button>
      </div>
    <!-- -->
  </div>
</div>
</div>
 
  
</div>







  
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




function showMenuBanco(){
  
}
       
    </script>