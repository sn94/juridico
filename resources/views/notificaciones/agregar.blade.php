 

  <form onsubmit="enviar2(event)" id="formDeman2" class="tab-content" method="post" action="<?=url("nnotifi")?>">

  <div class="btn-group" role="group" aria-label="Basic example"> 
  <button type="submit" class="btn btn-info btn-sm"  >GUARDAR</button>
</div>
 


  {{csrf_field()}} 

  

<input id="id_demanda2" type="hidden" name="IDNRO"  >
<input type="hidden" name="CI"  id="ci2">

<div class="row"> 
        
            <div class="col-12 col-md-4">
            <div class="form-group">
                <label for="ctactecatas">Presentado:</label>
                <input name="PRESENTADO" type="date" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Providencia:</label>
                <input name="PROVI_1" type="date" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Notificación:</label>
                <input name="NOTIFI_1" type="date" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Adjunto I.A.:</label>
                <input name="ADJ_AI" type="date" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="row">
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">A.I. Nro.:</label>
                <input  oninput="formatear(this)"  name="AI_NRO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">A.I. Fecha:</label>
                <input name="AI_FECHA" type="date" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
            </div>
             
      </div><!--end col 1 -->


      <div class="col-12 col-md-4">
      <div class="row">
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">Intimación:</label>
                <input name="INTIMACI_1" type="date" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">Notificación:</label>
                <input name="INTIMACI_2" type="date" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
            </div>
            <div class="form-group">
                <label for="ctactecatas">Citación:</label>
                <input name="CITACION" type="date" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Providencia de Citación:</label>
                <input name="PROVI_CITA" type="date" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Notificación:</label>
                <input name="NOTIFI_2" type="date" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Adjunto S.D.:</label>
                <input name="ADJ_SD" type="date" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
      </div> <!--end col 2 -->
 
      <div class="col-12 col-md-4">
        
      <div class="row">
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">S.D.:</label>
                <input   oninput="formatear(this)"  name="SD_NRO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
              <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="ctactecatas">Fecha:</label>
                <input     type="date"  name="SD_FECHA"   id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
            </div>
            <div class="form-group">
                <label for="ctactecatas">Notificación:</label>
                <input name="NOTIFI_3" type="date" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="form-group">
                <label for="ctactecatas">Adjunto liquidación:</label>
                <input name="ADJ_LIQUI" type="date" id="ctactecatas" class="form-control form-control-sm   ">
            </div>

            <div class="form-group">
                  <label for="ctactecatas">Liquidación:</label>
                  <input   oninput="formatear(this)"  name="LIQUIDACIO" type="date" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
            <div class="row">
              <div class="col-12 col-md-6">
              <div class="form-group">
                  <label for="ctactecatas">Providencia:</label>
                  <input name="PROVI_2" type="date" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
              <div class="col-12 col-md-6">
              <div class="form-group">
                  <label for="ctactecatas">Notifica:</label>
                  <input name="NOTIFI_4" type="date" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              </div>
            </div>
      
      </div><!--end col 3 -->
</div>



