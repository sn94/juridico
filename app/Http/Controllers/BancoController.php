<?php

namespace App\Http\Controllers;

use App\Banc_mov;
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
            return view("bancos.form", ['OPERACION'=>"A", 'RUTA'=>url("nbank")]);
        }
       
    }

    public function editar(Request $request, $id=0){
        if( sizeof(  $request->all() )  > 0){
            $banco=Bancos::find( $request->input("IDNRO" ) );
            $banco->fill( $request->input() );
            $banco->save();
            echo json_encode( array("ok"=> "CUENTA ACTUALIZADA." )  );
        }
        else{
            $d=Bancos::find($id);
            return view("bancos.form", ["dato"=> $d, 'OPERACION'=>"M", 'RUTA'=>url("ebank")]);
        }
    }


    public function editar_movimiento(Request $request, $id=0){
        if( sizeof(  $request->all() )  > 0){
            $banco=Banc_mov::find( $request->input("IDNRO" ) );
            $banco->fill( $request->input() );
            $banco->save();
            echo json_encode( array("ok"=> "ACTUALIZADO." )  );
        }
        else{
            $d=Banc_mov::find($id);
            return view("bancos.form_movi",
             ["dato"=> $d,'TIPO_MOV'=>$d->TIPO_MOV,"TITULAR"=>$d->TITULAR,"CUENTA"=>$d->CUENTA,
             'BANCO'=>$d->BANCO,  'OPERACION'=>"M", 'RUTA'=>url("emovibank")]);
        }
    }

    public function borrar($idnro){
        $d=Bancos::find($idnro)->delete();
        echo json_encode( array("IDNRO"=> $idnro )  );
    }


    public function borrar_movimiento($idnro){
        $d=Banc_mov::find($idnro)->delete();
        echo json_encode( array("IDNRO"=> $idnro )  );
    }

  


    public function listar(){
        $dato=Bancos::all();
        return view("bancos.grilla", ["movi"=> $dato]);   
    }

    public function listar_movimiento(){
         //Consultar depositos y extracciones
         $SQL="SELECT ctasban_mov.*,ctas_banco.CUENTA,ctas_banco.TITULAR FROM ctas_banco,ctasban_mov where ctas_banco.CUENTA=ctasban_mov.CUENTA AND ctas_banco.BANCO=ctasban_mov.BANCO";
         $MOVS = DB::select( $SQL) ;
         return view("bancos.grilla_mov", ["dato"=> $MOVS] );
    }

    public function deposito(Request $request, $idnro=0){
        if( sizeof(  $request->all() )  > 0){

            DB::beginTransaction();
            try { 
                $dep=new Banc_mov();
                $dep->fill( $request->input());
                $dep->save(); 
                //Modificar saldo
                $Cta= $request->input("CUENTA");
                $Banc=Bancos::where("CUENTA", $Cta)->first();
                $Banc->SALDO= intval( $Banc->SALDO) + intval( $request->input("IMPORTE") );
                $Banc->save();
                DB::commit();
               echo json_encode( array( "ok"=>"DEPÓSITO REGISTRADO") );
             } catch (\Exception $e) {
                 DB::rollback();
                 echo json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos<br>$e") );
             } 
            /**end transac */
        }
        else{
            $b=Bancos::find($idnro);
            return view("bancos.form_movi", 
            ["TITULAR"=>$b->TITULAR,"CUENTA"=>$b->CUENTA,'BANCO'=>$b->BANCO,'TIPO_MOV'=>"D", 'RUTA'=> url("depobank") ]);
        }   
    }





    public function extraccion(Request $request, $idnro=0){
        if( sizeof(  $request->all() )  > 0){

            DB::beginTransaction();
            try { 
                $ex=new Banc_mov();
                $ex->fill( $request->input());
                $ex->save(); 
                //Modificar saldo
                $Cta= $request->input("CUENTA");
                $Banc=Bancos::where("CUENTA", $Cta)->first();
                $Banc->SALDO= intval( $Banc->SALDO) - intval( $request->input("IMPORTE") );
                $Banc->save();
                DB::commit();
               echo json_encode( array( "ok"=>"EXTRACCIÓN REGISTRADA") );
             } catch (\Exception $e) {
                 DB::rollback();
                 echo json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos<br>$e") );
             } 
            /**end transac */
        }
        else{
            $b=Bancos::find($idnro);
            return view("bancos.form_movi", 
            ["TITULAR"=>$b->TITULAR,"CUENTA"=>$b->CUENTA,'BANCO'=>$b->BANCO,'TIPO_MOV'=>"E", 'RUTA'=> url("extrbank") ]);
        }   
    }


    public function ViewCtaBanco( $id ){
        $dato= Bancos::find( $id);
        $IDNRO= $dato->IDNRO;
        $Cta= $dato->CUENTA;
        $Bco= $dato->BANCO;
        $Titular= $dato->TITULAR;

        //Consultar depositos y extracciones
        $SQL="SELECT ctasban_mov.*,ctas_banco.CUENTA,ctas_banco.TITULAR FROM ctas_banco,ctasban_mov where ctas_banco.CUENTA=ctasban_mov.CUENTA AND ctas_banco.BANCO=ctasban_mov.BANCO";
        $MOVS = DB::select( $SQL) ;
        return view("bancos.movimientos",
         [ 'IDNRO'=>$IDNRO,'TITULAR'=>$Titular,'BANCO'=>$Bco,'CUENTA'=>$Cta,'LINK'=>url("lmovibank")."/$id",
         "dato"=> $MOVS]);        
    }

}
