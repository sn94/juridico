<?php

use Illuminate\Support\Facades\URL;

$rutaEspecial="";
if( $OPERACION == "A+")  $rutaEspecial = url("demandas-agregar");
if( $OPERACION == "A" || $OPERACION == "M") $rutaEspecial=  url("demandas-editar") ;

?>
<form  onsubmit="enviar(event)" id="formDeman" class="tab-content" method="post" action="<?=  $rutaEspecial ?>">
 
{{csrf_field()}}
 
<?php if( $OPERACION != "V"): ?>
    <button type="submit" class="btn btn-success btn-sm" >Guardar</button>

<?php endif; ?>

 <input id="CI1" type="hidden" name="CI"  value="{{isset($ci)?$ci:''}}">
 <?php if( $OPERACION != "A+"): ?>
    <input  id="IDNRO0"  type="hidden" name="IDNRO"  value="{{isset($ficha)?$ficha->IDNRO:''}}">
 <?php endif; ?>

 <div class="row">
   
   <div class="col-l2 col-md-3">
         <div class="form-group">
             <label for="actuaria">Origen:</label>
             <select class="form-control form-control-sm" name="O_DEMANDA" id="">
                 <?php
                 $ori=  !isset($ficha)? '' : $ficha->O_DEMANDA;
                 foreach($origen as $it): 
                    if( $ori == $it->CODIGO)  echo "<option selected value='{$it->CODIGO}'>{$it->NOMBRES}</option>"; 
                    else  echo "<option value='{$it->CODIGO}'>{$it->NOMBRES}</option>"; 
                 endforeach;
                 ?>
             </select> 
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
                 <input name="DEMANDA"   oninput="formatear(event)"  type="text"   class="form-control form-control-sm" value="{{number_f( !isset($ficha)? '' : $ficha->DEMANDA)}}">
                 </div>
             </div>
             <div class="col-12 col-md-6">
             <div class="form-group">
             <label for="actuaria">Saldo:</label>
              <input name="SALDO" oninput="formatear(event)"   type="text"   class="form-control form-control-sm" value="{{number_f( !isset($ficha)? '' : $ficha->SALDO)}}">
             </div>
             </div>
         </div>
      
         <div class="form-group">
             <label for="actuaria">Nro.Embargo:</label>
              <input  name="EMBARGO_NR"  type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->EMBARGO_NR}}">
         </div> 
         <div class="form-group">
             <label for="actuaria">Fecha de embargo:</label>
              <input  name="FEC_EMBARG"    type="date"      class="form-control form-control-sm" value="{{fecha_f( !isset($ficha)? '' : $ficha->FEC_EMBARG)}}">
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
<script>
    var Operstr= document.getElementById("operacion").value;
if( Operstr =="A")
 habilitarCampos('formDeman',false);
 
if(Operstr =="A+"  || Operstr =="M")
habilitarCampos('formDeman', true);
  //Los datos personales ya estan en BD en este caso, habilitar solo campos de Demanda CASO 1
           //Edicion, todas las instancias ya existen en la Bd CASO2
     
if(Operstr =="V"  )
habilitarCampos('formDeman', false);
 </script>
  

  

 