<?php

namespace App\Http\Controllers;

use App\Demanda;
use App\Http\Controllers\Controller;
use App\Messenger;
use App\ODemanda;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   
use App\Parametros;
use App\User;
use Illuminate\Http\Client\Request as ClientRequest;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class MessengerController extends Controller
{
    

    public function __construct()
    {
        date_default_timezone_set("America/Asuncion");
    }
   

    

public function index(){
 
        $params= Messenger::get();
        $url_listado=url("list-msg/R");
        return view('messenger.index',  ["lista"=> $params , "url_listado"=>$url_listado ] );
} 




    
public function agregar( Request $request){
    if( ! strcasecmp(  $request->method() , "post"))  {//hay datos 
        //Quitar el campo _token
        $Params=  $request->input();      
        $r= new Messenger(); 
        $r->fill(  $Params  );  
        if($r->save())
             echo json_encode( array('ok'=>  "ENVIADO"  ));    
        else
        echo json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos<br>") );
        
    }
    else  { 
        //Listar usuarios
        $usuarios= User::where("IDNRO","<>", session("id") )->pluck('NICK', 'IDNRO');//
        return view('messenger.form', ['usuarios'=> $usuarios ] ); 
       }
}
   

    

 

public function borrar( $id){
   if(  Messenger::find($id)->delete() ) echo json_encode( array('IDNRO'=>  $id  ) );
   else json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos") );

}

public function listar( Request $request, $tipo="E"){
    
    $ls= NULL;
    $id= session("id");
    //enviados
    if( $tipo == "E")
    $ls= Messenger::where("REMITENTE", $id)->get();
    if( $tipo == "R")
    $ls= Messenger::where("DESTINATARIO", $id)->get();
    if( $request->ajax())
    return view('messenger.grilla' , ["lista"=>  $ls]);
    else {
        $url_listado=url("list-msg/".session("id")."/R");
        return view('messenger.index' , ["lista"=>  $ls, "url_listado"=>$url_listado ]);
    }
}



public static function mensajesRecibidos(){
   return  ! is_null(Messenger::where("DESTINATARIO",  session("id") )->get() );
}

}