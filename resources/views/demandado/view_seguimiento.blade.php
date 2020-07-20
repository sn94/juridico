@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">DEMANDADOS (SEGUIMIENTO)</li> 
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
<h4>DATOS DE SEGUIMIENTO - NOTIFICACIONES</h4>
<div class="row"> 
        
            <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="ctactecatas">Presentado:</label>
                <input readonly name="PRESENTADO" type="text"   class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Providencia:</label>
                <input readonly name="PROVI_1" type="text"   class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Notificación:</label>
                <input readonly name="NOTIFI_1" type="text"   class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Adjunto I.A.:</label>
                <input readonly name="ADJ_AI" type="text"   class="form-control form-control-sm   ">
            </div>
            <div class="row">
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">A.I. Nro.:</label>
                <input readonly name="AI_NRO" type="text"   class="form-control form-control-sm   ">
              </div>
              </div>
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">A.I. Fecha:</label>
                <input readonly name="AI_FECHA" type="text"   class="form-control form-control-sm   ">
              </div>
              </div>
            </div>
            
          
           

      </div><!--end col 1 -->
      <div class="col-12 col-md-3">
      <div class="row">
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">Intimación:</label>
                <input readonly name="INTIMACI_1" type="text"   class="form-control form-control-sm   ">
              </div>
              </div>
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">Notificación:</label>
                <input readonly name="INTIMACI_2" type="text"   class="form-control form-control-sm   ">
              </div>
              </div>
            </div>
            <div class="form-group">
                <label for="ctactecatas">Citación:</label>
                <input readonly name="CITACION" type="text"   class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Providencia de Citación:</label>
                <input readonly name="PROVI_CITA" type="text"   class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Notificación:</label>
                <input readonly name="NOTIFI_2" type="text"   class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Adjunto S.D.:</label>
                <input readonly name="ADJ_SD" type="text"   class="form-control form-control-sm   ">
            </div>
      </div> <!--end col 2 -->
 
      <div class="col-12 col-md-3">
        
      <div class="row">
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">S.D.:</label>
                <input readonly name="SD_NRO" type="text"   class="form-control form-control-sm   ">
              </div>
              </div>
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">Fecha:</label>
                <input readonly  value="2018-07-22" 	min="2000-01-01" max="2050-12-31" name="FEC_EMBARG" type="date"  name="SD_FECHA"     class="form-control form-control-sm   ">
              </div>
              </div>
            </div>
            <div class="form-group">
                <label for="ctactecatas">Notificación:</label>
                <input readonly name="NOTIFI_3" type="text"   class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Adjunto liquidación:</label>
                <input readonly name="ADJ_LIQUI" type="text"   class="form-control form-control-sm   ">
            </div>

            <div class="form-group">
                  <label for="ctactecatas">Liquidación:</label>
                  <input readonly name="LIQUIDACIO" type="text"   class="form-control form-control-sm   ">
            </div>
            <div class="row">
              <div class="col-12 col-md-6">
              <div class="form-group">
                  <label for="ctactecatas">Providencia:</label>
                  <input readonly name="PROVI_2" type="text"   class="form-control form-control-sm   ">
              </div>
              </div>
              <div class="col-12 col-md-6">
              <div class="form-group">
                  <label for="ctactecatas">Notifica:</label>
                  <input readonly name="NOTIFI_4" type="text"   class="form-control form-control-sm   ">
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
            <input readonly name="ADJ_APROBA" type="text"   class="form-control form-control-sm   ">
      </div>

      <div class="row">
        <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="ctactecatas">Aprobación A.I:</label>
            <input readonly name="APROBA_AI" type="text"   class="form-control form-control-sm   ">
        </div> 
        </div>
        <div class="col-12 col-md-6">
        <div class="form-group">
              <label for="ctactecatas">Fecha aprob. AI:</label>
              <input readonly value="2018-07-22" 	min="2000-01-01" max="2050-12-31" name="FEC_EMBARG" type="date"  name="APRO_FECHA"     class="form-control form-control-sm   ">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="form-group">
              <label for="ctactecatas">Importe aprobado AI:</label>
              <input readonly name="APROB_IMPO" type="text"   class="form-control form-control-sm   ">
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="form-group">
              <label for="ctactecatas">Saldo:</label>
              <input readonly name="SALDO_EXT" type="text"   class="form-control form-control-sm   ">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="form-group">
              <label for="ctactecatas">Adj.Oficio:</label>
              <input readonly name="ADJ_OFICIO" type="text"   class="form-control form-control-sm   ">
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="form-group">
              <label for="ctactecatas">Notifica:</label>
              <input readonly name="NOTIFI_5" type="text"   class="form-control form-control-sm   ">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-4">
          <div class="form-group">
              <label for="ctactecatas">Embargo N°:</label>
              <input readonly name="EMBARGO_N" type="text"   class="form-control form-control-sm   ">
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="form-group">
              <label for="ctactecatas">Fecha:</label>
              <input readonly value="2018-07-22" 	min="2000-01-01" max="2050-12-31" name="FEC_EMBARG" type="date"  name="EMB_FECHA"     class="form-control form-control-sm   ">
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="form-group">
              <label for="ctactecatas">Monto:</label>
              <input readonly name="EMBAR_EJEC" type="text"   class="form-control form-control-sm   ">
          </div>
         </div>
      </div>
      <div class="row">
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="SD_FINIQUI">SD Finiquito:</label>
                  <input readonly name="SD_FINIQUI" type="text"   class="form-control form-control-sm   "> 
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ctactecatas">Fecha:</label>
                    <input readonly name="FEC_FINIQU" type="text"   class="form-control form-control-sm   ">
                </div>
              </div>
            </div>
 
            <div class="form-group">
                    <label for="ctactecatas">Otra Institución:</label>
                    <input readonly name="OTRA_INSTI" type="text"   class="form-control form-control-sm   ">
            </div>

</div> <!-- col 4 -->
<div class="col-12 col-md-5">
  <div class="row" style="background-color: #bcfda6;">
    <!-- --> 
      <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="ctactecatas">Inhibición:</label>
            <input readonly name="INIVISION" type="text"   class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="ctactecatas">Fecha:</label>
            <input readonly value="2018-07-22" 	min="2000-01-01" max="2050-12-31" name="FEC_EMBARG" type="date"  name="FEC_INIVI"     class="form-control form-control-sm   ">
          </div>
        <div class="form-group">
          <label for="ctactecatas">Arreglo Ex.J:</label>
          <input readonly name="ARREGLO_EX" type="text"   class="form-control form-control-sm   ">
        </div>
        <div class="form-group">
          <label for="ctactecatas">Levantamiento N° i=S:</label>
          <input readonly name="LEVANTA" type="text"   class="form-control form-control-sm   ">
        </div> 
        
      </div>
      <div class="col-12 col-md-4">
    
            <div class="form-group">
              <label for="ctactecatas">Fecha:</label>
              <input readonly value="2018-07-22" 	min="2000-01-01" max="2050-12-31" name="FEC_EMBARG" type="date"  name="FEC_LEVANT"     class="form-control form-control-sm   ">
            </div>  
            <div class="form-group">
              <label for="ctactecatas">Excepción:</label>
              <input readonly name="EXCEPCION" type="text"   class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="ctactecatas">Apelación:</label>
              <input readonly name="APELACION" type="text"   class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
              <label for="ctactecatas">Incidente:</label>
              <input readonly name="INCIDENTE" type="text"   class="form-control form-control-sm   ">
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
  
@endsection 