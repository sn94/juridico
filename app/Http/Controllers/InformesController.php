<?php

namespace App\Http\Controllers;

 
  
use App\Http\Controllers\Controller;
 
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;    
use App\pdf_gen\PDF; 
use App\Helpers\Helper;

class InformesController extends Controller
{
     
    public function __construct()
    {
        date_default_timezone_set("America/Asuncion");
    }
   

    
    /**
    *Devuelve INFORMACION DETALLADA DE ARREGLOS EXTRAJUDICIALES
    *POR CADA CUOTA
    */
    public function informes_arr_extr(Request $request, $html= 'S' ){  
        $fecha= "";
        if( ! strcasecmp(  $request->method() , "post"))  {//hay datos 
     
        $Desde= $request->input("Desde");
        $Hasta= $request->input("Hasta");
        $fecha= "AND  arr_extr_cuotas.FECHA_PAGO>='$Desde' and 
        arr_extr_cuotas.FECHA_PAGO<='$Hasta' ";
        }
    
        $columnasMovil="";
        $columnasDesktop="";

        $lista= DB::select("SELECT  demandas2.CI,TITULAR , demandas2.DEMANDA,demandan.DESCR as DEMANDANTE,COD_EMP,arreglo_extrajudicial.TIPO,
          arreglo_extrajudicial.IMPORTE_T AS TOTAL,   (select count(*) from arr_extr_cuotas where arr_extr_cuotas.ARREGLO=demandas2.IDNRO) as CUOTAS, 
          (select count(*) from arr_extr_cuotas where arr_extr_cuotas.ARREGLO=demandas2.IDNRO   and arr_extr_cuotas.FECHA_PAGO is not null) as PAGADAS,
        IMPORTE, FECHA_PAGO from arr_extr_cuotas join 
        arreglo_extrajudicial on arreglo_extrajudicial.IDNRO=arr_extr_cuotas.ARREGLO join demandas2 on 
        demandas2.IDNRO=arreglo_extrajudicial.IDNRO join demandado on demandado.CI=demandas2.CI JOIN demandan on 
        demandan.IDNRO=demandas2.DEMANDANTE WHERE demandas2.ARR_EXTRAJUDI='S'  $fecha ");
    
        if( $request->ajax()){
            if($html == "S") //DEVOLVER DATOS CON FORMATO HTML
            return view('informes.arreglo_extraju.grilla_cuotas', 
            [ "lista"=> $lista] );
            else if($html=="N" || $html=="XLS") //DEVOLUCION DE LISTA EN JSON
            echo json_encode(  $lista );
        }
        else{
            if ( $html ==  "S")//cONTENIDO HTML
            return view('informes.arreglo_extraju.index_cuotas', 
            [ "lista"=> $lista, "TITULO"=>"Arreglos Extrajudiciales"] );
            if ( $html ==  "XLS" || $html=="N")//cONTENIDO JSON PARA XLS
            echo json_encode(  $lista ); 
            if ( $html ==  "PDF")//cONTENIDO PDF
            $this->reporte_arreglo_extrajudicial( $lista);
            
        }
 
    } 

 /**
* DEVUELVE INFORMACION MAS SINTETICA QUE LA ANTERIOR PARA LOS ARREGLOS EXTRAJUDICIALES
 */

 public function informes_arreglos_resumen(Request $request, $html= 'S' ){  
        $fecha= "";
        if( ! strcasecmp(  $request->method() , "post"))  {//hay datos 
     
   /*     $Desde= $request->input("Desde");
        $Hasta= $request->input("Hasta");
        $fecha= "AND  arr_extr_cuotas.FECHA_PAGO>='$Desde' and 
        arr_extr_cuotas.FECHA_PAGO<='$Hasta' ";*/
        }
     

        $lista= DB::select("SELECT demandas2.IDNRO, demandas2.CI,demandas2.COD_EMP,TITULAR , demandas2.DEMANDA,
        demandan.DESCR as DEMANDANTE,COD_EMP,arreglo_extrajudicial.TIPO, arreglo_extrajudicial.IMPORTE_T AS TOTAL,
         (select count(*) from arr_extr_cuotas where arr_extr_cuotas.ARREGLO=demandas2.IDNRO) as CUOTAS, 
         (select count(*) from arr_extr_cuotas where arr_extr_cuotas.ARREGLO=demandas2.IDNRO and 
         arr_extr_cuotas.FECHA_PAGO is not null) as PAGADAS from arreglo_extrajudicial join demandas2 
         on demandas2.IDNRO=arreglo_extrajudicial.IDNRO join demandado on demandado.CI=demandas2.CI JOIN 
         demandan on demandan.IDNRO=demandas2.DEMANDANTE WHERE arreglo_extrajudicial.IMPORTE_T > 0     ");
    
        if( $request->ajax()){
            if($html == "S") //DEVOLVER DATOS CON FORMATO HTML
            return view('informes.arreglo_extraju.grilla', 
            [ "lista"=> $lista] );
            else if($html=="N" || $html=="XLS") //DEVOLUCION DE LISTA EN JSON
            echo json_encode(  $lista );
        }
        else{
            if ( $html ==  "S")//cONTENIDO HTML
            return view('informes.arreglo_extraju.index', 
            [ "lista"=> $lista, "TITULO"=>"Arreglos Extrajudiciales"] );
            if ( $html ==  "XLS" || $html=="N")//cONTENIDO JSON PARA XLS
            echo json_encode(  $lista ); 
            if ( $html ==  "PDF")//cONTENIDO PDF
            $this->reporte_arreglo_extrajudicial( $lista);
            
        }
 
    } 













/**
 * 
 */

/**
 * Recoge de la BD los campos de tablas que seran utilizados para crear filtros
 */
public function get_parametros( $opc){
    
    $tablas= array();
    $parametr=array();
    $pa=DB::table("param_filtros")-> select('ORDEN','TABLA' ,'TABLA_FRONT')->distinct()->orderBy("ORDEN","ASC")->
    where("TIPO", "<>", NULL)->get();
    //tablas y sus nombres
     foreach( $pa as $item){
        $tablas[$item->TABLA]= $item->TABLA_FRONT;
     }
     if( $opc == "t"){//Nombre interno y estetico de tablas
        echo json_encode( $tablas);
    }
    if( $opc =="f"){//Nombres internos y esteticos de campos de cada tabla
   //demandas
   foreach( $tablas as $clave=>$valor){
    $campos=DB::table("param_filtros")->
    select(  'CAMPO as back','CAMPO_FRONT as face', 'TIPO as tipo', 'LONGITUD as longitud','FUENTE as fuente' )->
    where("TABLA",$clave)-> where("TIPO", "<>", NULL)->get();
    $lista_Campos=array();
    foreach( $campos as $ite_Campo){  
        array_push(  $lista_Campos ,  array("back"=> $ite_Campo->back, "face"=>$ite_Campo->face, "tipo"=>$ite_Campo->tipo, "longitud"=>$ite_Campo->longitud, "fuente"=>$ite_Campo->fuente ));
    }
    $parametr[$clave]= $lista_Campos ;
 }
 echo json_encode($parametr);
    }
  
}
 
 

 
 

public function  reporte_arreglo_extrajudicial(  $resultados){
    set_time_limit(0);
    ini_set('memory_limit', '-1');
     // Genera un PDF

    //EJECUTAR;
        $Titulo= "Arreglos extrajudiciales" ;
        $html=<<<EOF
         <style>
         th{
             font-size:6pt;
             font-weight: bold;
             background-color: #bac0fe;
             color: #060327
         }
         .ci{
            width: 50px;
            text-align: center;
         }
         .titular{
             width: 150px;
         }
         .total,.demanda{
             text-align: right;
         }
         .cuotas{
            text-align: center;
            width: 40px;
         }
         .demandante, .tipo,.pagadas{
            text-align: center;
         }
         .row{
             font-size: 6pt;
         }
         .col{
             display:inline;
        }
         </style>
         <table>
        <thead>
        <tr>
        EOF;
        
        //Columnas automaticas
        $cols=0;
         foreach( $resultados as $objeto):
            foreach( $objeto as $clave=>$valor):
                if( $clave == "IDNRO") continue;
               // if( $cols==10) break;
               $css_class= strtolower($clave);
               $html.="<th class=\"$css_class\">$clave</th>";
              /* if( $clave == "CI") $html.="<th class=\"ci\">$clave</th>";
               else{ 
                  if( $clave == "TITULAR") $html.="<th class=\"titular\">$clave</th>";
                  else{
                      if($clave=="CUOTAS" || $clave=="PAGADAS") $html.="<th class=\"ci\">$clave</th>";
                      else  $html.="<th>$clave</th>";
                  }
                }*/
            endforeach;
        break;
         endforeach;
         $html.="</tr></thead><tbody>";
      //  $html.= "<th>CI°</th><th>TITULAR</th><th>DEMANDA</th><th>DEMANDANTE</th><th>COD_EMP</th><th>TIPO</th><th>TOTAL</th><th>CUOTAS</th><th>PAGADAS</th><th>IMPORTE</th><th>FECHA PAGO</th></tr></thead><tbody>";
    
       /* foreach($resultados as $objeto):
            $html.="<tr class=\"row\"><td>$objeto->CI</td><td>$objeto->TITULAR</td><td>$objeto->DEMANDA</td><td>$objeto->DEMANDANTE</td><td>$objeto->COD_EMP</td><td>$objeto->TIPO</td><td>$objeto->IMPORTE_T</td><td>$objeto->CANTCUOT</td><td>$objeto->CUOTPAGADA</td><td>$objeto->IMPORTE</td><td>".Helper::fecha_dma($objeto->FECHA_PAGO)."</td></tr>";
        endforeach;*/
        
        
       foreach( $resultados as $objeto): 
            $html.='<tr class="row">';
            foreach($objeto as $clave=>$valor):
                if( $clave == "IDNRO") continue;
                $css_class= strtolower($clave);
                $valor= ( $clave== "TOTAL" ||  $clave== "DEMANDA") ? Helper::number_f($valor) : $valor;
                $html.="<td class=\"$css_class\">$valor</td>";


               // $valor=   ($clave== "TOTAL" ||  $clave== "DEMANDA")? Helper::number_f($valor): $valor;
                //aSIGNAR CLASES CSS
               /* if( $clave == "CI" || $clave=="CUOTAS" || $clave=="PAGADAS") $html.="<td class=\"ci\">$valor</td>";
                else{
                    if( $clave == "TITULAR") $html.="<td class=\"titular\">$valor</td>";
                    else {
                        if( $clave== "TOTAL" ||  $clave== "DEMANDA")  $html.="<td class=\"total\">$valor</td>";
                        else $html.="<td>". $valor."</td>";
                    }
                }*/
           
                
            endforeach;
            $html.="</tr>"; 
        endforeach; 


        $html.="</tbody></table>";

      // echo $html;
        $tituloDocumento= $Titulo."-".date("d")."-".date("m")."-".date("yy")."-".rand();
       $pdf = new PDF(); 
     $pdf->prepararPdf("$tituloDocumento.pdf", $tituloDocumento, ""); 
        $pdf->generarHtml( $html);
        $pdf->generar();  
         
}




public function COMPATIBILIDAD_FECHA(){
    set_time_limit(0);
    ini_set('memory_limit', '-1');
   /*
    $rows=[6];//MovCuentaJudicial::get(); 
$nu=1;
    foreach( $rows as $ite){
        $fecha= $ite->CTA_JUDICI;
        if( $fecha !="") {
            $elementos=  preg_split("/[\/-]/", $fecha);
            try{
                $nuevo=$elementos[2]."-".$elementos[1]."-".$elementos[0];
                if( strlen( $elementos[0] ) <4   )
                {$ite->FECHA= $nuevo;
                $ite->save();
                echo "$nu   $fecha  = ".$nuevo."<br>";}
                
            }catch(Exception $e){
                echo $e->getMessage();
                echo "Error:  $fecha  { $ite->IDNRO}<br>";
            }
            $nu++;
        }
      
    }
   */
}


public function test(){
    set_time_limit(0);
    ini_set('memory_limit', '-1');
    /*$rows=CuentaJudicial::get(); 
 
DB::beginTransaction();
  try{
    foreach( $rows as $ite){
        $idd= $ite->CTA_JUDICI; //222255/55
        $dema= Demanda::where("CTA_BANCO", $ite->CTA_JUDICI)->first();
        if( is_null( $dema)) echo "<br>No hay demanda asociada $idd<br>";
        
    }
    DB::commit();
  }catch( Exception $e){  DB::rollBack();} */
}



}