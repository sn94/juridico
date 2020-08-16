<?php

use Illuminate\Support\Facades\URL;
use App\Helpers\Helper;

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
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
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
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
             <label for="actuaria">Demandante:</label>
             <select name="DEMANDANTE" class="form-control form-control-sm">
                    <?php 

                     $demandanTE=  !isset($ficha)? '' : $ficha->DEMANDANTE;
                    foreach($demandantes as $it): 
                         if( $demandanTE == $it->DESCR || $demandanTE == $it->IDNRO)//Ojo
                           echo "<option selected value='{$it->IDNRO}'>{$it->DESCR}</option>"; 
                         else{
                              echo "<option value='{$it->IDNRO}'>{$it->DESCR}</option>";      
                         }
                         
                    endforeach;  ?>
             </select>
              
         </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
             <label for="actuaria">Cod_emp:</label>
              <input  name="COD_EMP"  type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->COD_EMP}}">
         </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
             <label for="actuaria">Actuaria:</label>
             <select name="ACTUARIA" class="form-control form-control-sm">
                    <?php 

                     $actuariAS=  !isset($ficha)? '' : $ficha->ACTUARIA;
                    foreach($actuarias as $it): 
                         if( $actuariAS == $it->DESCR || $actuariAS == $it->IDNRO)//Ojo
                           echo "<option selected value='{$it->IDNRO}'>{$it->DESCR}</option>"; 
                         else{
                              echo "<option value='{$it->IDNRO}'>{$it->DESCR}</option>";      
                         }
                         
                    endforeach;  ?>
             </select> 
         </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
             <label for="actuaria">Juez:</label>
             <select name="JUEZ" class="form-control form-control-sm">
                    <?php 

                     $jueCES=  !isset($ficha)? '' : $ficha->JUEZ;
                    foreach($jueces as $it): 
                         if( $jueCES == $it->DESCR || $jueCES == $it->IDNRO)//Ojo
                           echo "<option selected value='{$it->IDNRO}'>{$it->DESCR}</option>"; 
                         else{
                              echo "<option value='{$it->IDNRO}'>{$it->DESCR}</option>";      
                         }
                         
                    endforeach;  ?>
             </select>  
         </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
                 <label for="actuaria">Demanda:</label>
                 <input name="DEMANDA"   oninput="formatear(event)"  type="text"   class="form-control form-control-sm" value="{{Helper::number_f( !isset($ficha)? '' : $ficha->DEMANDA)}}">
                 </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
             <label for="actuaria">Saldo:</label>
              <input name="SALDO" oninput="formatear(event)"   type="text"   class="form-control form-control-sm" value="{{Helper::number_f( !isset($ficha)? '' : $ficha->SALDO)}}">
             </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
             <label for="actuaria">Nro.Embargo:</label>
              <input  name="EMBARGO_NR"  type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->EMBARGO_NR}}">
         </div> 
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
             <label for="actuaria">Fecha de embargo:</label>
              <input  name="FEC_EMBARG"    type="date"      class="form-control form-control-sm" value="{{Helper::fecha_f( !isset($ficha)? '' : $ficha->FEC_EMBARG)}}">
         </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
                 <label for="actuaria">Institución:</label>
                 <select name="INSTITUCIO" class="form-control form-control-sm">
                    <?php 

                     $instituc=  !isset($ficha)? '' : $ficha->INSTITUCIO;
                    foreach($instituciones as $it): 
                         if( $instituc == $it->DESCR || $instituc == $it->IDNRO)//Ojo
                           echo "<option selected value='{$it->IDNRO}'>{$it->DESCR}</option>"; 
                         else{
                              echo "<option value='{$it->IDNRO}'>{$it->DESCR}</option>";      
                         }
                         
                    endforeach;  ?>
             </select>   
             </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
                 <label for="actuaria">Tipo:</label>
                 <select name="INST_TIPO" class="form-control form-control-sm">
                    <?php 

                     $instiPO=  !isset($ficha)? '' : $ficha->INST_TIPO;
                    foreach($instipos as $it): 
                         if( $instiPO == $it->DESCR || $instiPO == $it->IDNRO)//Ojo
                           echo "<option selected value='{$it->IDNRO}'>{$it->DESCR}</option>"; 
                         else{
                              echo "<option value='{$it->IDNRO}'>{$it->DESCR}</option>";      
                         }
                         
                    endforeach;  ?>
             </select>   
         </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
                 <label for="actuaria">Juzgado:</label>
                 <select name="JUZGADO" class="form-control form-control-sm">
                    <?php 

                     $JUZ=  !isset($ficha)? '' : $ficha->JUZGADO;
                    foreach($juzgados as $it): 
                         if( $JUZ == $it->DESCR || $JUZ == $it->IDNRO)//Ojo
                           echo "<option selected value='{$it->IDNRO}'>{$it->DESCR}</option>"; 
                         else{
                              echo "<option value='{$it->IDNRO}'>{$it->DESCR}</option>";      
                         }
                         
                    endforeach;  ?>
             </select>   
         </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
                 <label for="actuaria">Domic.denunciado:</label>
                  <input name="DOC_DENUNC"   type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->DOC_DENUNC}}">
             </div> 
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
                 <label for="actuaria">Localidad:</label>
                 <select name="LOCALIDAD" class="form-control form-control-sm">
                    <?php 

                     $loc=  !isset($ficha)? '' : $ficha->LOCALIDAD;
                    foreach($localidades as $it): 
                         if( $loc == $it->DESCR || $loc == $it->IDNRO)//Ojo
                           echo "<option selected value='{$it->IDNRO}'>{$it->DESCR}</option>"; 
                         else{
                              echo "<option value='{$it->IDNRO}'>{$it->DESCR}</option>";      
                         }
                         
                    endforeach;  ?>
             </select> 
         </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
             <label for="actuaria">Localidad del Gte.:</label>
             <select name="LOCALIDA_G" class="form-control form-control-sm">
                    <?php 

                     $loc=  !isset($ficha)? '' : $ficha->LOCALIDA_G;
                    foreach($localidades as $it): 
                         if( $loc == $it->DESCR || $loc == $it->IDNRO)//Ojo
                           echo "<option selected value='{$it->IDNRO}'>{$it->DESCR}</option>"; 
                         else{
                              echo "<option value='{$it->IDNRO}'>{$it->DESCR}</option>";      
                         }
                         
                    endforeach;  ?>
             </select>  
         </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
                 <label for="actuaria">Dom.denun.Gte:</label>
                  <input  name="DOC_DEN_GA"  type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->DOC_DEN_GA}}">
         </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
             <label for="actuaria">Nro. Finca:</label>
              <input name="FINCA_NRO"   type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->FINCA_NRO}}">
         </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
             <label for="actuaria">Cta.Cte:</label>
              <input  name="CTA_BANCO"  type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->CTA_BANCO}}">
         </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">  
    <div class="form-group">
             <label for="actuaria">Banco:</label>
             <select name="BANCO" class="form-control form-control-sm">
                    <?php 

                     $loc=  !isset($ficha)? '' : $ficha->BANCO;
                    foreach($bancos as $it): 
                         if( $loc == $it->DESCR || $loc == $it->IDNRO)//Ojo
                           echo "<option selected value='{$it->IDNRO}'>{$it->DESCR}</option>"; 
                         else{
                              echo "<option value='{$it->IDNRO}'>{$it->DESCR}</option>";      
                         }
                         
                    endforeach;  ?>
             </select> 
         </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    <div class="form-group">
             <label for="actuaria">Cta.Catastral:</label>
              <input  name="CTA_CATAST"  type="text"   class="form-control form-control-sm" value="{{ !isset($ficha)? '' : $ficha->CTA_CATAST}}">
         </div>
    </div>
    <div class="col-12 col-sm-5 col-md-4 col-lg-3">
    </div>
     
 </div><!-- end row -->
   
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
  

  

 