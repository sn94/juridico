<?php

namespace App\Http\Controllers;

use App\Demanda;
use App\Http\Controllers\Controller;
use App\ODemanda;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   
use App\Parametros;
use App\User;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    

    public function __construct()
    {
        date_default_timezone_set("America/Asuncion");
    }
   

    

public function index(){

        
        //Lista odemandas
        $lst_od= User::get(); 
        return view('auth.index',  ['users'=> $lst_od  , "OPERACION"=>"A"] );
} 




    
public function agregar( Request $request){
    if( ! strcasecmp(  $request->method() , "post"))  {//hay datos 
        //Quitar el campo _token
        $Params=  $request->input(); 
        //Devuelve todo elemento de Params que no este presente en el segundo argumento
        $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"] ),function($ar1, $ar2){
            if( $ar1 == $ar2) return 0;    else 1; 
         } ); 
         $Newparams['pass']= Hash::make($request->pass);
         DB::beginTransaction();
        try{     

            //hashing
            $request->pass= Hash::make($request->pass);
             $r= new User(); 
             $r->fill(  $Newparams  );  
             $r->save();
             echo json_encode( array('ok'=>  "GUARDADO"  ));    
        
        DB::commit();
       
        } catch (\Exception $e) {
            DB::rollback();
            echo json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos<br>$e") );
        }   
    }
    else  {   
        
        //Lista odemandas
        $lst_od= User::get();
        return view('auth.form' );
       }/** */    
}
   

   
 


public function editar( Request $request, $id=0){
    if( ! strcasecmp(  $request->method() , "post"))  {//hay datos 
        //Quitar el campo _token
        $Params=  $request->input(); 
        //Devuelve todo elemento de Params que no este presente en el segundo argumento
        $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"] ),function($ar1, $ar2){
            if( $ar1 == $ar2) return 0;    else 1; 
         } ); 

            //hashing
        $Newparams['pass']= Hash::make($request->pass);
         DB::beginTransaction();
        try{
            
             $r= User::find( $request->input("IDNRO") ); 
             $r->fill(  $Newparams  );  
             $r->save();
             echo json_encode( array('ok'=>  "ACTUALIZADO"  ));    
            DB::commit();
       
        } catch (\Exception $e) {
            DB::rollback();
            echo json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos<br>$e") );
        }   
    }
    else  {   
        $dato= User::find( $id );
        return view('auth.form' , ["DATO"=> $dato , "OPERACION"=>"M"]  );
     }/** */    
 }


public function borrar( $id){
   if(  User::find($id)->delete() ) echo json_encode( array('ok'=>  "BORRADO"  ) );
   else json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos") );

}

public function list(){
    $ls= User::get();
    return view('auth.grilla' , ["users"=>  $ls]);
}


}