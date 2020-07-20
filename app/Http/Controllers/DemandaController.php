<?php

namespace App\Http\Controllers;

use App\Demanda;
use App\Demandados;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

        $dts= DB::table("demandas2")
        ->join("demandado", "demandado.CI", "=", "demandas2.CI")
        ->select("demandado.CI", "demandado.TITULAR", "demandas2.*")
        ->get();
       // $dts = DB::select("select IDNRO,TITULAR,CI,DEMANDANTE,COD_EMP,CTA_BANCO,BANCO,GARANTE,CI_GARANTE from demandas2  order by TITULAR");
        return view('demandas.list', ['lista' => $dts, "odemanda" => $o_de]); 
    }

/**
 * LiSTA DE DEMANDAS POR ORIGEN
 */
    public function demandas_by_origen(  $origen){ 
 
       /* $dts = DB::select("select IDNRO,TITULAR,CI,DEMANDANTE,COD_EMP,CTA_BANCO,BANCO,GARANTE,CI_GARANTE from demandas where O_DEMANDA='$origen' order by TITULAR");
        return view('demandas2.list_tabla_demanda', ['lista' => $dts ]); */
    }


/**
 * LISTA DE DEMANDAS DE UNA PERSONA
 * 
 */

 public function demandas_by_ci($ci){
    $lista= Demanda::where("CI", $ci)->get();
    if(  sizeof( $lista) ){
        $persona= Demandados::where("ci", $ci)->first();//persona

        return view("demandado.list_demandas", ['lista'=>   $lista, 'ci'=>$ci, 'nombre'=> $persona->TITULAR] );
    }
    else{
        echo "No se registran demandas para el CI°  $ci"; 
    }

     
   
 }

/**
 * FICHA DE DEMANDA SEGUN COD_EMP
 */
    public function ficha_demanda(  $codemp){
        $data= DB::table("demandas")->where('cod_emp', $codemp)->first();
        return view("demandas.ficha_demanda", ['ficha'=>   $data] );
    }

    public function ficha_de_demanda(  $idnro){
        $data= Demanda::find( $idnro);
        $demanObj=  Demandados::where("CI", $data->CI)->first();
        $nom= $demanObj->TITULAR;
        return view("demandas.ficha_demanda", ['ficha'=>   $data, 'idnro'=>$idnro, 'nom'=>  $nom] );
    }

  /*
    NUEVA DEMANDA
    */

    public function show_form_nuevo( $id_d){//Id de demandado
        $qu= Demandados::find( $id_d);
        if( is_null( $qu) ){  echo "Código inválido";
        }else{
            $ci= $qu->CI;//cedula  
            $nom=$qu->TITULAR;//nombre
            return view('demandas.agregar.index', ['ci'=>  $ci ,'id_demandado'=>$id_d, 'nombre'=> $nom ]); 
        }
    }
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
          
            $demandado=Demandados::find( $idd);
            $ci= $demandado->CI;//cedula de demandado
            $nombre= $demandado->TITULAR;
            //DB INSERT
            //instancia de demanda
            $obdema=new Demanda();
            $obdema->fill(  $Newparams );
            if($obdema->save()){//exito
                //ULTIMO ID GENERADO
                $ultimoIdGen=  $obdema->IDNRO;
                //MENSAJE RESPUESTA JSON
                echo json_encode(array(  'ci'=> $ci, 'nombre'=> $nombre,'id_demanda'=>$ultimoIdGen  ));
                //return view('demandas.msg_agregado', [  'ci'=> $ci, 'nombre'=> $nombre,'id_demanda'=>$ultimoIdGen ]     ); 

            }else{
                //fallo
                echo json_encode(array(  'error'=> 'Un problema en el servidor impidió guardar los datos. Contacte con su desarrollador.' ));
               
            }
        }
        else{
            if(  $idd!= 0){//id de demandado 
                $qu= Demandados::find( $idd);
                if( is_null( $qu) ){  echo "Código inválido";
                }else{
                    $ci= $qu->CI;//cedula  
                    $nom=$qu->TITULAR;//nombre
                    return view('demandas.agregar.index', ['ci'=>  $ci ,'id_demandado'=>$idd, 'nombre'=> $nom ]); 
                }
            }else{
                //Vista sin valores iniciales
              // return view('demandas.agregar_nodata'); 
               return view('demandas.agregar.index'); 
            }
            
        }
    }

 
/**
 * EDITAR DEMANDA
 */
public function editar_demanda(Request $request, $iddeman=0){
    //instancia de demanda
    $obdema= Demanda::find( $iddeman);

    if( ! strcasecmp(  $request->method() , "post"))  {
        //Quitar el campo _token
        $Params=  $request->input(); 
        //Devuelve todo elemento de Params que no este presente en el segundo argumento
        $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"] ),function($ar1, $ar2){
            if( $ar1 == $ar2) return 0;    else 1; 
         } ); 
        //DB INSERT 
        $obdema->fill(  $Newparams );
        $obdema->save();
        //ULTIMO ID GENERADO
        $ci= $obdema->CI; 
        return view('demandas.msg_agregado', [  'ci'=> $ci, 'iddeman'=>$iddeman ]     ); 
    }
    else{
        if(  $iddeman!= 0){
            //datos para la vista 
            $qu= Demandados::where( "CI", $obdema->CI)->first();
            if( is_null( $qu) ){  echo "Código inválido";
            }else{
                $ci= $qu->CI;//cedula  
                $nom=$qu->TITULAR;//nombre
                return view('demandas.editar', ['ci'=>  $ci ,'iddeman'=>$iddeman, 'nombre'=> $nom , 'ficha'=>$obdema]); 
            }
        }else{
            //Vista sin valores iniciales
           return view('demandas.editar_nodata' , ['ci'=>  $obdema->CI ,'iddeman'=>$iddeman, 'nombre'=> $obdema->TITULAR, 'ficha'=>$obdema ]); 
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