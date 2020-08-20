<?php

namespace App\Http\Controllers;

use App\Demanda;
use App\Filtros;
use App\Http\Controllers\Controller;
use App\ODemanda;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   
use App\Parametros;
use App\pdf_gen\PDF;
use Illuminate\Http\Client\Request as ClientRequest;

class FilterController extends Controller
{
     
    public function __construct()
    {
        date_default_timezone_set("America/Asuncion");
    }
   

    

public function index( ){  
    $lista= Filtros::paginate(20);
    return view('filtros.index', [ "lista"=> $lista, 'OPERACION'=>"A", 
    'ejecucionxls'=> url("exexlsfiltro"),  'ejecucionpdf'=> url("exepdffiltro") ] );


} 




 
   

   
public function agregar( Request $request){
    if( ! strcasecmp(  $request->method() , "post"))  {//hay datos 
        //Quitar el campo _token
        $Params=  $request->input(); 
        //Devuelve todo elemento de Params que no este presente en el segundo argumento
        $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"]),function($ar1, $ar2){
            if( $ar1 == $ar2) return 0;    else 1; 
         } ); 

         DB::beginTransaction();
        try{
             $r= DB::table("filtros"); 
             $r->insert( $Newparams  );
             echo json_encode( array('ok'=>  "GUARDADO"  ));    
             DB::commit();
       
        } catch (\Exception $e) {
            DB::rollback();
            echo json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos<br>$e") );
        }   
    }
    else  {   return view('filtros.form', ["OPERACION"=>"A"]);
       }/** */    
}


 

   
public function editar( Request $request, $NRO=""){
    if( ! strcasecmp(  $request->method() , "post"))  {//hay datos 
        //Quitar el campo _token
        $Params=  $request->input(); 
        //Devuelve todo elemento de Params que no este presente en el segundo argumento
        $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"]),function($ar1, $ar2){
            if( $ar1 == $ar2) return 0;    else 1; 
         } ); 

         DB::beginTransaction();
        try{
             $r= DB::table("filtros"); 
             $r->where('NRO', $Params['NRO'])
             ->update( $Newparams  );
             echo json_encode( array('ok'=>  "ACTUALIZADO"  ));    
            DB::commit();
       
        } catch (\Exception $e) {
            DB::rollback();
            echo json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos<br>$e") );
        }   
    }
    else  {   
       $ob= DB::table("filtros")->where('NRO',$NRO )->first();
        return view('filtros.form', ["OPERACION"=>"M",  "DATO"=>  $ob]   );
       }/** */    
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
    return view('filtros.grilla' , ["lista"=>  $ls ]);
}



private function limpiarQuery( $id_consulta ){
    $sql= Filtros::find( $id_consulta )->FILTRO;
    //Verificar si es una sentencia sql antigua
    if( ! preg_match("/\s*select\s*/i", $sql)  ){

        //Quitar comillas innecesarias
        $sql= preg_replace('/(^")|("$)/',"", $sql);
        //Verificar uso de funciones de fecha
        $sql= preg_replace('/(ctod)\(""(\d+\/\d+\/\d+)""\)/i', "str_to_date('$2','%d/%m/%Y')", $sql);
        $sql= "select * from demandas2,notificaciones where demandas2.IDNRO=notificaciones.IDNRO AND ".$sql; 
    }
    //lIMPIAR
    $sql_1=preg_replace("/(&&)|(\.AND\.)/i"," AND ", $sql);
    $sql_2= preg_replace("/(\|\|)|(\.or\.)/i", "OR", $sql_1);

    //EJECUTAR
   $ls= DB::select(  $sql_2);
    return $ls;
}
 



public function  reporte( $id_consulta, $tipo="xls"){
    $ls= $this->limpiarQuery( $id_consulta);
    if( $tipo == "xls"){  echo json_encode( $ls );   }
    else{//ini Pdf Gen

    }//End Pdf gen
    //EJECUTAR
        $Titulo= Filtros::find( $id_consulta)->NOMBRE; 
        $html = '<table>';
        //Formar cabecera
        $html.="<thead><tr>";
        foreach( $ls as $clave=>$valor):
            $html.="<td>$clave</td>";
        endforeach;
        $html.="</tr></thead>"; 
        $html.='</table>';

       // echo $html;
  
        $tituloDocumento= $Titulo."-".date("d")."-".date("m")."-".date("yy")."-".rand();
        $pdf = new PDF( "L", array(215, 340)); 
        $pdf->prepararPdf("$tituloDocumento.pdf", $tituloDocumento, ""); 
        $pdf->generarHtml( $html , "L" );
        $pdf->generar();
}

}