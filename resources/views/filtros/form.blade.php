@extends('layouts.app')


@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">FILTROS</li>  
@endsection

@section('content')
 
 
<?php

use App\Mobile_Detect;

$detect= new Mobile_Detect();
if( $detect->isMobile() == false){
  ?>
<style>
  table{
    font-size:16px !important;
  }
</style>

<?php
} 
?>





<style>
   #CONDICIONES input, #CONDICIONES select{
     border:none; 
   }
 </style>
 
  
<input type="hidden" id="OPERACION" value="{{ !isset($OPERACION)?'A': $OPERACION}}">
<?php  
$ruta= $OPERACION =="A" ? url("nfiltro") : url("efiltro");
  ?>

 
<div class="row">

  <div  class="col-12 col-sm-3 col-md-2 col-lg-2">
  <div class="form-group">
  <label for="actuaria">TABLA:</label>
  <select class="form-control form-control-sm"   id="TABLA" onchange="cargar_campos(event)">

    <option value="demandas2">DEMANDAS</option>
    <option value="notificaciones">SEGUIMIENTO</option>
    <option value="cta_judicial">CTA.JUDICIAL</option> 
  </select>
</div>
  </div>

<!-- FORM -->
  <div  class="col-12 col-sm-9 col-md-10 col-lg-8">
    
 
    <form id="filterform" action="<?=$ruta?>" method="POST" onsubmit="ajaxCall(event,'#statusform')">
    {{csrf_field()}}
     <div class="row">
        <div class="col-12 col-sm-6 col-md-9 col-lg-4">
            <div class="form-group">
                <label for="actuaria">NOMBRE FILTRO:</label>
                <?php if( isset($OPERACION) && $OPERACION== "M"): ?>
                  <input type="hidden" name="NRO" value="{{isset($DATO)? $DATO->NRO: '' }}">
                <?php endif; ?>
                <input class="form-control form-control-sm" type="text"  name="NOMBRE" value="{{isset($DATO)? $DATO->NOMBRE: '' }}">
                <input type="hidden" name="FILTRO" value="{{isset($DATO)? $DATO->FILTRO: '' }}">
            </div>
          </div> 
          <div class="col-12 col-sm-6 col-md-3 col-lg-3 d-flex align-items-center">
          <button type="submit" class="btn btn-sm btn-info">GUARDAR</button>
          </div>
     </div>
 
    </form>
  </div>

</div>

<div id="statusform">

</div>

<table id="CONDICIONES" class="table table-striped table-bordered <?= $detect->isMobile()?"":"table-responsive" ?>">
      <thead class="thead-dark "> 
        <th class="pb-0">  CAMPO  </th>
        <th class="pb-0">RELACIÓN</th>
        <th class="pb-0"> VALOR</th>
        <th class="pb-0">LÓGICO</th>  </thead>
      <tbody>
         
     
      </tbody>
</table>


 
 

@endsection 


