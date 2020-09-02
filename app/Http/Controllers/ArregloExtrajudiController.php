<?php

namespace App\Http\Controllers;

use App\Arreglo_extra_cuotas;
use App\Arreglo_extrajudicial;
use App\Banc_mov;
use App\Bancos;
use App\Http\Controllers\Controller;
use Exception; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class ArregloExtrajudiController extends Controller
{
    

    public function __construct()
    {
        date_default_timezone_set("America/Asuncion");
    }
  
     


    public function agregar(Request $request){
        if( sizeof(  $request->all() )  > 0){

            //Transaccion
            DB::beginTransaction();

            try{
                $cabecera=  array_filter(  $request->input(), 
                function( $key){
                   return $key != "DETALLE";
               },  ARRAY_FILTER_USE_KEY);
 
                $arr=  Arreglo_extrajudicial::find(  $request->input("IDNRO") ); //new Arreglo_extrajudicial();
                $arr->fill( $cabecera );
               $arr->save();
                //Registrar cuotas
                
                $detalle= $request->input("DETALLE"); 
                $arr->arreglo_extra_cuotas()->delete();//borrar cuotas
                for( $c=0;  $c< sizeof( $detalle['ARREGLO'] ) ; $c++){
                    //reiniciar
                    $cuo= new Arreglo_extra_cuotas();
                    $cuo->fill(  array( 'ARREGLO'=>  $detalle['ARREGLO'][$c],  'VENCIMIENTO'=>$detalle['VENCIMIENTO'][$c],
                    'IMPORTE'=>$detalle['IMPORTE'][$c] , 'FECHA_PAGO'=>  $detalle['FECHA_PAGO'][$c])   );
                    $cuo->save();  
                } 
                DB::commit();
                echo json_encode( array("ok"=> "CUENTA GUARDADA." )  );
            }catch( \Exception $e){
                DB::rollback();
                echo json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos<br>$e") );
            }
        }else{ 
            echo json_encode( array("error"=> "DATOS NO RECIBIDOS." )  );
        }
       
    }

 


  
    public function borrar($idnro){
        $d=Bancos::find($idnro)->delete();
        echo json_encode( array("IDNRO"=> $idnro )  );
    }


     
 
}
