<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  

class DemandaController extends Controller
{
    

    public function __construct()
    {
        date_default_timezone_set("America/Asuncion");
    }

/****
 * DEMANDAS
 * 
 */
/**
 * Listado de demandas
 * *
 * */
    public function demandas(){
        $o_de= DB::table("odemanda")->get();

        $dts = DB::select("select TITULAR,CI,DEMANDANTE,COD_EMP,CTA_BANCO,BANCO,GARANTE,CI_GARANTE from demandas  order by TITULAR");
        return view('demandas.list', ['lista' => $dts, "odemanda" => $o_de]); 
    }

/**
 * LiSTA DE DEMANDAS POR ORIGEN
 */
    public function demandas_by_origen( $origen){ 
        $dts = DB::select("select TITULAR,CI,DEMANDANTE,COD_EMP,CTA_BANCO,BANCO,GARANTE,CI_GARANTE from demandas where O_DEMANDA='$origen' order by TITULAR");
        return view('demandas.list_tabla_demanda', ['lista' => $dts ]); 
    }
/**
 * FICHA DE DEMANDA SEGUN COD_EMP
 */
    public function ficha_demanda(  $codemp){
        $data= DB::table("demandas")->where('cod_emp', $codemp)->first();
        return view("demandas.ficha_demanda", ['ficha'=>   $data] );
    }



  /*
    NUEVA DEMANDA
    */
    public function nueva_demanda(Request $request){
         
        if( ! strcasecmp(  $request->method() , "post"))  {
            
            //Quitar el campo _token
            $Params=  $request->input(); 
            //Devuelve todo elemento de Params que no este presente en el segundo argumento
            $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"] ),function($ar1, $ar2){
                if( $ar1 == $ar2) return 0;    else 1; 
             } );
             //insert to DB
            $r= DB::table('demandas')->insert(  $Newparams  );
            var_dump( $r);
        }
        else
        return view('demandas.agregar'); 
    }

 





/**
 * LIQUIDACIONES
 * 
 */

public function demandas_p_liquidi(){
    $o_de= DB::table("odemanda")->get();

    $dts = DB::select("select TITULAR,CI,DEMANDANTE,COD_EMP,CTA_BANCO,BANCO,GARANTE,CI_GARANTE from demandas  order by TITULAR");
    return view('liquidaciones.liquidaciones', ['lista' => $dts, "odemanda" => $o_de]); 
}


public function demandas_p_liquidi_b_o( $origen){ 
    $dts = DB::select("select TITULAR,CI,DEMANDANTE,COD_EMP,CTA_BANCO,BANCO,GARANTE,CI_GARANTE from demandas where O_DEMANDA='$origen' order by TITULAR");
    return view('liquidaciones.liqui_tabla', ['lista' => $dts ]); 
}
  

    /*
    *
    LIQUIDAR DEMANDA
    **
    */
    public function liquidar(){
        return view('demandas.liquidar'); 
    }


    //*************************************************** */
      

 


 



}