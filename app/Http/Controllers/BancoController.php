<?php

namespace App\Http\Controllers;

use App\Arreglo_extrajudicial;
use App\Banc_mov;
use App\Bancos;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\pdf_gen\PDF;
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
        $MOVS = $dato->banc_mov;
        return view("bancos.movimientos",
         [ 'IDNRO'=>$IDNRO,'TITULAR'=>$Titular,'BANCO'=>$Bco,'CUENTA'=>$Cta,'LINK'=>url("lmovibank")."/$id",
         "dato"=> $MOVS]);        
    }




//tcpdf
//para clases css referenciarlas mediante comillas dobles
 
public function reporte( $idnro, $tipo="xls"){ 

    $Bank= Bancos::find(  $idnro);
    
    $Movi= $Bank->banc_mov; 
    
    if( $tipo == "xls"){
        echo json_encode(   $Movi );  
    }else{
        //Pdf format
        //Preparar variables que representan montos
         
        $html= <<<EOF
        <style>
            tr.cabecera{
                font-size: 7pt;
                background-color: #c2fcca;
                font-weight: bold;
            }
            table.tabla{ 
                border-top: 1px solid #606060;
                border-bottom: 1px solid #606060;
            }
            tr.cuerpo{
                color: #363636;
                font-size: 9px;
                font-weight: bold;
            }
            tr.cuerpo td{
                border-bottom: 1px solid #606060;
            }
            tr.pie td{ 
                color: #0f0f0f;
                font-weight: bold;
                font-size: 11px;
                border-bottom: 1px solid #606060;
            }
            .saldo-ok{
                color: #035009;
            }
            .saldo-rojo{
                color: #b80c07;
            }
            .numero{
                text-align: right;
            }
        </style>
        <h6>BANCO: {$Bank->BANCO},CUENTA N°: {$Bank->CUENTA}</h6>
        <table class="tabla">
        <thead>
        <tr class="cabecera"><th>FECHA</th><th>COMPROBANTE</th><th>DETALLE DE TRANS.</th><th>DÉBITO</th><th>CRÉDITO</th></tr>
        </thead>
        <tbody>
        EOF; 
       
        foreach( $Movi as $mo): 
            $debito= $mo->TIPO_MOV=="E" ?  $mo->IMPORTE : "*****"; 
            $credito=  $mo->TIPO_MOV=="D" ?  $mo->IMPORTE : "*****";
            //con formato
            $f_debito= Helper::number_f( $debito );
            $f_credito= Helper::number_f( $credito );
            
            $html.= "<tr class=\"cuerpo\"> <td>{$mo->FECHA}</td><td>{$mo->NUMERO}</td><td>{$mo->CONCEPTO}</td><td class=\"numero\">$f_debito</td><td class=\"numero\">$f_credito</td></tr> ";
        endforeach; 
        //Sumas y saldo
        $deb= $Movi->where("TIPO_MOV","E")->sum("IMPORTE");
        $cred= $Movi->where("TIPO_MOV","D")->sum("IMPORTE");
        //con formato
        $f_deb= Helper::number_f( $deb);
        $f_cred= Helper::number_f( $cred);

        $saldo= $cred - $deb;
        $f_saldo= Helper::number_f( $saldo );//con formato
        $tr_saldo='saldo-ok';
        if( $saldo < 0)  $tr_saldo="saldo-rojo"; 
        $html.= <<<EOF
        <tr class="pie"><td></td><td></td><td>SUMAS</td><td class="numero">$f_deb</td><td class="numero">$f_cred</td></tr>
        <tr><td></td><td></td><td></td><td class="numero">SALDO</td><td  class="$tr_saldo numero">$f_saldo</td></tr>
        </tbody></table>
        EOF;
         
        $tituloDocumento= "EXTRACTO-".date("d")."-".date("m")."-".date("yy")."-".rand();
        $pdf = new PDF(); 
        $pdf->prepararPdf("$tituloDocumento.pdf", $tituloDocumento, ""); 
        $pdf->generarHtml( $html);
        $pdf->generar();

    }//End pdf format option
     

}//End reporte function
 




//CODIGO DE COMPATIBILIDAD


public function  importar_registros(){


    //Obtener instancias de movimiento de cuenta
    //Actualizar el campo IDBANCO de los mismos
    $Bancos= Bancos::get();
    DB::beginTransaction();
    try{

        foreach($Bancos as $banco){
            $idnro=  $banco->IDNRO;
            $movs= Banc_mov::where("CUENTA", $banco->CUENTA)->get();
            foreach( $movs as $movimiento){
                $movimiento->IDBANCO= $idnro; 
                $val= $movimiento->save();
                
                echo "$val<br>";
            }
        }
        DB::commit();
    }catch (\Exception $e) {
        DB::rollback();
        echo json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos<br>$e") );
    } 
  

}




}
