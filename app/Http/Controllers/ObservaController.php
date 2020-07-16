<?php

namespace App\Http\Controllers;

use App\Demanda;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use App\Demandados;

class ObservaController extends Controller
{
    

    public function __construct()
    {
        date_default_timezone_set("America/Asuncion");
    }
   


 
  
/**Nuevos datos de observacion */

public function agregar( Request $request, $iddeman){
    if( ! strcasecmp(  $request->method() , "post"))  {//hay datos
            
        //Quitar el campo _token
        $Params=  $request->input(); 

        //Devuelve todo elemento de Params que no este presente en el segundo argumento
        $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"] ),function($ar1, $ar2){
            if( $ar1 == $ar2) return 0;    else 1; 
         } ); 
         //insert to DB 
        $r= DB::table('obs_demanda')->insert(  $Newparams  );
        //obtener nombre de demandado a partir de idnro 
       
        $reg= Demanda::find( $iddeman);
        if( is_null($reg) ){
            echo "Código Inválido";
        }else{
            $ci= $reg->CI;
            $demanObj=  Demandados::where("CI", $ci)->first();
            $nom= $demanObj->TITULAR;
            return view('observaciones.msg_agregado', [ 'ci'=> $ci, 'nombre'=> $nom, 'iddeman'=>$iddeman ]     ); 
        }/** */
    }
    else
    {
        $demandao= new Demanda(); 
        $reg= $demandao->find( $iddeman);   
        if( is_null($reg) ){
            echo "Código Inválido";
        }else{
            $ci= $reg->CI;
            $demanObj= new Demandados(); 
            $nom= $demanObj->where("CI", $ci)->first()->TITULAR; 
            return view('observaciones.agregar',  [ 'ci'=> $ci, 'nombre'=> $nom, 'iddeman'=>$iddeman ]  ); }
        }/** */

      
}
   
     


 



}