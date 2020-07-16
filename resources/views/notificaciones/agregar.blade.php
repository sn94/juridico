@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">SEGUIMIENTOS</li> 
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


  <form id="formDeman" class="tab-content" method="post" action="<?=url("nnotifi/$iddeman")?>">

  <div class="btn-group" role="group" aria-label="Basic example"> 
  <button type="submit" class="btn btn-secondary"  >Guardar</button>
</div>
 


  {{csrf_field()}} 

  

<input type="hidden" name="IDNRO" value="{{$iddeman}}">
<input type="hidden" name="CI" value="{{$ci}}">

<div class="row"> 
        
            <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="ctactecatas">Presentado:</label>
                <input name="PRESENTADO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Providencia:</label>
                <input name="PROVI_1" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Notificación:</label>
                <input name="NOTIFI_1" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Adjunto I.A.:</label>
                <input name="ADJ_AI" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="row">
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">A.I. Nro.:</label>
                <input name="AI_NRO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">A.I. Fecha:</label>
                <input name="AI_FECHA" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
            </div>
            
          
           

      </div><!--end col 1 -->
      <div class="col-12 col-md-3">
      <div class="row">
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">Intimación:</label>
                <input name="INTIMACI_1" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">Notificación:</label>
                <input name="INTIMACI_2" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
            </div>
            <div class="form-group">
                <label for="ctactecatas">Citación:</label>
                <input name="CITACION" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Providencia de Citación:</label>
                <input name="PROVI_CITA" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Notificación:</label>
                <input name="NOTIFI_2" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Adjunto S.D.:</label>
                <input name="ADJ_SD" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
      </div> <!--end col 2 -->
 
      <div class="col-12 col-md-3">
        
      <div class="row">
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">S.D.:</label>
                <input name="SD_NRO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">Fecha:</label>
                <input name="SD_FECHA" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
            </div>
            <div class="form-group">
                <label for="ctactecatas">Notificación:</label>
                <input name="NOTIFI_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Adjunto liquidación:</label>
                <input name="ADJ_LIQUI" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>

            <div class="form-group">
                  <label for="ctactecatas">Liquidación:</label>
                  <input name="LIQUIDACIO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="row">
              <div class="col-12 col-md-6">
              <div class="form-group">
                  <label for="ctactecatas">Providencia:</label>
                  <input name="PROVI_2" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
              <div class="col-12 col-md-6">
              <div class="form-group">
                  <label for="ctactecatas">Notifica:</label>
                  <input name="NOTIFI_4" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
            </div>
      
      </div><!--end col 3 -->
     


 <!--fin campos seguimiento -->


</div>
<div class="row">
<div class="col-12 col-md-5">

    <div class="form-group">
            <label for="ctactecatas">Adjunto aprobación:</label>
            <input name="ADJ_APROBA" type="text" id="ctactecatas" class="form-control form-control-sm   ">
      </div>

      <div class="row">
        <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="ctactecatas">Aprobación A.I:</label>
            <input name="APROBA_AI" type="text" id="ctactecatas" class="form-control form-control-sm   ">
        </div> 
        </div>
        <div class="col-12 col-md-6">
        <div class="form-group">
              <label for="ctactecatas">Fecha aprob. AI:</label>
              <input name="APRO_FECHA" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="form-group">
              <label for="ctactecatas">Importe aprobado AI:</label>
              <input name="APROB_IMPO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="form-group">
              <label for="ctactecatas">Saldo:</label>
              <input name="SALDO_EXT" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="form-group">
              <label for="ctactecatas">Adj.Oficio:</label>
              <input name="ADJ_OFICIO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="form-group">
              <label for="ctactecatas">Notifica:</label>
              <input name="NOTIFI_5" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-4">
          <div class="form-group">
              <label for="ctactecatas">Embargo N°:</label>
              <input name="EMBARGO_N" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="form-group">
              <label for="ctactecatas">Fecha:</label>
              <input name="EMB_FECHA" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="form-group">
              <label for="ctactecatas">Monto:</label>
              <input name="EMBAR_EJEC" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
         </div>
      </div>
      <div class="row">
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="SD_FINIQUI">SD Finiquito:</label>
                  <input name="SD_FINIQUI" type="text" id="ctactecatas" class="form-control form-control-sm   "> 
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ctactecatas">Fecha:</label>
                    <input name="FEC_FINIQU" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                </div>
              </div>
            </div>
 
            <div class="form-group">
                    <label for="ctactecatas">Otra Institución:</label>
                    <input name="OTRA_INSTI" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>

</div> <!-- col 4 -->
<div class="col-12 col-md-5">
  <div class="row" style="background-color: #bcfda6;">
    <!-- --> 
      <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="ctactecatas">Inhibición:</label>
            <input name="INIVISION" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="ctactecatas">Fecha:</label>
            <input name="FEC_INIVI" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        <div class="form-group">
          <label for="ctactecatas">Arreglo Ex.J:</label>
          <input name="ARREGLO_EX" type="text" id="ctactecatas" class="form-control form-control-sm   ">
        </div>
        <div class="form-group">
          <label for="ctactecatas">Levantamiento N° i=S:</label>
          <input name="LEVANTA" type="text" id="ctactecatas" class="form-control form-control-sm   ">
        </div> 
        
      </div>
      <div class="col-12 col-md-4">
    
            <div class="form-group">
              <label for="ctactecatas">Fecha:</label>
              <input name="FEC_LEVANT" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>  
            <div class="form-group">
              <label for="ctactecatas">Excepción:</label>
              <input name="EXCEPCION" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="ctactecatas">Apelación:</label>
              <input name="APELACION" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="ctactecatas">Incidente:</label>
              <input name="INCIDENTE" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
          
      </div>
      
      <div class="col-12 col-md-4">
        <label for="">Depósito</label><br>
        <label for="">Extracción. C</label><br>
        <label for="">Extracción. L</label> 
                      <br>
                      <button class="btn btn-success mb-1">CANCELAR</button>
                      <br>
                      <button onclick="showMenuBanco()" class="btn btn-success" type="button">CTA BANCO</button>
      </div>
    <!-- -->
  </div>
</div>
</div>
<div class="row">

</div>
 
  </form>
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