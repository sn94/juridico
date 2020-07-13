@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">DEMANDAS</li> 
<li class="breadcrumb-item active" aria-current="page">AGREGAR</li> 
@endsection

@section('content')


<div class="btn-group" role="group" aria-label="Basic example"> 
  <button type="button" class="btn btn-secondary" onclick="enviar(event)">Guardar</button>
</div>

 
<div class="nav-tabs-responsive">
  <ul class="nav nav-tabs-progress nav-tabs-4 mb-4">
    <li class="nav-item">
      <a href="#account" class="nav-link active" data-toggle="tab">
        <span class="font-lg">1.</span>Titular & Garante
      </a>
    </li>
    
    <li class="nav-item">
      <a href="#payment" class="nav-link" data-toggle="tab">
        <span class="font-lg">3.</span> Demanda & embargo 
      </a>
    </li>
    
    <li class="nav-item">
      <a href="#seguimiento" class="nav-link" data-toggle="tab">
        <span class="font-lg">4.</span> Seguimiento
      </a>
    </li>
    <li class="nav-item">
      <a href="#observacion" class="nav-link" data-toggle="tab">
        <span class="font-lg">5.</span> Observación
      </a>
    </li>

  </ul>
  <div id="showSpinner">

  </div>
  <form id="formDeman" class="tab-content" method="post" action="<?=url("demandas-agregar")?>">

  {{csrf_field()}}
    <div id="account" class="tab-pane show active">
      <div class="mb-3">
        <a href="#account-collapse" data-toggle="collapse">
          <span class="font-lg">1.</span> Titular & Garante
        </a>
      </div>
      <div id="account-collapse" class="collapse show" data-parent="#formOrder">
         
            <div class="row">

              <div class="col-12 col-md-6">
                    <div class="row">
                      <div class="col-12 col-md-6">
                          <div class="form-group">
                            <label for="titular">Titular:</label>
                            <input name="TITULAR" type="text" id="titular" class="form-control form-control-sm   ">
                          </div>
                          <div class="form-group">
                            <label for="ci">CI:</label>
                            <input name="CI" type="text" id="ci" class="form-control form-control-sm   ">
                          </div>
                          <div class="form-group">
                            <label for="direccion">Direccion:</label>
                            <input name="DOMICILIO" type="text" id="direccion" class="form-control form-control-sm   ">
                          </div>
                          <div class="form-group">
                            <label for="telefono">Telefono:</label>
                            <input  name="TELEFONO" type="text" id="telefono" class="form-control form-control-sm   ">
                          </div>
                      </div>
                      <div class="col-12 col-md-6">
                          
                          <div class="form-group">
                            <label for="celular">Celular</label>
                            <input name="CELULAR" type="text" id="celular" class="form-control form-control-sm   ">
                          </div>
                          <div class="form-group">
                            <label for="laboral">Direccion laboral:</label>
                            <input name="LABORAL" type="text" id="laboral" class="form-control form-control-sm   ">
                          </div>
                          <div class="form-group">
                          <label for="tel_trabaj">Telefono laboral:</label>
                          <input name="TEL_TRABAJ" type="text" id="tel_trabaj" class="form-control form-control-sm   ">
                          </div>
                      </div>
                      
                    </div>
              </div>
              <div class="col-12 col-md-6">
                  <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                          <label for="garante">Garante:</label>
                          <input name="GARANTE" type="text" id="garante" class="form-control form-control-sm   ">
                        </div>
                        <div class="form-group">
                          <label for="cigarante">CI Garante:</label>
                          <input name="CI_GARANTE" type="text" id="cigarante" class="form-control form-control-sm   ">
                        </div>
                        <div class="form-group">
                          <label for="dgarante">Direccion Garante:</label>
                          <input name="DOM_GARANT" type="text" id="dgarante" class="form-control form-control-sm   ">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                    
                        <div class="form-group">
                          <label for="tgarante">Telefono Garante:</label>
                          <input name="TEL_GARANT" type="text" id="tgarante" class="form-control form-control-sm   ">
                        </div>
                        <div class="form-group">
                          <label for="tlabogarante">Tel.Lab.Garante:</label>
                          <input name="TEL_LAB_G" type="text" id="tlabogarante" class="form-control form-control-sm   ">
                        </div>
                        <div class="form-group">
                          <label for="dlabogarante">Dir.Lab.Garante:</label>
                          <input name="LABORAL_G" type="text" id="dlabogarante" class="form-control form-control-sm   ">
                        </div>
                    </div>
                   
                  </div>
              </div>
            </div>
       
         
       
      </div>
    </div>
   
    <div id="payment" class="tab-pane">
      <div class="mb-3">
        <a href="#payment-collapse" data-toggle="collapse">
          <span class="font-lg">3.</span> Demanda & Embargo 
        </a>
      </div>
      <div id="payment-collapse" class="collapse" data-parent="#formOrder">


        <div class="row">
          <div class="col-12 col-md-3">
              <div class="form-group">
                <label for="origen">Origen:</label>
                <input name="O_DEMANDA" type="text" id="origen" class="form-control form-control-sm   ">
              </div>
                <div class="form-group">
                  <label for="demandante">Demandante:</label>
                  <input name="DEMANDANTE" type="text" id="demandante" class="form-control form-control-sm   ">
                </div>
                
                <div class="form-group">
                  <label for="codemp">Cod. Emp.:</label>
                  <input name="COD_EMP" type="text" id="codemp" class="form-control form-control-sm   ">
                </div>
                <div class="form-group">
                  <label for="actuaria">Actuaria:</label>
                  <input name="ACTUARIA" type="text" id="actuaria" class="form-control form-control-sm   ">
                </div>
                <div class="form-group">
                  <label for="juez">Juez:</label>
                  <input name="JUEZ" type="text" id="juez" class="form-control form-control-sm   ">
                </div>
          </div>
          <div class="col-12 col-md-3">
                <div class="form-group">
                  <label for="deman">Demanda:</label>
                  <input name="DEMANDA" type="text" id="deman" class="form-control form-control-sm " value="0">
                </div>
                <div class="form-group">
                  <label for="saldo">Saldo:</label>
                  <input name="SALDO" type="text" id="saldo" class="form-control form-control-sm " value="0">
                </div>
                <div class="form-group">
                  <label for="nroemb">Nro.de Embargo:</label>
                  <input name="EMBARGO_NR" type="text" id="nroemb" class="form-control form-control-sm   ">
                </div>
                <div class="form-group">
                  <label for="fechaemb">Fecha de embargo:</label>
                  <input name="FEC_EMBARG" type="text" id="fechaemb" class="form-control form-control-sm   ">
                </div>
                <div class="form-group">
                  <label for="institu">Institucion:</label>
                  <input name="INSTITUCIO" type="text" id="institu" class="form-control form-control-sm   ">
                </div>
          </div>
          <div class="col-12 col-md-3">
            
                <div class="form-group">
                  <label for="juzgado">Juzgado:</label>
                  <input name="JUZGADO" type="text" id="juzgado" class="form-control form-control-sm   ">
                </div>
                <div class="form-group">
                  <label for="domdenunciado">Domic. denunciado:</label>
                  <input name="DOC_DENUNC" type="text" id="domdenunciado" class="form-control form-control-sm   ">
                </div>
                <div class="form-group">
                  <label for="localdenun">Localidad de denunciado:</label>
                  <input name="LOCALIDAD" type="text" id="localdenun" class="form-control form-control-sm   ">
                </div>
                <div class="form-group">
                  <label for="localgarante">Localidad del gte.:</label>
                  <input name="LOCALIDA_G" type="text" id="localgarante" class="form-control form-control-sm   ">
                </div>
                <div class="form-group">
                  <label for="domdenungte">Dom.Denun.Gte:</label>
                  <input name="DOC_DEN_GA" type="text" id="domdenungte" class="form-control form-control-sm   ">
                </div>
          </div>
          <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label for="nrofinca">Nro.de finca:</label>
                    <input name="FINCA_NRO" type="text" id="nrofinca" class="form-control form-control-sm   ">
                  </div>
                  <div class="form-group">
                    <label for="ctacte">Cta. Cte:</label>
                    <input name="CTA_BANCO" type="text" id="ctacte" class="form-control form-control-sm   ">
                  </div>
                  <div class="form-group">
                    <label for="domdenungte">Banco:</label>
                    <input name="BANCO" type="text" id="domdenungte" class="form-control form-control-sm   ">
                  </div>
                  <div class="form-group">
                    <label for="ctactecatas">Cta.Cte.Catastral:</label>
                    <input name="CTA_CATAST" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                  </div>
          </div>
        </div>
      </div>
    </div> 
    <div id="seguimiento" class="tab-pane">
      <div class="mb-3">
        <a href="#seguimiento-collapse" data-toggle="collapse">
          <span class="font-lg">3.</span>Seguimiento
          
        </a>
      </div>
      <div id="seguimiento-collapse" class="collapse" data-parent="#formOrder">

          <div class="row"> 
                  
                      <div class="col-12 col-md-2">
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
                      <div class="form-group">
                          <label for="ctactecatas">A.I. Nro.:</label>
                          <input name="AI_NRO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                      </div> 
                      </div> <!-- END COL 1-->

                      <div class="col-12 col-md-2">
                      <div class="form-group">
                          <label for="ctactecatas">A.I. Fecha:</label>
                          <input name="AI_FECHA" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                      </div>
                      <div class="form-group">
                          <label for="ctactecatas">Intimación:</label>
                          <input name="INTIMACI_1" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                      </div>
                      <div class="form-group">
                          <label for="ctactecatas">Notificación:</label>
                          <input name="INTIMACI_2" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                      </div>
                      <div class="form-group">
                          <label for="ctactecatas">Citación:</label>
                          <input name="CITACION" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                      </div>
                      <div class="form-group">
                          <label for="ctactecatas">Providencia de Citación:</label>
                          <input name="PROVI_CITA" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                      </div>
                       
                      </div> <!-- END COL2-->

                      <div class="col-12 col-md-2">
                        
                      <div class="form-group">
                          <label for="ctactecatas">Notificación:</label>
                          <input name="NOTIFI_2" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                      </div>
                      <div class="form-group">
                          <label for="ctactecatas">Adjunto S.D.:</label>
                          <input name="ADJ_SD" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                      </div>
                      <div class="form-group">
                          <label for="ctactecatas">S.D.:</label>
                          <input name="SD_NRO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                      </div>
                      <div class="form-group">
                          <label for="ctactecatas">Notificación:</label>
                          <input name="NOTIFI_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                      </div>
                      <div class="form-group">
                          <label for="ctactecatas">Adjunto liquidación:</label>
                          <input name="ADJ_LIQUI" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                      </div>
                    
                      </div><!-- END COL 3-->
                      <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label for="ctactecatas">Liquidación:</label>
                            <input name="LIQUIDACIO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                        </div>
                        <div class="form-group">
                            <label for="ctactecatas">Providencia:</label>
                            <input name="PROVI_2" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                        </div>
                        <div class="form-group">
                            <label for="ctactecatas">Notifica:</label>
                            <input name="NOTIFI_4" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                        </div>
                        <div class="form-group">
                            <label for="ctactecatas">Adjunto aprobación:</label>
                            <input name="ADJ_APROBA" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                        </div>
                        <div class="form-group">
                            <label for="ctactecatas">Aprobación A.I:</label>
                            <input name="APROBA_AI" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                        </div>
                      </div>

                      <div class="col-12 col-md-2">
                          <div class="form-group">
                              <label for="ctactecatas">Fecha aprob. AI:</label>
                              <input name="APRO_FECHA" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                          </div>
                          <div class="form-group">
                              <label for="ctactecatas">Importe aprobado AI:</label>
                              <input name="APROB_IMPO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                          </div>
                          <div class="form-group">
                              <label for="ctactecatas">Saldo:</label>
                              <input name="SALDO_EXT" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                          </div>
                          <div class="form-group">
                              <label for="ctactecatas">Adj.Oficio:</label>
                              <input name="ADJ_OFICIO" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                          </div>
                          <div class="form-group">
                              <label for="ctactecatas">Notifica:</label>
                              <input name="NOTIFI_5" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                          </div>
                         
                      </div>
                      <div class="col-12 col-md-2">
                          <div class="form-group">
                              <label for="ctactecatas">Embargo N°:</label>
                              <input name="EMBARGO_N" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                          </div>
                          <div class="form-group">
                              <label for="ctactecatas">Fecha:</label>
                              <input name="EMB_FECHA" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                          </div>
                          <div class="form-group">
                              <label for="ctactecatas">Monto:</label>
                              <input name="EMBAR_EJEC" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                          </div>
                          <div class="form-group">
                          <label for="SD_FINIQUI">SD Finiquito:</label>
                            <input name="SD_FINIQUI" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                           
                          </div>
                          <div class="form-group">
                              <label for="ctactecatas">Fecha:</label>
                              <input name="FEC_FINIQU" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                          </div>
                          <div class="form-group">
                              <label for="ctactecatas">Otra Institución:</label>
                              <input name="OTRA_INSTI" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                          </div>
                      </div>
 
          </div><!-- -->
          <!----otro panel --->
          <div class="row my-inline-form" style="background-color: #a8f49d;">
                <div class="col-12 col-md-3">
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
                   
                </div>
                <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="ctactecatas">Levantamiento N° i=S:</label>
                    <input name="LEVANTA" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                  </div> 
                      <div class="form-group">
                        <label for="ctactecatas">Fecha:</label>
                        <input name="FEC_LEVANT" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                      </div>  
                      <div class="form-group">
                        <label for="ctactecatas">Excepción:</label>
                        <input name="EXCEPCION" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                      </div>
                    
                </div>
                <div class="col-12 col-md-3">
                  <div class="form-group">
                        <label for="ctactecatas">Apelación:</label>
                        <input name="APELACION" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                      </div>
                      <div class="form-group">
                        <label for="ctactecatas">Incidente:</label>
                        <input name="INCIDENTE" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                      </div>
                              
                </div><!--end col-->
                <div class="col-12 col-md-3">
                  <label for="">Depósito</label><br>
                  <label for="">Extracción. C</label><br>
                  <label for="">Extracción. L</label> 
                                <br>
                                <button class="btn btn-success mb-1">CANCELAR</button>
                                <br>
                                <button onclick="showMenuBanco()" class="btn btn-success" type="button">CTA BANCO</button>
                </div>
          </div>
          <div id="menubanco" >
          
          </div>
         
      </div>
    </div>
    
    <div id="observacion" class="tab-pane">
      <div class="mb-3">
        <a href="#observacion-collapse" data-toggle="collapse">
          <span class="font-lg">3.</span>Observación
        </a>
      </div>
      <div id="observacion-collapse" class="collapse" data-parent="#formOrder">
          <div class="row">
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="ctactecatas">Tercer garante:</label>
                    <input name="GARANTE_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
                </div>
                <div class="form-group">
                  <label for="ctactecatas">Domicilio:</label>
                  <input name="DIR_GAR_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                  <label for="ctactecatas">Cedula:</label>
                  <input name="CI_GAR_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              <div class="form-group">
                  <label for="ctactecatas">Teléfono:</label>
                  <input name="TEL_GAR_3" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                  <label for="ctactecatas">Abogado:</label>
                  <input name="OBS_ABOGAD" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              <div class="form-group">
                  <label for="ctactecatas">Preventivo:</label>
                  <input name="OBS_PREVEN" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
              <div class="form-group">
                  <label for="ctactecatas">Ejecutivo:</label>
                  <input name="OBS_EJECUT" type="text" id="ctactecatas" class="form-control form-control-sm   ">
              </div>
            </div>
          </div> 
       

      </div>
    </div>

  </form>
</div>



  
@endsection



<script>




document.onreadystatechange = () => {
  if (document.readyState === 'complete') {
    // document ready
    $('#demandatable').DataTable();
  }
};


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