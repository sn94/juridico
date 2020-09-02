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

   .multiselect {
      width: 200px;
      position:relative;
      }
.selectBox {position: relative;}

.selectBox select {width: 100%;}

   .fields {
      display: block;
      border: 1px #dadada solid;
      position:absolute;
      width:100%;
      background-color:white;
      box-sizing: border-box;
      overflow-y:auto;
      max-height:200px;
      z-index: 10000;
}
.fields.hide {display:none;}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  }
 </style>
 
  
<input type="hidden" id="OPERACION" value="{{ !isset($OPERACION)?'A': $OPERACION}}">
<input type="hidden" id="index" value="{{ $index}}">
<input type="hidden" id="res_fields" value="{{ $res_fields}}">
<input type="hidden" id="res_tables" value="{{ $res_tables}}">
<?php  
$ruta= $OPERACION =="A" ? url("nfiltro") : url("efiltro");
  ?>

 
<div class="row">

  
<div id="instant-report" class="col-12 col-sm-9 col-md-10 col-lg-8">

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
          <div class="col-12 col-sm-6 col-md-3 col-lg-3 d-flex align-items-center">
              <div class="toast" role="alert" aria-live="polite" aria-atomic="true" data-delay="1000">
            <div role="alert" aria-live="assertive" aria-atomic="true" id="dema-msg">GUARDADO</div>
            </div>
          </div>
     </div>
 
    </form>
  </div>

</div>

<div id="statusform">

</div>
<h5>CAMPOS A VISUALIZAR</h5>

<table id="CAMPOS-VIEW"  style='background-color: #bdfbbb; border-collapse: separate;border-spacing: 15px 5px;'  >
  <tbody>

  </tbody>
</table>
<h5>CONDICIONES</h5>
<table id="CONDICIONES" class="table table-striped table-bordered <?= $detect->isMobile()?"":"table-responsive" ?>">
      <thead class="thead-dark "> 
        <th class="pb-0">  TABLA  </th>
        <th class="pb-0">  CAMPO  </th>
        <th class="pb-0">RELACIÓN</th>
        <th class="pb-0"> VALOR</th>
        <th class="pb-0">LÓGICO</th>  </thead>
      <tbody>  </tbody>
</table>


 
 





<!-- REPORTE --> 
@include("layouts.report", ["TITULO"=> "FILTROS"])

@endsection 


<script>
/*
Sentencia de asentamiento de parametros para filtro
INSERT INTO param_filtros(CAMPO,TABLA,LONGITUD) 
SELECT COLUMN_NAME as CAMPO,TABLE_NAME as TABLA,CHARACTER_MAXIMUM_LENGTH as LONGITUD
FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'juridico' AND 
(TABLE_NAME = 'demandas2' or TABLE_NAME='notificaciones' or TABLE_NAME='arreglo_extrajudicial' or TABLE_NAME='inter_contraparte')
*/

var wellTableNames= {};
var allcampos= {}; 

//Relaciones
var relations={
  demandas2: { notificaciones: "IDNRO", cta_judicial: "CTA_JUDICI"},
  notificaciones: { demandas2: "IDNRO"},
  cta_judicial: { demandas2: "CTA_BANCO"}

};

function cargar_listas_reg_tab(){
  
}
function cargar_params_tabla(){ 
          //params campos
        $.ajax( { url: $("#res_fields").val(), dataType: "json", 
        success: function(data){ 
          allcampos= data;
          $("#statusform").html("");
          init_filter(); },
        beforeSend: function(){ $("#statusform").html("<p style='font-weight: 600;' >Cargando datos</p>"); }
        }); 
}

/**OBTENCION DE RECURSOS */
window.onload= function(){
  //obtener recursos 
  //params tablas
    $.ajax( { url: $("#res_tables").val(), dataType: "json", 
      success: function(data){    
        wellTableNames= data;
        $("#statusform").html("");
        cargar_params_tabla();
        },
      beforeSend: function(){ $("#statusform").html("<p style='font-weight: 600;' >Cargando datos</p>"); }
      });
}


function init_filter(){
  selectFieldsOptions();
  //sI ES EDICION, SE INFIERE A PARTIR DE LA CADENA SQL los controles de form
  if($("#OPERACION").val() == "M") translate_sql( $("input[name=FILTRO]").val() );
  else     condition_creator();
}


