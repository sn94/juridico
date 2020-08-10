 
  <form  id="formNoti" class="tab-content" method="post" action="<?= url("enotifi")?>" onsubmit="enviar2(event)">


  <?php 
  use App\Helpers\Helper;
  if( $OPERACION != "V"): ?>
    <button type="submit" class="btn btn-success btn-sm" >Guardar</button>

<?php endif; ?>

  


  {{csrf_field()}} 



<input id="IDNRO1" type="hidden" name="IDNRO" value="{{isset($id_demanda)?$id_demanda:''}}">
<input id="CI2" type="hidden" name="CI" value="{{  !isset($ficha2) ? '' : $ficha2->CI }}">
 


<div class="row  .no-gutters"> 
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
      <label for="ctactecatas">Presentado:</label>
      <input   oninput="mydateformat(event)"      value="{{Helper::fecha_f((! isset($ficha2) ? '' : $ficha2-> PRESENTADO))}}" name="PRESENTADO" type="date" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
  </div>
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
      <div class="form-group">
                <label for="ctactecatas">Providencia:</label>
                <input   value="{{Helper::fecha_f( (! isset($ficha2) ? '' : $ficha2-> PROVI_1) )}}" name="PROVI_1"   type="date"    id="ctactecatas" class="form-control form-control-sm   ">
      </div>
  </div>
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
      <div class="form-group">
                <label for="ctactecatas">Notificación:</label>
                <input   value="{{Helper::fecha_f((! isset($ficha2) ? '' : $ficha2-> NOTIFI_1))}}" name="NOTIFI_1"   type="date"    id="ctactecatas" class="form-control form-control-sm   ">
      </div>  
  </div>
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
      <div class="form-group">
                <label for="ctactecatas">Adjunto I.A.:</label>
                <input   value="{{Helper::fecha_f((! isset($ficha2) ? '' : $ficha2-> ADJ_AI))}}" name="ADJ_AI"   type="date"    id="ctactecatas" class="form-control form-control-sm   ">
      </div>
  </div>
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
                <label for="ctactecatas">A.I. Nro.:</label>
                <input  oninput="formatear(event)"  value="{{Helper::number_f((! isset($ficha2) ? '' : $ficha2-> AI_NRO))}}" name="AI_NRO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
  </div>
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
  <div class="form-group">
                <label for="ctactecatas">A.I. Fecha:</label>
                <input   value="{{Helper::fecha_f((! isset($ficha2) ? '' : $ficha2-> AI_FECHA))}}" name="AI_FECHA"   type="date"    id="ctactecatas" class="form-control form-control-sm   ">
              </div>
  </div>
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
  <div class="form-group">
                <label for="ctactecatas">Intimación:</label>
                <input   value="{{Helper::fecha_f(! isset($ficha2) ? '' : $ficha2-> INTIMACI_1)}}" name="INTIMACI_1"   type="date"    id="ctactecatas" class="form-control form-control-sm   ">
              </div>
  </div>
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
  <div class="form-group">
                <label for="ctactecatas">Notificación:</label>
                <input   value="{{Helper::fecha_f(! isset($ficha2) ? '' : $ficha2-> INTIMACI_2)}}" name="INTIMACI_2"   type="date"    id="ctactecatas" class="form-control form-control-sm   ">
              </div>
  </div>
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
  <div class="form-group">
                <label for="ctactecatas">Citación:</label>
                <input   value="{{Helper::fecha_f(! isset($ficha2) ? '' : $ficha2-> CITACION)}}" name="CITACION"   type="date"    id="ctactecatas" class="form-control form-control-sm   ">
            </div>
  </div>
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
  <div class="form-group">
                <label for="ctactecatas">Providencia de Citación:</label>
                <input   value="{{Helper::fecha_f(! isset($ficha2) ? '' : $ficha2-> PROVI_CITA)}}" name="PROVI_CITA"   type="date"    id="ctactecatas" class="form-control form-control-sm   ">
            </div>
  </div>
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
     
  <div class="form-group">
                <label for="ctactecatas">Notificación:</label>
                <input   value="{{Helper::fecha_f(! isset($ficha2) ? '' : $ficha2-> NOTIFI_2)}}" name="NOTIFI_2"   type="date"    id="ctactecatas" class="form-control form-control-sm   ">
            </div>
  </div>
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
  <div class="form-group">
                <label for="ctactecatas">Adjunto S.D.:</label>
                <input   value="{{! isset($ficha2) ? '' : $ficha2-> ADJ_SD}}" name="ADJ_SD" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
  </div>
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
  <div class="form-group">
                <label for="ctactecatas">S.D.:</label>
                <input   value="{{Helper::number_f(! isset($ficha2) ? '' : $ficha2-> SD_NRO)}}" name="SD_NRO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
  </div>
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
  <div class="form-group">
                <label for="ctactecatas">Fecha:</label>
                <input    value="{{Helper::fecha_f(! isset($ficha2) ? '' : $ficha2-> SD_FECHA)}}" 	     type="date"     name="SD_FECHA"   id="ctactecatas" class="form-control form-control-sm   ">
              </div>
  </div>
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
  <div class="form-group">
                <label for="ctactecatas">Notificación:</label>
                <input   value="{{Helper::fecha_f(! isset($ficha2) ? '' : $ficha2-> NOTIFI_3)}}" name="NOTIFI_3"   type="date"    id="ctactecatas" class="form-control form-control-sm   ">
            </div>
  </div>
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
  <div class="form-group">
                <label for="ctactecatas">Adjunto liquidación:</label>
                <input   value="{{Helper::fecha_f(! isset($ficha2) ? '' : $ficha2-> ADJ_LIQUI)}}" name="ADJ_LIQUI"   type="date"    id="ctactecatas" class="form-control form-control-sm   ">
            </div>
  </div>
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
  <div class="form-group">
                  <label for="ctactecatas">Liquidación:</label>
                  <input   oninput="formatear(event)"  value="{{Helper::number_f(! isset($ficha2) ? '' : $ficha2-> LIQUIDACIO)}}" name="LIQUIDACIO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
  </div>
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
  <div class="form-group">
                  <label for="ctactecatas">Providencia:</label>
                  <input   value="{{! isset($ficha2) ? '' : $ficha2-> PROVI_2}}" name="PROVI_2" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
  </div>
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
  <div class="form-group">
                  <label for="ctactecatas">Notifica:</label>
                  <input   value="{{Helper::fecha_f(! isset($ficha2) ? '' : $ficha2-> NOTIFI_4)}}" name="NOTIFI_4"   type="date"    id="ctactecatas" class="form-control form-control-sm   ">
              </div>
  </div>
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
          <label for="ctactecatas">Adjunto aprobación:</label>
          <input  oninput="formatear(event)"  value="{{! isset($ficha2) ? '' : $ficha2-> ADJ_APROBA}}" name="ADJ_APROBA" type="text" id="ctactecatas" class="form-control form-control-sm   ">
    </div>
  </div>
  <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
        <label for="ctactecatas">Aprobación A.I:</label>
        <input    value="{{Helper::number_f(! isset($ficha2) ? '' : $ficha2-> APROBA_AI)}}" name="APROBA_AI" type="text" id="ctactecatas" class="form-control form-control-sm  number-format ">
    </div> 
   </div>
   <div class="col-12 col-sm-5 col-md-4 col-lg-3">
      <div class="form-group">
            <label for="ctactecatas">Fecha aprob. AI:</label>
            <input   value="{{Helper::fecha_f(! isset($ficha2) ? '' : $ficha2-> APRO_FECHA)}}" 	   type="date"     name="APRO_FECHA"   id="ctactecatas" class="form-control form-control-sm   ">
        </div>
   </div>
   <div class="col-12 col-sm-5 col-md-4 col-lg-3">
   <div class="form-group">
              <label for="ctactecatas">Importe aprobado AI:</label>
              <input  oninput="formatear(event)"  value="{{Helper::number_f(! isset($ficha2) ? '' : $ficha2-> APROB_IMPO)}}" name="APROB_IMPO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
   </div>
   <div class="col-12 col-sm-5 col-md-4 col-lg-3">
   <div class="form-group">
              <label for="ctactecatas">Saldo:</label>
              <input   oninput="formatear(event)"  value="{{Helper::number_f(! isset($ficha2) ? '' : $ficha2-> SALDO_EXT)}}" name="SALDO_EXT" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
   </div>
   <div class="col-12 col-sm-5 col-md-4 col-lg-3">
   <div class="form-group">
              <label for="ctactecatas">Adj.Oficio:</label>
              <input   value="{{! isset($ficha2) ? '' : $ficha2-> ADJ_OFICIO}}" name="ADJ_OFICIO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
   </div>
   <div class="col-12 col-sm-5 col-md-4 col-lg-3">
      <div class="form-group">
                  <label for="ctactecatas">Notifica:</label>
                  <input   value="{{Helper::fecha_f(! isset($ficha2) ? '' : $ficha2-> NOTIFI_5)}}" name="NOTIFI_5"   type="date"    id="ctactecatas" class="form-control form-control-sm   ">
          </div>
   </div>
   <div class="col-12 col-sm-5 col-md-4 col-lg-3">
   <div class="form-group">
              <label for="ctactecatas">Embargo N°:</label>
              <input   oninput="formatear(event)" value="{{Helper::number_f(! isset($ficha2) ? '' : $ficha2-> EMBARGO_N)}}" name="EMBARGO_N" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
   </div>
   <div class="col-12 col-sm-5 col-md-4 col-lg-3">
   <div class="form-group">
              <label for="ctactecatas">Fecha:</label>
              <input   value="{{Helper::fecha_f(! isset($ficha2) ? '' : $ficha2-> EMB_FECHA)}}" 	     type="date"     name="EMB_FECHA"   id="ctactecatas" class="form-control form-control-sm   ">
          </div>
   </div>
   <div class="col-12 col-sm-5 col-md-4 col-lg-3">
   <div class="form-group">
              <label for="ctactecatas">Monto:</label>
              <input   oninput="formatear(event)"  value="{{Helper::number_f(! isset($ficha2) ? '' : $ficha2-> EMBAR_EJEC)}}" name="EMBAR_EJEC" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
   </div>
   <div class="col-12 col-sm-5 col-md-4 col-lg-3">
   <div class="form-group">
                    <label for="ctactecatas">Otra Institución:</label>
                    <input   value="{{! isset($ficha2) ? '' : $ficha2-> OTRA_INSTI}}" name="OTRA_INSTI" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
   </div>
   <div class="col-12 col-sm-5 col-md-4 col-lg-3">
   <div class="form-group">
                  <label for="SD_FINIQUI">SD Finiquito:</label>
                  <input    value="{{! isset($ficha2) ? '' : $ficha2-> SD_FINIQUI}}" name="SD_FINIQUI" type="text" id="ctactecatas" class="form-control form-control-sm   "> 
                </div>
   </div>
   <div class="col-12 col-sm-5 col-md-4 col-lg-3">
   <div class="form-group">
                    <label for="ctactecatas">Fecha:</label>
                    <input   value="{{Helper::fecha_f(! isset($ficha2) ? '' : $ficha2-> FEC_FINIQU)}}" name="FEC_FINIQU"   type="date"    id="ctactecatas" class="form-control form-control-sm   ">
                </div>
   </div>

             
 
