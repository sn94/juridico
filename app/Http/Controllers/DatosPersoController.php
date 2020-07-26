<?php

namespace App\Http\Controllers;

use App\Demanda;
use App\Demandados;
use App\Http\Controllers\Controller;
use App\Notificacion;
use App\Observacion;
use Exception;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class DatosPersoController extends Controller
{
    

    public function __construct()
    {
        date_default_timezone_set("America/Asuncion");
    }

/**
 * AGREGAR
 */
    public function index( Request $request, $argumento=""){
        /*$dmds= DB::table("demandado")->get(); 
          return view('demandado.list', ['lista' => $dmds]  ); 
          */
          //Con paginacion 
          $consulta= "";
          if(  $argumento != ""){
            $consulta= DB::table("demandado")
            ->selectRaw(" * ")
            ->whereRaw(" CI LIKE '%$argumento%' or  TITULAR LIKE '%$argumento%' or DOMICILIO LIKE '%$argumento%' OR TELEFONO LIKE '%$argumento%' ");  
          }else{
            $consulta= DB::table("demandado");
          }
         $dmds=  $consulta->paginate(20);
        $sqlq= $consulta->toSql();
         
        if(  $request->ajax()){
        return view('demandado.list_paginate_ajax', ['lista' => $dmds]  ); 
        }else
        return view('demandado.list_paginate', ['lista' => $dmds]  ); 
    }

 
/**
 * FICHA DE DATOS PERSONALES
 */
    public function view(  $ci){
        $data= DB::table("demandado")->where('CI', $ci)->first();
        return view("demandado.view", ['ficha'=>   $data] );
    }



  /*
    NUEVA DEMANDADO
    */
    public function nuevo(Request $request){
        if( ! strcasecmp(  $request->method() , "post"))  {
            //Quitar el campo _token
            $Params=  $request->input(); 
            //Devuelve todo elemento de Params que no este presente en el segundo argumento
            $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"] ),function($ar1, $ar2){
            if( $ar1 == $ar2) return 0;    else 1; 
            } ); 
            //insert to DB ELOQUENT VERSION
            $modelo= new Demandados();
            $modelo->fill( $Newparams );
            $modelo->save();
           $ultimoIdGen=  $modelo->IDNRO;
           
            /**generar registro en demanda, en notifi y en observacion */
            $deman= new Demanda();
            $deman->CI= $modelo->CI;
            if($deman->save()){
              $noti= new Notificacion();
              $noti->IDNRO= $deman->IDNRO;
              $noti->CI= $deman->CI;
              $noti->save();
              $obs= new Observacion();
              $obs->IDNRO= $deman->IDNRO;
              $obs->CI= $deman->CI;
              $obs->save();
            } 
            /** */
            echo json_encode( array( 'ci'=> $modelo->CI,  'nombre'=> $modelo->TITULAR) );
        }
        else  return view('demandado.agregar'); 
    }

 /**
  * EDITAR
  */
  public function editar(Request $request, $idnro){//idnro es CEDULA
    $modelo= Demandados::where( "CI", $idnro )->first();
    //Demandados::find( $idnro );
    if( ! strcasecmp(  $request->method() , "post"))  {
        //Quitar el campo _token
        $Params=  $request->input(); 
        //Devuelve todo elemento de Params que no este presente en el segundo argumento
        $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"] ),function($ar1, $ar2){
        if( $ar1 == $ar2) return 0;    else 1; 
        } ); 
        //update to DB ELOQUENT VERSION 
        $modelo->fill( $Newparams );
        if($modelo->save()){
          echo json_encode(array(  'ci'=> $idnro, 'nombre'=> $modelo->TITULAR  ));
        }else{
          echo json_encode(array(  'error'=> 'Un problema en el servidor impidió guardar los datos. Contacte con su desarrollador.' )); 
        } 
    }
    else  return view('demandas.agregarn.demandado_form',  ['ci'=> $modelo->CI,   'ficha'=> $modelo ] ); 
}

  



}