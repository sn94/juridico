<?php

namespace App\Http\Controllers;

use App\Demanda;
use App\Demandados;
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
    public function demandas_by_origen(  $origen){ 
 
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
    /**
     * request
     * ultimo codigo generado, id de demandado
     */
    public function nueva_demanda(Request $request, $idd=0){
         
        if( ! strcasecmp(  $request->method() , "post"))  {
            
            //Quitar el campo _token
            $Params=  $request->input(); 
            //Devuelve todo elemento de Params que no este presente en el segundo argumento
            $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"] ),function($ar1, $ar2){
                if( $ar1 == $ar2) return 0;    else 1; 
             } ); 
          
            
            $ci= Demandados::find( $idd)->CI;//cedula de demandado
            //DB INSERT
            //instancia de demanda
            $obdema=new Demanda();
            $obdema->fill(  $Newparams );
            $obdema->save();
            //ULTIMO ID GENERADO
            $ultimoIdGen=  $obdema->IDNRO;
            return view('demandas.msg_agregado', [  'ci'=> $ci, 'iddeman'=>$ultimoIdGen ]     ); 
        }
        else{
            if(  $idd!= 0){
                //datos para la vista 
                $qu= Demandados::find( $idd);
                if( is_null( $qu) ){  echo "Código inválido";
                }else{
                    $ci= $qu->CI;//cedula  
                    $nom=$qu->TITULAR;//nombre
                    return view('demandas.agregar', ['ci'=>  $ci ,'iddeman'=>$idd, 'nombre'=> $nom ]); 
                }
            }else{
                //Vista sin valores iniciales
               return view('demandas.agregar_nodata'); 
            }
            
        }
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