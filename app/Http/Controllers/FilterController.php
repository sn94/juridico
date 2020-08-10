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
    //$ls= DB::table("filtros")->get();

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
   if( $ob ) echo json_encode( array('ok'=>  "BORRADO"  ) );
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



public function  xlsfiltro(){
    echo json_encode(  DB::table( "filtros")->get()  );
}

public function  pdffiltro(){
   $ls= DB::table( "filtros")->get() ; 
   
    $html=<<<EOF
    <style>
    span{
        font-weight: bolder;
    }
    td{ 
        text-align:left;
    }
    table.tabla{ 
        font-family: helvetica;
        font-size: 8pt; 
    }
    </style>
    <table class='tabla'>
        <thead>
            <tr>
                <th>NOMBRE</th>
                <th>FILTRO</th>
            </tr>
        </thead>
        <tbody>
    EOF;
    foreach( $ls as $DATO):
      
        $AX= $DATO->FILTRO;
        //'DEPOSITADO > 0 .AND. SD_NRO <> 0 .AND. EXTRAIDO_C = 0' ;
        // substr( $DATO->FILTRO, 0,2);
      
    endforeach;
    
    $html.="
    </tbody> </table> ";
    /********* */

$ht="";
foreach( $ls as $DATO):
$ht= "$DATO->NOMBRE - $DATO->FILTRO";
endforeach;
    $tituloDocumento= "FILTROS-".date("d")."-".date("m")."-".date("yy")."-".rand();

        $pdf = new PDF(); 
        $pdf->prepararPdf("$tituloDocumento.pdf", $tituloDocumento, ""); 
        $pdf->generarHtml( $ht  );
        $pdf->generar();
}

}