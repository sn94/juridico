<?php

namespace App\Http\Controllers;

use App\Bancos;
use App\Http\Controllers\Controller;
use Exception; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class BancoController extends Controller
{
    

    public function __construct()
    {
        date_default_timezone_set("America/Asuncion");
    }
  
    public function index(){
       // if ( $request->ajax() )
      
       $dato= Bancos::get();
       return view("bancos.index", ["movi"=>  $dato] );
       
    }



    public function agregar(Request $request){
        if( sizeof(  $request->all() )  > 0){
            $banco=new Bancos();
            $banco->fill( $request->input() );
            $banco->save();
            echo json_encode( array("ok"=> "CUENTA GUARDADA." )  );
        }else{
            return view("bancos.form", ['OPERACION'=>"A"]);
        }
       
    }

    public function editar(Request $request, $id){
        $d=Bancos::find($id);
        return view("bancos.form", ["dato"=> $d, 'OPERACION'=>"M"]);
    }


    public function borrar($idnro){
        $d=Bancos::find($idnro)->delete();
        echo json_encode( array("IDNRO"=> $idnro )  );
    }



    public function viewbanco(Request $request, $id){
        $dato= Bancos::find( $id);
        return view("bancos.movi", ["dato"=> $dato]);        
    }

    public function deposito(){

    }
}
