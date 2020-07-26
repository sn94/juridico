

<?php
 
$id_demanda= isset( $id_demanda)?$id_demanda:"";
$ruta= $OPERACION == "A" ? url("demandas-agregar"): url("demandas-editar") ;

?>

<form onsubmit="enviar(event)" id="formDeman" class="tab-content" method="post" action="<?= $ruta?>">
 
{{csrf_field()}}
 

 <button type="submit" class="btn btn-success btn-sm" >Guardar</button>
 
<?php if( $OPERACION == "M"): ?>
 <input   type="hidden" name="IDNRO"  value="{{isset($ficha)?$ficha->IDNRO:''}}">
 <?php endif; ?>
 <input id="CI1" type="hidden" name="CI"  value="{{isset($ci)?$ci:''}}">
 
 <div class="row">
   
   <div class="col-l2 col-md-3">
         <div class="form-group">
             <label for="actuaria">Origen:</label>
              <input  name="O_DEMANDA"  type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->O_DEMANDA}}">
         </div>
         <div class="form-group">
             <label for="actuaria">Demandante:</label>
              <input name="DEMANDANTE"   type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->DEMANDANTE}}">
         </div>
         <div class="form-group">
             <label for="actuaria">Cod_emp:</label>
              <input  name="COD_EMP"  type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->COD_EMP}}">
         </div>
         <div class="form-group">
             <label for="actuaria">Actuaria:</label>
              <input  name="ACTUARIA"  type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->ACTUARIA}}">
         </div>
         <div class="form-group">
             <label for="actuaria">Juez:</label>
              <input   name="JUEZ" type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->JUEZ}}">
         </div>
        
     </div>
     
     <div class="col-12 col-md-3">
         <div class="row">
             <div class="col-12 col-md-6">
                 <div class="form-group">
                 <label for="actuaria">Demanda:</label>
                 <input name="DEMANDA"   oninput="formatear(this)"  type="text"   class="form-control form-control-sm" value="{{number_f( !isset($ficha)? '' : $ficha->DEMANDA)}}">
                 </div>
             </div>
             <div class="col-12 col-md-6">
             <div class="form-group">
             <label for="actuaria">Saldo:</label>
              <input name="SALDO" oninput="formatear(this)"   type="text"   class="form-control form-control-sm" value="{{number_f( !isset($ficha)? '' : $ficha->SALDO)}}">
             </div>
             </div>
         </div>
      
         <div class="form-group">
             <label for="actuaria">Nro.Embargo:</label>
              <input  name="EMBARGO_NR"  type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->EMBARGO_NR}}">
         </div> 
         <div class="form-group">
             <label for="actuaria">Fecha de embargo:</label>
              <input  name="FEC_EMBARG"  type="date"   class="form-control form-control-sm" value="{{fecha_f( !isset($ficha)? '' : $ficha->FEC_EMBARG)}}">
         </div>
         <div class="form-group">
                 <label for="actuaria">Institución:</label>
                  <input  name="INSTITUCIO"  type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->INSTITUCIO}}">
             </div>
         <div class="form-group">
                 <label for="actuaria">Tipo:</label>
                  <input name="INST_TIPO"   type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->INST_TIPO}}">
         </div>
         
     </div>
      
     <div class="col-12 col-md-3">
     <div class="form-group">
                 <label for="actuaria">Juzgado:</label>
                  <input  name="JUZGADO"  type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->JUZGADO}}">
         </div>
         <div class="form-group">
                 <label for="actuaria">Domic.denunciado:</label>
                  <input name="DOC_DENUNC"   type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->DOC_DENUNC}}">
             </div> 
         <div class="form-group">
                 <label for="actuaria">Localidad:</label>
                 <input name="LOCALIDAD"   type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->LOCALIDAD}}">
         </div>
         <div class="form-group">
             <label for="actuaria">Localidad del Gte.:</label>
             <input   name="LOCALIDA_G" type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->LOCALIDA_G}}">
         </div>
         <div class="form-group">
                 <label for="actuaria">Dom.denun.Gte:</label>
                  <input  name="DOC_DEN_GA"  type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->DOC_DEN_GA}}">
         </div>
       
     </div>
 
     <div class="col-12 col-md-3">
        <div class="form-group">
             <label for="actuaria">Nro. Finca:</label>
              <input name="FINCA_NRO"   type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->FINCA_NRO}}">
         </div>
         <div class="form-group">
             <label for="actuaria">Cta.Cte:</label>
              <input  name="CTA_BANCO"  type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->CTA_BANCO}}">
         </div>
         <div class="form-group">
             <label for="actuaria">Banco:</label>
              <input   name="BANCO" type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->BANCO}}">
         </div>
         <div class="form-group">
             <label for="actuaria">Cta.Catastral:</label>
              <input  name="CTA_CATAST"  type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->CTA_CATAST}}">
         </div>
     </div>
 </div>
   
</form>

  

  

 