<script>
var allcampos=
{
  demandas2: [ { back: 'CI', face:'CEDULA'},{ back:'DEMANDANTE',face:"DEMANDANTE"},{ back:'O_DEMANDA',face:'ORIGEN_DEMANDA'},{back:'COD_EMP',face:'COD.EMP.'},
  {back: 'DOC_DENUNC', face: 'DOCUMENTO_DENUNCIANTE'},{ back: 'LOCALIDAD', face:'LOCALIDAD'},
  {back:'DOC_DEN_GA',face:"DOC.DENUNCIANTE_GARANTE"},{back: 'LOCALIDA_G', face:'LOCALIDAD_GARANTE'},
  {back:'JUZGADO', face:'JUZGADO'},{back:'ACTUARIA',face:'ACTUARIA'},{back:'JUEZ',face:'JUEZ'},
 {back: 'FINCA_NRO', face: 'NRO.DE_FINCA'},{back:'CTA_CATAST', face:'CUENTA_CATASTRAL'},{back:'DEMANDA',face:'MONTO_DEMANDA'},
  {back:'INSTITUCIO', face:'INSTITUCION'},{back:'INST_TIPO', face:'TIPO_INSTITUCION'},{back:'CTA_BANCO',face:'CUENTA_BANCO'},
  {back:'BANCO', face:'BANCO' }  ],

  notificaciones: [ { back: 'CI', face:'CEDULA'},{back:'PRESENTADO',face:'PRESENTADO'},{back: 'PROVI_1', face:'PROVIDENCIA_1'},{back:'NOTIFI_1', face:'NOTIFICACION_1'},{ back:'ADJ_AI', face:'ADJ.AUTO.INTERLOCUTORIO'},{back:'AI_NRO', face:'NRO_AUTO_INTERLOCUTORIO'},
  { back:'AI_FECHA', face: 'FECHA_AUTO_INTERLOCUTORIO'},{ back:'INTIMACI_1', face:'INTIMACION_1'},{ back:'INTIMACI_2', face: 'INTIMACION_2'},{back: 'CITACION',face:'CITACION'},{ back:'PROVI_CITA', face:'PROVIDENCIA_CITACION'},{ back: 'NOTIFI_2', face: 'NOTIFICACION_2'},{ back: 'ADJ_SD', face: 'ADJUNTO_S.D'},
  { back: 'SD_NRO', face: 'NRO_SD'},{back:'SD_FECHA', face:'FECHA_SD'},{back:'NOTIFI_3', face:'NOTIFICACION_3'},
  {back:'ADJ_LIQUI',face:'ADJ_LIQUIDACION'},{back:'LIQUIDACIO',face:'LIQUIDACION'},{back:'PROVI_2', face:'PROVIDENCIA_2'},{back: 'NOTIFI_4', face:'NOTIFICACION_4'},{ back:'ADJ_APROBA', face:'ADJ_APROBACION'},{ back:'APROBA_AI', face:'APROBACION_AI'},{back:'APRO_FECHA', face:'APROBACION_FECHA'},{back:'APROB_IMPO',face:'APROBACION_IMPORTE'},
  { back:'SALDO_EXT', face:'SALDO_EXTRAIDO'}, {back:'ADJ_OFICIO', face:'ADJUNTO_OFICIO'},{ back:'NOTIFI_5', face:'NOTIFICACION_5'},{back:'EMBARGO_N', face: 'NRO_EMBARGO'},{ back:'EMB_FECHA', face: 'FECHA_EMBARGO'},{back:'EMBAR_EJEC',face:'EMBARGO_EJECUCION'},{back:'SD_FINIQUI', face:'SD_FINIQUITO'},{ back:'FEC_FINIQU', face:'FECHA_FINIQUITO'},
  { back:'INIVISION', face:'INHIBICION'},{back:'FEC_INIVI', face:'FECHA_INHIBICION'}, { back:'ARREGLO_EX', face:'ARREGLO_EXTRAJUDICIAL'},{back:'LEVANTA',face:'LEVANTAMIENTO'},{ back:'FEC_LEVANT' , face: 'FECHA_LEVANTAMIENTO'},{ back:'DEPOSITADO', face:'DEPOSITADO'},{ back:'EXTRAIDO_C',face:'CAPITAL_EXTRAIDO'},{ back:'EXTRAIDO_L', face:'LIQUIDACION_EXTRAIDO'},
  { back: 'OTRA_INSTI', face:'OTRA_INSTITUCION'}, {back:'EXCEPCION', face:'EXCEPCION'},{ back:'APELACION', face:'APELACION'} ,{back:'INCIDENTE', face: 'INCIDENTE'}  ] ,

  cta_judicial: [{ back:'CTA_JUDICI', face:'CUENTA_JUDICIAL'},{ back:'BANCO', face: 'BANCO'},{ back: 'TIPO_CTA', face: 'TIPO_CUENTA'},{back:'TIPO_MOVI', face:'TIPO_MOVIMIENTO'},
  {back:'FECHA', face: 'FECHA'},{ back:'TIPO_EXT', face:'TIPO_DE_EXTRACCION'},{ back:'IMPORTE', face: 'IMPORTE'},{ back:'CHEQUE_NRO', face: 'NRO_DE_CHEQUE'},{ back:'CI', face:'CEDULA'}   ]
};