<div class="row">
<div class="col-12 col-md-5">

    <div class="form-group">
            <label for="ctactecatas">Adjunto aprobación:</label>
            <input name="ADJ_APROBA" type="date" id="ctactecatas" class="form-control form-control-sm   ">
      </div>

      <div class="row">
        <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="ctactecatas">Aprobación A.I:</label>
            <input  oninput="formatear(this)"   name="APROBA_AI" type="text" id="ctactecatas" class="form-control form-control-sm   ">
        </div> 
        </div>
        <div class="col-12 col-md-6">
        <div class="form-group">
              <label for="ctactecatas">Fecha aprob. AI:</label>
              <input   type="date"  name="APRO_FECHA"   id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="form-group">
              <label for="ctactecatas">Importe aprobado AI:</label>
              <input oninput="formatear(this)"  name="APROB_IMPO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="form-group">
              <label for="ctactecatas">Saldo:</label>
              <input  oninput="formatear(this)"   name="SALDO_EXT" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="form-group">
              <label for="ctactecatas">Adj.Oficio:</label>
              <input name="ADJ_OFICIO" type="date" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="form-group">
              <label for="ctactecatas">Notifica:</label>
              <input name="NOTIFI_5" type="date" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-4">
          <div class="form-group">
              <label for="ctactecatas">Embargo N°:</label>
              <input  oninput="formatear(this)"   name="EMBARGO_N" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="form-group">
              <label for="ctactecatas">Fecha:</label>
              <input   type="date"  name="EMB_FECHA"   id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="form-group">
              <label for="ctactecatas">Monto:</label>
              <input  oninput="formatear(this)"  name="EMBAR_EJEC" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
         </div>
      </div>
      <div class="row">
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="SD_FINIQUI">SD Finiquito:</label>
                  <input  oninput="formatear(this)"  name="SD_FINIQUI" type="text" id="ctactecatas" class="form-control form-control-sm   "> 
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ctactecatas">Fecha:</label>
                    <input name="FEC_FINIQU" type="date" id="ctactecatas" class="form-control form-control-sm   ">
                </div>
              </div>
            </div>
 
            <div class="form-group">
                    <label for="ctactecatas">Otra Institución:</label>
                    <input name="OTRA_INSTI" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>

</div> <!-- col 4 -->
<div class="col-12 col-md-7">
  <div class="row" style="background-color: #bcfda6;">
    <!-- --> 
      <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="ctactecatas">Inhibición:</label>
            <input  oninput="formatear(this)"   name="INIVISION" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
          <div class="form-group">
            <label for="ctactecatas">Fecha:</label>
            <input   type="date"  name="FEC_INIVI"   id="ctactecatas" class="form-control form-control-sm   ">
          </div>
        <div class="form-group">
          <label for="ctactecatas">Arreglo Ex.J:</label>
          <input name="ARREGLO_EX" type="text" id="ctactecatas" class="form-control form-control-sm   ">
        </div>
        <div class="form-group">
          <label for="ctactecatas">Levantamiento N° i=S:</label>
          <input  oninput="formatear(this)"  name="LEVANTA" type="text" id="ctactecatas" class="form-control form-control-sm   ">
        </div> 
        
      </div>
      <div class="col-12 col-md-4">
    
            <div class="form-group">
              <label for="ctactecatas">Fecha:</label>
              <input   type="date"  name="FEC_LEVANT"   id="ctactecatas" class="form-control form-control-sm   ">
            </div>  
            <div class="form-check">
              <input class="form-check-input" name="EXCEPCION" type="checkbox" value="s" id="defaultCheck1">
              <label class="form-check-label" for="defaultCheck1">
                Excepción
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" name="APELACION" type="checkbox" value="s" id="defaultCheck2">
              <label class="form-check-label" for="defaultCheck2">
                Apelación
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" name="INCIDENTE" type="checkbox" value="s" id="defaultCheck3">
              <label class="form-check-label" for="defaultCheck3">
                Incidente
              </label>
            </div> 
          
      </div>
      
      <div class="col-12 col-md-4">
        <div class="form-group">
                <label for="ctactecatas">DEPÓSITO:</label>
                <input  oninput="formatear(this)"   name="DEPOSITADO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
        </div>
        <div class="form-group">
                <label for="ctactecatas">EXTRACCIÓN C.:</label>
                <input  oninput="formatear(this)"   name="EXTRAIDO_C" type="text" id="ctactecatas" class="form-control form-control-sm   ">
        </div>
        <div class="form-group">
                <label for="ctactecatas">EXTRACCIÓN C.:</label>
                <input  oninput="formatear(this)"  name="EXTRAIDO_L" type="text" id="ctactecatas" class="form-control form-control-sm   ">
        </div>
       
                      <br>
                      <button class="btn btn-success mb-1">CANCELAR</button>
                      <br>
                      <button onclick="showMenuBanco()" class="btn btn-success" type="button">CTA BANCO</button>
      </div>
    <!-- -->
  </div>
</div>
</div>
 
 
  </form>
 





 
 