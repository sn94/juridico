<?php

namespace App\Http\Controllers;

use App\Demanda;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use App\Demandados;
use App\Observacion;

class ParamController extends Controller
{
    

    public function __construct()
    {
        date_default_timezone_set("America/Asuncion");
    }
   

    

public function index(){

    $lst= DB::table("parametros")->get();
    return view('parametros.index', ['lista'=> $lst] );    
}




    
public function agregar( Request $request){
    if( ! strcasecmp(  $request->method() , "post"))  {//hay datos 
        //Quitar el campo _token
        $Params=  $request->input(); 
        //Devuelve todo elemento de Params que no este presente en el segundo argumento
        $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"] ),function($ar1, $ar2){
            if( $ar1 == $ar2) return 0;    else 1; 
         } ); 
         //insert to DB 
        $r= DB::table('parametros')->insert(  $Newparams  ); 
        if( $r){
            echo json_encode( array('ok'=>  "GUARDADO"  ));   
        }else{
            echo json_encode( array('error'=>  "Un problema en el servidor impidió guardar los datos"  ));   
        }   
    }
    else  {   return view('parametros.form' );   }/** */    
}
   
     

public function borrar( $id){
    DB::table("parametros")->where("IDNRO", $id)->delete();

}



public function listar(){
    $ls= DB::table("parametros")->get();
    return view('parametros.grilla' , ["lista"=>  $ls]);
}




}