//A PARTIR DE UNA CAD SQL EXTRAER TOKENS
function  translate_sql( arg){
   
//Obtener tokens de los campos seleccionados
let fields_from_sele=  arg.split("where")[0].replaceAll( new RegExp("(select)|from"),"").trim();
let eachField= fields_from_sele.split(",");
eachField.forEach( function(fiel){
  let tempo=fiel.split(".");
  let tabla= tempo[0];  let campo=  tempo[1];
  $("#"+tabla+"-"+campo).prop("checked", true);
});
 


  let base= arg.split("where")[1];//Obtener solo la condicion
  let  propo1= base.split(/(&&|\|\|)/);//Dividir por operadores logicos OR AND
  let ope_logicos= propo1.filter( function(ar){ return ar=="&&" || ar=="||"; } );
  let ls_condi=  propo1.filter( function( ar){ 
    let tempo= ar.trim();
    return  (tempo != "")  && (tempo!="&&")  && (tempo !="||");  }  );
    //CREAR LOS CAMPOS DE CARGA
    $("#CONDICIONES tbody").empty();
    ls_condi.forEach( function(condi, indice){

      let operandos= condi.split(/(<>)|(>\w)|(>=)|(<=)|(<)|(=)/).filter(function(ar){ return ar!= undefined; });
      let tablaxcampo=operandos[0].trim();
      let campo__= tablaxcampo.split(".")[1];//Nombre de campo
      let tablax= tablaxcampo.split(".")[0];//OBTENER TABLA ASOCIADA
      try{
        condition_creator( tablax,  campo__, operandos[1], operandos[2].trim(),  ope_logicos[indice]  );
      }catch(err){
        condition_creator( tablax,  campo__, operandos[1], operandos[2].trim() );
      }
     
 
    });
    

}

 

//paso 1 CARGAR CAMPOS DE LA TABLA SELECCIONADA
function cargar_campos(ev){
 /* $("#CONDICIONES tbody").empty();
    condition_creator();
    return;
                                    reiniciar tabla de filtros*/
  let valor= undefined;
  valor=  ev.target.value;//NOMBRE DE TABLA SELECCIONADA
    //Nodo select Campos
    let selectCampos= ev.target.parentNode.parentNode.children[1].children[0] ;
    //vaciar CAMPOS
    $( selectCampos).empty();
    let dt= allcampos[  valor ];//OBTENER CAMPOS DE LA TABLA SELECCIONADA 
    dt.forEach( function(ar){  $( selectCampos).append("<option value='"+ar.back+"'>"+ar.face+"</option>" ); }  );
control_input(  ev);//Controlar tipo de dato
} 



function generar_selects_fields(){
  let fie= [];
  Array.prototype.forEach.call( $("input[type=checkbox]"),  function(s){
    if( s.checked ){
      let tablefield= s.id.split("-");
       fie.push( tablefield[0]+"."+tablefield[1]);
       }
    } );
    if( fie.length == 0) return " * ";
    else return fie.join(",") ;
}
/**GENERAR NUEVA SENTENCIA */
function generar_sentencia_sql(){
  let tableNames= [];  //Identificar tablas existentes en el filtro
  let wheres= ""; //Concatenacion de expresiones relacionales mediante operadores logicos
  let selects= generar_selects_fields();
  let sql=" select "+selects+" from ";

  Array.prototype.forEach.call( document.querySelector("#CONDICIONES tbody").children,  function( row){
   
    let tabla_= row.children[0].children[0].value;//Nombre de tabla
    if( ! tableNames.includes( tabla_ )){  tableNames.push( tabla_ );  }

        let campo= row.children[1].children[0].value;//campo de tabla
        let operel=row.children[2].children[0].value;//Operador relacional
        let valor= row.children[3].children[0].value;//valor en comparacion
        let opelog=row.children[4].children[0].value;//Operador logico
        wheres=   wheres+" "+ tabla_+"."+campo+operel+valor+" "+opelog+" ";
  }); 

  //DEFINIR RELACIONES ENTRE TABLAS
  let tablas_ya_relacio=[];
  let relaciones= [];
  tableNames.forEach( function(ar){
    if( !tablas_ya_relacio.includes(ar) ){
      let TABLA_PRINCI= ar;
      if(Object.keys( relations).includes(ar)){
        let rela=Object.keys(relations[ar]);//Nombre de otras tablas con las que se relaciona la tabla ar
        rela.forEach( function(RELACIONADA){
          if( tableNames.includes(RELACIONADA)  ) { 
            relaciones.push( TABLA_PRINCI+"."+relations[TABLA_PRINCI][RELACIONADA]+"="+ RELACIONADA+"."+relations[RELACIONADA][TABLA_PRINCI] );
            tablas_ya_relacio.push( RELACIONADA);
            tablas_ya_relacio.push( TABLA_PRINCI);
            }
        })
      }
    }
  });/**fIN RELACIONAMIENTO */
   
  //Concatenar tables
let tbls= tableNames.reduce( function(prev, curr){
  return prev+","+curr;
});
sql+=   tbls+" where  "+wheres+ relaciones; 
return sql;
}