</div><!--end master row -->

 

  
 

 
<div class="row" style="background-color: #bcfda6;">
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
            <label for="ctactecatas">Inhibición:</label>
            <input   oninput="formatear(event)"   value="{{Helper::number_f(! isset($ficha2) ? '' : $ficha2-> INIVISION)}}" name="INIVISION" type="text" id="ctactecatas" class="form-control form-control-sm   ">
          </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
            <label for="ctactecatas">Fecha:</label>
            <input   value="{{Helper::fecha_f(! isset($ficha2) ? '' : $ficha2-> FEC_INIVI)}}"     type="date"     name="FEC_INIVI"   id="ctactecatas" class="form-control form-control-sm   ">
          </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
          <label for="ctactecatas">Arreglo Ex.J:</label>
          <input    value="{{! isset($ficha2) ? '' : $ficha2-> ARREGLO_EX}}" name="ARREGLO_EX" type="text" id="ctactecatas" class="form-control form-control-sm   ">
        </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
              <label for="ctactecatas">Levantamiento N° i=S:</label>
              <input  oninput="formatear(event)"  value="{{Helper::number_f(! isset($ficha2) ? '' : $ficha2-> LEVANTA)}}" name="LEVANTA" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div> 
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
              <label for="ctactecatas">Fecha:</label> 
              <input   value="{{Helper::fecha_f(! isset($ficha2) ? '' : $ficha2-> FEC_LEVANT)}}" 	     type="date"     name="FEC_LEVANT"   id="ctactecatas" class="form-control form-control-sm   ">
            </div> 
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
              <label for="ctactecatas">Depósito:</label>
              <input   oninput="formatear(event)"  value="{{Helper::number_f(! isset($ficha2) ? '' : $ficha2-> DEPOSITADO)}}" name="DEPOSITADO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
              <label for="ctactecatas">Extracción. C.:</label>
              <input  oninput="formatear(event)"   value="{{Helper::number_f(! isset($ficha2) ? '' : $ficha2-> EXTRAIDO_C)}}" name="EXTRAIDO_C" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
              <label for="ctactecatas">Extracción. L.:</label>
              <input  oninput="formatear(event)"   value="{{Helper::number_f(! isset($ficha2) ? '' : $ficha2-> EXTRAIDO_L)}}" name="EXTRAIDO_L" type="text" id="ctactecatas" class="form-control form-control-sm   ">
            </div>  
    </div>
 
    <div class="col-12 col-sm-5 col-md-4 col-lg-3"> 
        
          
            <div class="form-check">
              <input  onclick="sele_desele(this)" <?=! isset($ficha2) ? '' : ($ficha2->EXCEPCION=='s'?"checked":"")?> class="form-check-input"   type="checkbox"  id="EXCEPCION">
              <input type="hidden" name="EXCEPCION"  value="<?=! isset($ficha2) ? '' : $ficha2->EXCEPCION?>">
              <label class="form-check-label" for="defaultCheck1">
                Excepción
              </label>
            </div>
            <div class="form-check">
              <input onclick="sele_desele(this)"   <?= ! isset($ficha2) ? '' : ($ficha2->APELACION=='s'?"checked":"")?> class="form-check-input" type="checkbox"   id="APELACION">
              <input type="hidden" name="APELACION"  value="<?=! isset($ficha2) ? '' : $ficha2->APELACION?>">
              <label class="form-check-label" for="defaultCheck2">
                Apelación
              </label>
            </div>
            <div class="form-check">
              <input onclick="sele_desele(this)"  <?= ! isset($ficha2) ? '' : ($ficha2-> INCIDENTE=='s'?"checked":"")?> class="form-check-input"  type="checkbox" id="INCIDENTE">
              <input type="hidden" name="INCIDENTE"  value="<?=! isset($ficha2) ? '' : $ficha2->INCIDENTE?>">
              <label class="form-check-label" for="defaultCheck3">
                Incidente
              </label>
            </div>  
          
      </div>
      
  
  </div><!--end second row-->
 


 
 
  </form>
<script>
  var operacSt= document.getElementById("operacion").value;
if(  operacSt =="A" || operacSt == "A+")
habilitarCampos('formNoti',false);

if(operacSt =="M")
habilitarCampos("formNoti", true);
 
 if( operacSt =="V")
 habilitarCampos("formNoti", false);


  function sele_desele( target){
    let input= target.id;
    if( target.checked){
      document.querySelector("input[name="+input+"]").value= "s";
    }else{
      document.querySelector("input[name="+input+"]").value= "n";
    } 
  }



</script>