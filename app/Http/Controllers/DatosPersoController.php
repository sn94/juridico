<?php

namespace App\Http\Controllers;

use App\Demandados;
use App\Http\Controllers\Controller;
use Exception;
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
    public function index(){
        $dmds= DB::table("demandado")->get(); 
          return view('demandado.list', ['lista' => $dmds]  ); 
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
            return view('demandado.msg_agregado', ['ci'=> $modelo->CI,  'lastid'=> $ultimoIdGen]); 
        }
        else  return view('demandado.agregar'); 
    }

 

  



}