/**PREPARAR CREADOR DE CONDICIONES */
function return_table_fields(ev, defaul){//GENERA UN STRING PARA INTRODUCIRLO COMO CONTENIDO DE UN SELECT
  let valor= undefined;
  if(  typeof ev == "object" &&  ( "target" in ev) ) valor=  ev.target.value;
  else valor= ev;
  let dt= allcampos[  valor ]; 
  let resu="";
  dt.forEach( function(ar){ 
    let selected= "";
    if( ar.back == defaul) selected= "selected";
     resu= resu+ "<option "+selected+" value='"+ar.back+"'>"+ar.face+"</option>" ; 
     }  );
  return resu;
} 

// CREAR UNA CONDICION, CARGAR A LA TABLA TEMPORAL
function crear_select_tabla(defaul){
  if( defaul == undefined) defaul= Object.keys( allcampos )[0];//table name( default)
  let expr=" <select class='form-control form-control-sm' onchange='cargar_campos(event)'    >";
  
  Object.keys( allcampos ).forEach( function( tab, index){
    expr+="<option "+(defaul== tab? 'selected':'')+" value='"+tab+"'>"+ wellTableNames[tab] +"</option>";
  });
  expr+="</select> ";
  return expr;
}
function crear_select_campo( tabla, defaul){ 
  let defaultTableName=  tabla ==undefined ? Object.keys( allcampos )[0]  :  tabla;
  let options= return_table_fields( defaultTableName  , defaul);
  let expr= "  <select class='form-control form-control-sm' onchange='control_input(event);' >"+options+"</select>";
  return expr;
}



function crear_input_campo( tabla, campo, defaul){ //tabla campo valor
  if( defaul == undefined) defaul="";//valor por defecto
  if(tabla ==undefined) tabla= Object.keys(wellTableNames)[0];//Nombre de tabla por defecto
  if(campo == undefined ) campo= allcampos[tabla][0].back;//Nombre de campo default

//Select Html
let select_tag= function( arreglo, pordefecto){
  let html= "<select  class='form-control form-control-sm'  >"
  arreglo.forEach( function( keyvalue){
    let clave=Object.keys(  keyvalue )[0];
    let checkeable= pordefecto == clave ? "selected" : "";
    html= html+"<option  "+checkeable+" value='"+clave+"'>"+keyvalue[clave]+"</option>";
  });
  html= html+"</select>";  return html;
};

  let metadata_campo=allcampos[tabla].filter( function( datafield){ return datafield.back==campo})[0];
  console.log( metadata_campo);
 switch( metadata_campo.tipo){
   case 'N': return "<input value='"+defaul+"' type='text' maxlength='"+metadata_campo.longitud+"' oninput='solo_numero(event)' class='form-control form-control-sm'  >";break;
   case 'C': return  "<input value='"+defaul+"' type='text' maxlength='"+metadata_campo.longitud+"'  class='form-control form-control-sm'  >";break
   case 'F': return "<input value='"+defaul+"' type='date'   class='form-control form-control-sm'  >";break
   case 'B': return select_tag( [{'N':'NO'},{'S':'SI'}], 'N'  );break
   case 'L': return select_tag( [{'N':'NO'},{'S':'SI'}], 'N'  );break

 }
 
}

