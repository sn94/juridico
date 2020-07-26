 

<form onsubmit="enviar(event)" id="formDeman" class="tab-content" method="post" action="<?=url("demandas-agregar/$id_demandado")?>">

{{csrf_field()}}


<input type="hidden" name="CI"  value="{{$ci}}">

 
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
                  <input  oninput="formatear(this)" name="DEMANDA" type="text" id="deman" class="form-control form-control-sm " value="0">
                </div>
                <div class="form-group">
                  <label for="saldo">Saldo:</label>
                  <input  oninput="formatear(this)"  name="SALDO" type="text" id="saldo" class="form-control form-control-sm " value="0">
                </div>
                <div class="form-group">
                  <label for="nroemb">Nro.de Embargo:</label>
                  <input  oninput="formatear(this)"  name="EMBARGO_NR" type="text" id="nroemb" class="form-control form-control-sm   ">
                </div>
                <div class="form-group">
                  <label for="fechaemb">Fecha de embargo:</label>
                  <input  name="FEC_EMBARG" type="date" id="fechaemb" class="form-control form-control-sm   ">
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
                    <input  oninput="formatear(this)"   name="FINCA_NRO" type="text" id="nrofinca" class="form-control form-control-sm   ">
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
                  <button type="submit" class="btn btn-success btn-sm" >GUARDAR</button>

          </div>
        </div>
</form>

  

  

 