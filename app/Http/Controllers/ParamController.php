<?php

namespace App\Http\Controllers;

use App\Demanda;
use App\Http\Controllers\Controller;
use App\ODemanda;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   
use App\Parametros;
use Illuminate\Http\Client\Request as ClientRequest;

class ParamController extends Controller
{
    

    public function __construct()
    {
        date_default_timezone_set("America/Asuncion");
    }
   

    

public function index(){
 
        $params= Parametros::first();
        return view('parametros.index',  ["DATO"=> $params  ] );
} 




    
public function agregar( Request $request){
    if( ! strcasecmp(  $request->method() , "post"))  {//hay datos 
        //Quitar el campo _token
        $Params=  $request->input(); 
        //Devuelve todo elemento de Params que no este presente en el segundo argumento
        $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"] ),function($ar1, $ar2){
            if( $ar1 == $ar2) return 0;    else 1; 
         } ); 

         DB::beginTransaction();
        try{
             //VERIFICAR SI YA HAY UN REGISTRO
         if( sizeof( Parametros::get() ) > 0 ){
            //Actualizar
            $rw= Parametros::first()->update( $Newparams ); 
            echo json_encode( array('ok'=>  "ACTUALIZADO"  ));   
        }else{    
             $r= new Parametros(); 
             $r->fill(  $Newparams  );  
             $r->save();
             echo json_encode( array('ok'=>  "GUARDADO"  ));    
        }
        DB::commit();
       
        } catch (\Exception $e) {
            DB::rollback();
            echo json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos<br>$e") );
        }   
    }
    else  {    
        if( Parametros::get() > 0)  return view('parametros.index',  ['DATO'=>  Parametros::first() ] );
        else  return view('parametros.index');
       }/** */    
}
   

   
public function agregarOdemanda( Request $request){
    if( ! strcasecmp(  $request->method() , "post"))  {//hay datos 
        //Quitar el campo _token
        $Params=  $request->input(); 
        //Devuelve todo elemento de Params que no este presente en el segundo argumento
        $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"] ),function($ar1, $ar2){
            if( $ar1 == $ar2) return 0;    else 1; 
         } ); 

         DB::beginTransaction();
        try{
              
             $r= new ODemanda(); 
             $r->fill(  $Newparams  );  
             $r->save();
             echo json_encode( array('ok'=>  "GUARDADO"  ));    
            DB::commit();
       
        } catch (\Exception $e) {
            DB::rollback();
            echo json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos<br>$e") );
        }   
    }
    else  {   return view('parametros.index', ["OPERACION"=>"A" ]);
       }/** */    
}



public function editarOdemanda( Request $request, $id=0){
    if( ! strcasecmp(  $request->method() , "post"))  {//hay datos 
        //Quitar el campo _token
        $Params=  $request->input(); 
        //Devuelve todo elemento de Params que no este presente en el segundo argumento
        $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"] ),function($ar1, $ar2){
            if( $ar1 == $ar2) return 0;    else 1; 
         } ); 

         DB::beginTransaction();
        try{
              
             $r= ODemanda::find( $request->input("IDNRO") ); 
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
        $dato= ODemanda::find( $id );
        return view('parametros.form_odema' , ["DATO2"=> $dato , "OPERACION"=>"M"]  );
     }/** */    
 }


public function borrar( $id){
   if(  ODemanda::find($id)->delete() ) echo json_encode( array('ok'=>  "BORRADO"  ) );
   else json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos") );

}

public function listar_odema(){
    $ls= ODemanda::get();
    return view('parametros.grilla' , ["odemandas"=>  $ls]);
}


}