function crear_select_ope_rela( defaul){
  if( defaul == undefined) defaul="=";

  let expr= "  <select class='form-control form-control-sm' >";
  expr+="<option "+(defaul=="="? 'selected':'')+" value='='>IGUAL</option>";
  expr+="<option "+(defaul==">"? 'selected':'')+" value='>'>MAYOR</option>";
  expr+="<option "+(defaul=="<"? 'selected':'')+" value='<'>MENOR</option>";
  expr+="<option "+(defaul==">="? 'selected':'')+" value='>='>MAYOR O IGUAL</option>";
  expr+="<option "+(defaul=="<="? 'selected':'')+" value='<='>MENOR O IGUAL</option>";
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




function  condition_creator( tabla, campo, operel, valor, opelog){
  let id_=  document.querySelector("#CONDICIONES tbody").children.length;
   
  $("#CONDICIONES tbody").append("<tr id='"+id_+"'><td>"+crear_select_tabla(tabla)+"</td><td>"+crear_select_campo(tabla,campo)+"</td><td>"+crear_select_ope_rela(operel)+"</td><td>"+crear_input_campo(tabla,campo,valor)+"</td><td>"+crear_select_ope_logico(opelog)+"</td></tr>");
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
else{ 
      let actual= parseInt(ev.target.parentNode.parentNode.id);  
      let lng= document.querySelector("#CONDICIONES tbody").children.length; 
      let id_borra= parseInt(lng)-1;
      while( id_borra!= 0 &&  id_borra != actual ) { document.querySelector("#CONDICIONES tbody").children[id_borra].remove(); id_borra--; }  
 }
}





function createCheckOption( table_n, id){
  let html='<div class="form-check">  <input class="form-check-input" type="checkbox" id="'+table_n+"-"+ id.back+'" value="option1"><label class="form-check-label" for="inlineCheckbox1">'+id.face+'</label></div>';
return html;
}

function displayFieldsFromSelect( tabname){
  if( $("#"+tabname).hasClass("hide") )
$("#"+tabname).removeClass("hide");
else $("#"+tabname).addClass("hide");
}

function selectFieldsOptions(){
  let tablenames= Object.keys( wellTableNames);
  let html="";
  let buildme= function( t_table_name, index ){
  
    html+="<td><p>"+ wellTableNames[t_table_name]+"</p>";
    html+="<div class='multiselect'><div class='selectBox' onclick=\"displayFieldsFromSelect('"+t_table_name+"')\" ><select>";
    html+="<option>Elige los campos a mostrar</option> </select> <div class='overSelect'></div> </div>";
    html+="<div id='"+t_table_name+"'  class='fields hide'>";

    allcampos[t_table_name].forEach( function(campo, index){
      html+=   createCheckOption( t_table_name, campo);
    });

    html+="</div> </div></td>";
  };
   html+="<tr>";
  tablenames.forEach( buildme);
  html+="</tr>";
  $("#CAMPOS-VIEW tbody").append( html);
}



function ajaxCall( ev, divname){//Objeto event   DIV tag selector to display   success handler
ev.preventDefault(); 
//preparar datos
if( $("input[name=NOMBRE]").val() =="" ){  alert("INGRESE NOMBRE PARA EL FILTRO"); return;}
 
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
           if("ok" in r){  
             $(".toast").toast("show");
             $("#instant-report").html("<a href='"+r.ok+"' data-toggle='modal' data-target='#show_opc_rep' onclick='mostrar_informe(event)' style='color:black;'><i class='mr-2 ml-2 fa fa-print fa-lg' aria-hidden='true'></i></a>");
            }
            else alert( r.error);
            ev.target.reset();  
       },
       error: function(){
         $( divname).html(  "<h6 style='color:red;'>Problemas de conexión</h6>" ); 
       }
     }
   );
}/*****end ajax call* */







/***VALIDACION*** */

function solo_numero(ev){
   if(ev.data == undefined ) return;
   if( ev.data.charCodeAt() < 48 || ev.data.charCodeAt() > 57){ 
     ev.target.value= 
     ev.target.value.substr( 0, ev.target.selectionStart-1) + 
     ev.target.value.substr( ev.target.selectionStart ); 
   }  
 } 

function control_input(e){
 let row=e.target.parentNode.parentNode;
 let campo= row.children[1].children[0].value;
 let tabla=  row.children[0].children[0].value;
//elemento a borrar
 let to_remove=  row.children[3].children[0] ;
 to_remove.remove();
 row.children[3].innerHTML= crear_input_campo(tabla, campo) ;
}

//INICIALIZACION
/*window.onload= function(){
  selectFieldsOptions();
  if($("#OPERACION").val() == "M") translate_sql( $("input[name=FILTRO]").val() );
  else      condition_creator();
}*/
 
</script>
