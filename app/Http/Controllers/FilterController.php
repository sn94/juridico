<?php

namespace App\Http\Controllers;

use App\CuentaJudicial;
use App\Demanda;
use App\Filtros;
use App\Http\Controllers\Controller;
use App\MovCuentaJudicial;
use App\ODemanda;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   
use App\Parametros;
use App\pdf_gen\PDF;
use DeepCopy\Filter\Filter;
use Illuminate\Http\Client\Request as ClientRequest;
 
class FilterController extends Controller
{


    private $NUMEROCOLS=9;
     
    public function __construct()
    {
        date_default_timezone_set("America/Asuncion");
    }
   

    

public function index(Request $request ){  
    
    $lista= Filtros::orderBy('NRO','DESC')->paginate(20);
    if( $request->ajax())
    return view('informes.filtros.grilla', [ "lista"=> $lista, 
    'ejecucionxls'=> url("exexlsfiltro"),  'ejecucionpdf'=> url("exepdffiltro") ] );
    else
    return view('informes.filtros.index', [ "lista"=> $lista, 'OPERACION'=>"A", 
    'ejecucionxls'=> url("exexlsfiltro"),  'ejecucionpdf'=> url("exepdffiltro") ] );
} 



public function filtro_orden( Request $request, $col, $sentido){
    $orden= $sentido== "A" ?"ASC" : "DESC";
    $dato= Filtros::orderBy($col, $orden )->paginate(20); 

if( $request->ajax()){
     if($dato->count() )
     return view("informes.filtros.grilla", ["lista"=>  $dato ] );
     else
     echo "<h6>SIN REGISTROS</h6>";
}else{
     return view("informes.filtros.index",
     ["lista"=>  $dato,  'ejecucionxls'=> url("exexlsfiltro"),  'ejecucionpdf'=> url("exepdffiltro") ] );
}
}

public function get_name($id){
    echo json_encode( array("nombre"=> Filtros::find($id)->NOMBRE) );
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
 
/**
 * Relaciones entre tablas
 *
 */

public function relaciones_filtro(){
    $tablas= array();
    $pa=DB::table("param_filtros")-> select('TABLA')->where("TIPO", "<>", NULL)->get();
    //tablas y sus nombres
     foreach( $pa as $item){
         //Relaciones
        $Relaciones= DB::table("relaciones_filtros")->where("TABLA", $item->TABLA)->pluck("CAMPO_REL", "TABLA_REL");
        $tablas[$item->TABLA]=  $Relaciones;
     }
    echo  json_encode( $tablas);
}
/**
 * 
 * 
 */

   
public function cargar( Request $request, $OPERACION= "A", $id=""){
    if( ! strcasecmp(  $request->method() , "post"))  {//hay datos 
        //Quitar el campo _token
        $Params=  $request->input();  

         DB::beginTransaction();
        try{
        
           $r= $OPERACION=="A" ? new Filtros() : Filtros::find( $Params['NRO']);
             $r->fill( $Params  );
             $r->save();
             echo json_encode( array('ok'=>  url("filtro/".$r->NRO)  ));    
             DB::commit();
         
       
        } catch (\Exception $e) {
            DB::rollback();
            echo json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos<br>$e") );
        }   
    }
    else{    
        $url_fields_res= url("res-filtro/f");
        $url_table_res= url("res-filtro/t");
        $url_relaciones= url("rel-filtro");
        $url_data_res= url("res-aux");
        $url_inicio=url("filtros");
        if( $OPERACION=="A")
        return view('informes.filtros.form',
         ["OPERACION"=> $OPERACION, "index"=> $url_inicio , "res_fields"=>$url_fields_res, 
         "res_tables"=>$url_table_res, 'res_relaciones'=> $url_relaciones ,'url_data_res'=>$url_data_res]);
         if( $OPERACION=="M")
         return view('informes.filtros.form',
          ["OPERACION"=> $OPERACION, "DATO"=> Filtros::find($id ), "index"=> $url_inicio , "res_fields"=>$url_fields_res, 
          "res_tables"=>$url_table_res, 'res_relaciones'=> $url_relaciones ,'url_data_res'=>$url_data_res]);
       } 
}

 

public function borrar( $NRO){
    $ob= DB::table("filtros")->where('NRO',$NRO , 1)->delete();
   if( $ob ) echo json_encode( array('IDNRO'=>  $NRO  ) );
   else json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos") );

}

public function list( $tabl){
    $ls= DB::table( "filtros")->get();
    $L= <<<EOF
    
    EOF;
  /*  $ROW= <<<EOF 
    <tr> 
        <td style='text-align:left;'>  </td> 
        <td style='max-width:200px;'>  </td>
    </tr>
EOF;*/
    return view('informes.filtros.grilla' , ["lista"=>  $ls ]);
}



private function limpiarQuery( $SqlParam ){
    $sql= $SqlParam;
    //Verificar si es una sentencia sql antigua
    if( ! preg_match("/\s*select\s*/i", $sql)  ){

        //Quitar comillas innecesarias
        $sql= preg_replace('/(^")|("$)/',"", $sql);
        //Verificar uso de funciones de fecha
        $sql= preg_replace('/(ctod)\(""(\d+\/\d+\/\d+)""\)/i', "str_to_date('$2','%d/%m/%Y')", $sql);
        $sql= preg_replace( "/(ctod)\('(\d+\/\d+\/\d+)'\)/i", "str_to_date('$2','%d/%m/%Y')", $sql);
        //eLIMINAR NOMBRES ERRONEOS DE CAMPOS
        $sql= preg_replace('/(LIQUIDACION)/',"LIQUIDACIO", $sql);
        //Modificar operadores incorrectos
        $sql= preg_replace('/(=>)/',">=", $sql);

        $sql= "select demandado.CI, demandado.TITULAR,demandas2.* from demandas2,notificaciones,demandado where demandas2.IDNRO=notificaciones.IDNRO 
        AND demandado.CI=demandas2.CI AND ".$sql; 
    }else{
        //agregar EL CAMPO TITULAR
        $campos_para_rec= (explode( "select", $sql))[1];
        $separadoFrom= explode( "from", $campos_para_rec);
        $adicional1= "select demandado.TITULAR,demandado.CI,".$separadoFrom[0];

        $separadoWhere= explode("where", $separadoFrom[1]);
        $adicional2= $separadoWhere[0].", demandado ";
        $adicional3= $separadoWhere[1]. " and demandas2.CI=demandado.CI";
        $sql=$adicional1." from ".$adicional2." where ".$adicional3;

    }
    //lIMPIAR
    $sql_1=preg_replace("/(&&)|(\.AND\.)/i"," AND ", $sql);
    $sql_2= preg_replace("/(\|\|)|(\.or\.)/i", "OR", $sql_1);
   
    //EJECUTAR 
   $ls= DB::select(  $sql_2);
    return $ls;
}
 

public function aviso_recorte_cols( $id_consulta){
    $Filtro= Filtros::find( $id_consulta);
    $resultados= $this->limpiarQuery( $Filtro->FILTRO );//Prepara la sentencia sql la ejecuta
    if( sizeof( $resultados) ){
       $cols=   sizeof(array_keys(get_object_vars($resultados[0]))) ;
       if( $cols> $this->NUMEROCOLS) echo json_encode(array("msg"=>"PARA UNA MEJOR VISUALIZACIÓN EN PDF, SE HA RECORTADO EL NÚMERO DE COLUMNAS"));
    }else echo json_encode(array("msg"=>"x"));
  
}


private function filtro_inteligente_th($clave){
    $html="";
    if( $clave=="TITULAR")
    $html.="<th class=\"titular\">$clave</th>"; 
    else{
        if( $clave=="IDNRO")
        $html.="<th class=\"idnro\">$clave</th>"; 
       else{
        if( $clave=="CI")
        $html.="<th class=\"ci\">$clave</th>"; 
        else
        $html.="<th>$clave</th>"; 
       }
    }
    
    return $html;
}

private function filtro_inteligente_td($clave, $VALOR){
$html="";
$valor= $VALOR;

//Valores Referenciales
if($clave=="DEMANDANTE"){ 
    $x=DB::table("demandan")
    ->where( "IDNRO",$valor)
    ->first(); 
    $valor= !is_null( $x )? $x->DESCR: $valor ;
}
    if( $clave=="TITULAR")
        $html.="<td class=\"titular\">  $valor</td>";
    else{
        
    if( $clave=="IDNRO")
    $html.="<td class=\"idnro\">  $valor</td>";
    else{
        if( $clave=="CI")
        $html.="<td class=\"ci\">  $valor</td>";
        else 
        $html.="<td> $valor</td>";
    }
    }
   
   return $html;
}

public function  reporte( $id_consulta, $tipo="xls"){
    set_time_limit(0);
    ini_set('memory_limit', '-1');
    $Filtro= Filtros::find( $id_consulta);
    $resultados= $this->limpiarQuery( $Filtro->FILTRO );//Prepara la sentencia sql la ejecuta
  

    //Determinar el numero de columnas
    if( sizeof( $resultados) ){
        $cols=   sizeof(array_keys(get_object_vars($resultados[0]))) ;  
        if( $cols < $this->NUMEROCOLS)   $this->NUMEROCOLS=  $cols;
     } 
   
    
    if( $tipo == "xls"){ echo json_encode( $resultados ); 
      }//Devuelve los datos en JSON
    else{// Genera un PDF

    //EJECUTAR
        $Titulo= $Filtro->NOMBRE; 
        $html=<<<EOF
         <style>
         th{
             font-size:6pt;
             font-weight: bold;
             background-color: #bac0fe;
             color: #060327;
         }
         .ci{
            width: 50px;
         }
         .titular{
             width: 150px;
         }
         .idnro{
             width: 50px;
         }
         .row{
             font-size: 6pt;
             padding: 0px;
         }
         td{
            padding: 0px;
         }
         .col{
             display:inline;
        }
         </style>
         <table>
         <thead>
         <tr>
        EOF;

       



        $cols=0;
         foreach( $resultados as $objeto):
            foreach( $objeto as $clave=>$valor):
            
                if( $cols== $this->NUMEROCOLS) break;
                $html.=$this->filtro_inteligente_th($clave);
                $cols++;
            endforeach;
        break;
         endforeach;
        $html.= "</tr></thead><tbody>";

     
        $num_cols=1; 
       $column_names= [];
       if( sizeof($resultados)) $column_names= array_keys(get_object_vars($resultados[0]));
 
       
       foreach( $resultados as $objeto): 
      
            $html.="<tr class=\"row\">"; 
            foreach($column_names as $clave):
                $valor= $objeto->{$clave}; 
                 $html.= $this->filtro_inteligente_td($clave, $valor);
                 if($num_cols == $this->NUMEROCOLS) {   $num_cols= 1; break;}
                $num_cols++;
            endforeach;
         
            $html.="</tr>"; 
        endforeach; 
        $html.="</tbody></table>";
 
        
        if( sizeof( $resultados) ){
            $tituloDocumento= $Titulo."-".date("d")."-".date("m")."-".date("yy")."-".rand();
          $pdf = new PDF("L"); 
            $pdf->prepararPdf("$tituloDocumento.pdf", $tituloDocumento, ""); 
            $pdf->generarHtml( $html);
            $pdf->generar();
        }
          }//End Pdf gen
}




public function COMPATIBILIDAD_FECHA(){
    set_time_limit(0);
    ini_set('memory_limit', '-1');
    $rows=MovCuentaJudicial::get(); 
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
}


public function test(){
    set_time_limit(0);
    ini_set('memory_limit', '-1');
    $rows=Demanda::get(); 
 
  
    foreach( $rows as $ite){
       $demandante= $ite->CI;
       $res= DB::table("demandan")->where("DESCR", $demandante)->first();
       if( !is_null($res) ){
           $ite->DEMANDANTE= $res->IDNRO;
           $ite->save();
       }
      
       
        
    }
  
   
}



}