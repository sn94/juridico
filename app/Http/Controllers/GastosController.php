<?php

namespace App\Http\Controllers;

use App\Arreglo_extrajudicial;
use App\Banc_mov;
use App\Bancos;
use App\Gastos;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\pdf_gen\PDF;
use Exception; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class GastosController extends Controller
{
    

    public function __construct()
    {
        date_default_timezone_set("America/Asuncion");
    }
  
    public function index(){
       // if ( $request->ajax() )
      
       $dato= Gastos::paginate(20);
       return view("gastos.index", ["movi"=>  $dato, "TITULO"=>"GASTOS"] );
       
    }



    public function cargar(Request $request, $ope= "A", $id=""){
        
        if( sizeof(  $request->all() )  > 0){
            $banco=null;
            if( $ope == "A")   $banco=new Gastos();
            if( $ope == "M")   $banco= Gastos::find(  $request->input("IDNRO" )  );
            $banco->fill( $request->input() );
            $banco->save();
            $mensaje= ( $ope == "A") ?  "SE CARGÓ UN GASTO." : "GASTO EDITADO";
            echo json_encode( array("ok"=> $mensaje )  );

        }else{
            //Preparar parametros
            //Lista de codigo de gastos
            $cod_gastos=DB::table("cod_gasto")->pluck( 'DESCRIPCION', 'IDNRO');
            $ruta=   $ope == "A" ? url("gasto")  :  url("gasto/M");
            if( $ope == "A")    
            return view("gastos.form",   ['OPERACION'=> $ope,   'RUTA'=> $ruta,   'CODGASTO' => $cod_gastos  ]);
            if( $ope == "M") {
                $banco= Gastos::find( $id);
                return view("gastos.form",   ['OPERACION'=> $ope,   'RUTA'=> $ruta,   'CODGASTO' => $cod_gastos ,'dato'=>$banco ]);
            }
        }
    }

     
    

    public function borrar($idnro){
        $d=     Gastos::find($idnro)->delete();
        echo json_encode( array("IDNRO"=> $idnro )  );
    }


 
  


    public function listar( Request $request){  
        $dato= null;
        if( ! strcasecmp(  $request->method() , "post"))  {
            $desde= $request->input("Desde");
            $hasta= $request->input("Hasta"); 
            $dato=Gastos::where("FECHA", ">=", $desde)->where("FECHA", "<=", $hasta)->paginate(20);    
          
        }
        else{  $dato= Gastos::paginate(20);    }
        return view("gastos.grilla", ["movi"=>  $dato] );

    }

  




//tcpdf
//para clases css referenciarlas mediante comillas dobles
 
public function reporte(  $tipo="xls"){ 

    $Movi= Gastos::get(); 
    
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
            .numero{
                text-align: right;
            }
        </style>
        <h6>GASTOS</h6>
        <table class="tabla">
        <thead>
        <tr class="cabecera"><th>FECHA</th><th>COMPROBANTE</th><th>DETALLES</th><th>IMPORTE</th></tr>
        </thead>
        <tbody>
        EOF; 
       
        foreach( $Movi as $mo): 
            //con formato
            $f_MONTO= Helper::number_f( $mo->IMPORTE ); 
            
            $html.= "<tr class=\"cuerpo\"> <td>{$mo->FECHA}</td><td>{$mo->NUMERO}</td><td>{$mo->DETALLE1}<br>{$mo->DETALLE2}</td><td  class=\"numero\">{$f_MONTO}</td></tr> ";
        endforeach;  
        $total= $Movi->sum("IMPORTE"); 
        //con formato
        $f_total= Helper::number_f( $total); 
    
        $html.= <<<EOF
        <tr class="pie"><td></td><td></td><td>TOTAL</td><td class="numero">$f_total</td></tr> 
        </tbody></table>
        EOF;
         
        $tituloDocumento= "GASTOS-".date("d")."-".date("m")."-".date("yy")."-".rand();
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