function compatibilidad(  ar){

}

//A PARTIR DE UNA CAD SQL EXTRAER TOKENS
function  translate_sql( arg){
  //obtener tabla
   let tablax=arg.split("where")[0].split(" ")[3] ;
   $("#TABLA").val(  tablax );
  let base= arg.split("where")[1];//Obtener solo la condicion
  let  propo1= base.split(/(&&|\|\|)/);//Dividir por operadores logicos OR AND
  let ope_logicos= propo1.filter( function(ar){ return ar=="&&" || ar=="||"; } );
  console.log( ope_logicos);
  let ls_condi=  propo1.filter( function( ar){ 
    let tempo= ar.trim();
    return  (tempo != "")  && (tempo!="&&")  && (tempo !="||");  }  );
    //CREAR LOS CAMPOS DE CARGA
    $("#CONDICIONES tbody").empty();
    ls_condi.forEach( function(condi, indice){

      let operandos= condi.split(/(<>)|(>)|(<)|(=)/).filter(function(ar){ return ar!= undefined; });
      console.log(operandos);
      try{
        condition_creator(operandos[0].trim(), operandos[1], operandos[2].trim(),  ope_logicos[indice]  );
      }catch(err){
        condition_creator(operandos[0].trim(), operandos[1], operandos[2].trim() );
      }
     

      console.log( operandos);
    });
    

}

 

//paso 1 CARGAR CAMPOS DE LA TABLA SELECCIONADA
function cargar_campos(ev){
  if( $("#OPERACION").val()=="M"   ||   ($("#OPERACION").val()=="A"  && ! confirm("ANTES DE CREAR UN NUEVO FILTRO, DEBE GUARDAR EL FILTRO ACTUAL. ¿GUARDAR?"))   ) {
    $("#CONDICIONES tbody").empty();
    condition_creator();
    return;
  }
  let valor= undefined;
  if(  typeof ev == "object" &&  ( "target" in ev) ) valor=  ev.target.value;
  else valor= ev;
  let dt= allcampos[  valor ];
  //CAMBIAR CAMPOS
  $("#CAMPOS").empty();
  dt.forEach( function(ar){  $("#CAMPOS").append("<option value='"+ar.back+"'>"+ar.face+"</option>" ); }  );
} 



/**GENERAR NUEVA SENTENCIA */
function generar_sentencia_sql(){
  let sql=" select * from "+ $("#TABLA").val()+" where ";
  Array.prototype.forEach.call( document.querySelector("#CONDICIONES tbody").children,  function( row){
    let campo= row.children[0].children[0].value;
    let operel=row.children[1].children[0].value;
    let valor= row.children[2].children[0].value;
    let opelog=row.children[3].children[0].value;
    sql=   sql+" "+ campo+operel+valor+" "+opelog+" ";
    console.log( campo+operel+valor+" "+opelog);
  });  return sql;
}

/**PREPARAR CREADOR DE CONDICIONES */
function return_table_fields(ev, defaul){//GENERA UN STRING PARA INTRODUCIRLO COMO CONTENIDO DE UN SELECT
  let valor= undefined;
  if(  typeof ev == "object" &&  ( "target" in ev) ) valor=  ev.target.value;
  else valor= ev;
  let dt= allcampos[  valor ];
  console.log(  typeof ev);
  let resu="";
  dt.forEach( function(ar){ 
    let selected= "";
    if( ar.back == defaul) selected= "selected";
     resu= resu+ "<option "+selected+" value='"+ar.back+"'>"+ar.face+"</option>" ; 
     }  );
  return resu;
} 

// CREAR UNA CONDICION, CARGAR A LA TABLA TEMPORAL
function crear_select_campo( defaul){ 
  let options= return_table_fields(  $("#TABLA").val() , defaul);
  let expr= "  <select class='form-control form-control-sm' >"+options+"</select>";
  return expr;
}
function crear_input_campo( defaul){
  if( defaul == undefined) defaul="";
 return "<input value='"+defaul+"' type='text'  class='form-control form-control-sm'  >";
}

function crear_select_ope_rela( defaul){
  if( defaul == undefined) defaul="=";
  let expr= "  <select class='form-control form-control-sm' >";
  expr+="<option "+(defaul=="="? 'selected':'')+" value='='>IGUAL</option>";
  expr+="<option "+(defaul==">"? 'selected':'')+" value='>'>MAYOR</option>";
  expr+="<option "+(defaul=="<"? 'selected':'')+" value='<'>MENOR</option>";
  expr+="<option "+(defaul=="<>"? 'selected':'')+" value='<>'>DIFERENTE</option>  </select>";
  return expr;
}

function crear_select_ope_logico( defaul){
  if( defaul == undefined) defaul="";
  let expr= "  <select onchange='cargar_condicion(event)' class='form-control form-control-sm' >";
  expr+="<option "+(defaul==""? 'selected':'')+" value='' > </option>";
  expr+="<option "+(defaul=="&&"? 'selected':'')+" value='&&'> Y </option>";
  expr+="<option "+(defaul=="||"? 'selected':'')+" value='||'>O </option> </select>";
  return expr;
}

function  condition_creator( campo, operel, valor, opelog){
  let id_=  document.querySelector("#CONDICIONES tbody").children.length;
   
  $("#CONDICIONES tbody").append("<tr id='"+id_+"'><td>"+crear_select_campo(campo)+"</td><td>"+crear_select_ope_rela(operel)+"</td><td>"+crear_input_campo(valor)+"</td><td>"+crear_select_ope_logico(opelog)+"</td></tr>");
}


/**VERIFICAR SI EXISTE FILA EN TABLA */
function verifica_id_fila( id){
  let rws= document.querySelector("#CONDICIONES tbody").children;
  return   !(rws[ parseInt(id) +1]  == undefined ) ; 
}


function cargar_condicion(  ev ){
if( ev.target.value != "")
{
   //YA EXISTE OTRA FILA DEBAJO?
   if( !verifica_id_fila( ev.target.parentNode.parentNode.id) ){
  condition_creator();//SI EL OPERADOR LOGICO SELECCIONADO NO ES VACIO, SE AGREGA UNA NUEVA FILA
    }
}
else
{ 
 
      let actual= parseInt(ev.target.parentNode.parentNode.id); 
      console.log( "actual", actual);
      let lng= document.querySelector("#CONDICIONES tbody").children.length; 
      let id_borra= parseInt(lng)-1;console.log( "a borrar", id_borra);
      while( id_borra!= 0 &&  id_borra != actual ) { document.querySelector("#CONDICIONES tbody").children[id_borra].remove(); id_borra--; }
     
 }
}









function ajaxCall( ev, divname){//Objeto event   DIV tag selector to display   success handler
ev.preventDefault(); 
//preparar datos
if( $("input[name=NOMBRE]").val() =="" ){  alert("INGRESE NOMBRE PARA EL FILTRO"); return;}
if( !confirm("CONTINUAR?" )  ) return;
$("input[name=FILTRO]").val(generar_sentencia_sql());
 $.ajax(
     {
       url:  ev.target.action,
       method: "post",
       data: $("#"+ev.target.id).serialize(),
       headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
       beforeSend: function(){
         $( divname).html(  "<div class='spinner mx-auto'><div class='spinner-bar'></div></div>" ); 
       },
       success: function(res){
        $(divname).html("");
           let r= JSON.parse(res);
           if("ok" in r)  alert( r.ok);
            else alert( r.error);
            ev.target.reset();  
       },
       error: function(){
         $( divname).html(  "<h6 style='color:red;'>Problemas de conexión</h6>" ); 
       }
     }
   );
}/*****end ajax call* */








//INICIALIZACION
window.onload= function(){
//cargar_campos(  $("#TABLA").val() );
if($("#OPERACION").val() == "M") translate_sql( $("input[name=FILTRO]").val() );
else      condition_creator();
}
//object.keys( allcampos ).forEach( function(ar){    allcampos[ar].forEach( function(aru){    console.log( ar, "->",  aru   );      }  );    })
</script>
