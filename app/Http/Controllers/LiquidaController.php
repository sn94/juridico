<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\CuentaJudicial;
use App\Demanda;
use App\Demandados;
use App\Http\Controllers\Controller;
use App\Liquidacion;
use App\Notificacion;
use Exception;
use Illuminate\Support\Facades\DB; 
use App\pdf_gen\PDF;

class LiquidaController extends Controller
{
    

    public function __construct()
    {
        date_default_timezone_set("America/Asuncion");
    }




   
    public function index( $iddeman){
        $obj_demanda= Demanda::find(  $iddeman);
        $lista= Liquidacion::where("CTA_BANCO",  $obj_demanda->CTA_BANCO)->get();
        /**PARAMS */
        $ci= $obj_demanda->CI; 
        $nombre= Demandados::where("CI", $ci)->first()->TITULAR;
        $cta_bco= $obj_demanda->CTA_BANCO;
        return view("liquidaciones.index",
         ["lista"=> $lista ,"CI"=>$ci, "TITULAR"=> $nombre, "CTA_BANCO"=> $cta_bco, "id_demanda"=> $obj_demanda->IDNRO] );
    }

    public function nuevo(Request $request, $iddeman=0){

        if( ! strcasecmp(  $request->method() , "post"))  {
               //Quitar el campo _token
               $Params=  $request->input(); 
               //Devuelve todo elemento de Params que no este presente en el segundo argumento
               $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"] ),function($ar1, $ar2){
                   if( $ar1 == $ar2) return 0;    else 1; 
                } ); 
        
           $cta= new Liquidacion();
           $cta->fill(  $Newparams);
           DB::beginTransaction();
           try {
            $cta->save(); 
             DB::commit();
             return view("liquidaciones.success",  ["iddeman"=> $request->input("ID_DEMA"), "mensaje"=>"LIQUIDACION REGISTRADA"] );
           } catch (\Exception $e) {
               DB::rollback();
               echo json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos<br>$e") );
           }  
        }
        else{
            $demandaob=Demanda::find( $iddeman);
            //Recuperar datos de otras tablas
            $ci= $demandaob->CI;
            $nombre=  Demandados::where("CI", $ci)->first()->TITULAR; 
            $cta_bco= $demandaob->CTA_BANCO;
            $N=Notificacion::find( $iddeman);
            $sdf= $N->SD_FINIQUI;
            $fecf= $N->FEC_FINIQU;
            $judici= new JudicialController();
            $saldo_j= $judici->ver_saldo_array( $iddeman ); 
            return view('liquidaciones.cargar', 
            ["id_demanda"=>$iddeman, "CI"=>$ci, "TITULAR"=> $nombre, "CTA_BANCO"=> $cta_bco, 
            "SD_FINIQUI"=> $sdf,"FEC_FINIQU"=> $fecf, "CAPITAL"=> $demandaob->DEMANDA,
             "SALDO"=> $saldo_j['saldo_judi'] , "OPERACION"=>"A"]); 
        } 
    }



    
    public function editar(Request $request, $idnro=0){

        if( ! strcasecmp(  $request->method() , "post"))  {
               //Quitar el campo _token
               $Params=  $request->input(); 
               //Devuelve todo elemento de Params que no este presente en el segundo argumento
               $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"] ),function($ar1, $ar2){
                   if( $ar1 == $ar2) return 0;    else 1; 
                } ); 
                
           $cta= Liquidacion::find( $request->input("IDNRO") );
           $cta->fill(  $Newparams);
           DB::beginTransaction();
           try {
            $cta->save(); 
             DB::commit();
             return view("liquidaciones.success", ["mensaje"=>"LIQUIDACION ACTUALIZADA"]);
           } catch (\Exception $e) {
               DB::rollback();
               echo json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos<br>$e") );
           }  
        }
        else{
            $liqui= Liquidacion::find($idnro);
            $iddeman= Liquidacion::find( $idnro )->ID_DEMA;// ANALIZAR
            $demandaob=Demanda::where( "CTA_BANCO", $liqui->CTA_BANCO)->first();  $ci= $demandaob->CI; 
           /* $N=Notificacion::find( $iddeman);
            $sdf= $N->SD_FINIQUI;
            $fecf= $N->FEC_FINIQU;*/
            return view('liquidaciones.cargar', 
            ["id_demanda"=>$demandaob->IDNRO, "CI"=>$ci,   "CAPITAL"=> $demandaob->DEMANDA, "dato"=> $liqui , "OPERACION"=>"M"]); 
        } 
    }



    public function view( $idnro){
        $liqui= Liquidacion::find($idnro);
        $objLiqui= Liquidacion::find( $idnro );
        $demandaob=Demanda::where("CTA_BANCO", $objLiqui->CTA_BANCO)->first();  $ci= $demandaob->CI; 
        $N=Notificacion::find( $demandaob->IDNRO);
        $sdf= $N->SD_FINIQUI;
        $fecf= $N->FEC_FINIQU;
        return view('liquidaciones.cargar', 
        ["id_demanda"=>$demandaob->IDNRO, "CI"=>$ci,  "SD_FINIQUI"=> $sdf,"FEC_FINIQU"=> $fecf,
         "CAPITAL"=> $demandaob->DEMANDA, "dato"=> $liqui , "OPERACION"=>"V"]); 
    }
public function list( $iddeman){
    $obj_demanda= Demanda::find(  $iddeman);
    $lista= Liquidacion::where("CTA_BANCO",  $obj_demanda->CTA_BANCO)->get();
    return view("liquidaciones.grilla", ["lista"=> $lista] );
}

public function list_json( $iddeman){
    $obj_demanda= Demanda::find(  $iddeman);
    $lista= Liquidacion::where("CTA_BANCO",  $obj_demanda->CTA_BANCO)->get();
   echo json_encode( $lista );
}

public function liquida_json( $idnro){
    $obj_= Liquidacion::find(  $idnro);
     
   echo json_encode( array( "0"=> $obj_) );
}



    public function delete( $idnro){
        $dat=Liquidacion::find(  $idnro);
        $dat->delete();
        echo json_encode( array("idnro"=>  $idnro) );
      //  return view("cta_judicial.mensaje_success2", ["mensaje"=> "Movimiento borrado"]); 
    }



 

/**
 * PDF FILES GENERATOR FUNCS
 */
 
     

public function list_pdf(){
    

    $html=<<<EOF
    <style>
    table.cabecera{
        font-size:11px;  
    }
    span{
        font-weight: bolder;
    }
    table.tabla{
        color: #003300;
        font-family: helvetica;
        font-size: 8pt;
        border-left: 3px solid #777777;
        border-right: 3px solid #777777;
        border-top: 3px solid #777777;
        border-bottom: 3px solid #777777;
        background-color: #ddddff;
    }
    
    tr.header{
        background-color: #ccccff; 
        font-weight: bold;
    } 
    tr{
        background-color: #ddeeff;
        border-bottom: 1px solid #000000; 
    }
    tr.success{
        background-color: #aaffaa;
        border-bottom: 1px solid #000000; 
    }
    tr.pending{
        background-color: #888888;
        border-bottom: 1px solid #000000; 
    }
    tr.danger{
        background-color: #ffaaaaa;
        border-bottom: 1px solid #000000; 
    }
    </style>
    <table class="cabecera">
    <tbody>
    <tr> <td> </td> <td> </td> <td> </td> </tr>
    </tbody>
    </table>
    <h6></h6>
    <table class="tabla">
    <thead >
    <tr class="header">
    <td>Cedula</td>
    <td>Nombre completo</td>
    <td>Telefono</td>
    </tr>
    </thead>
    <tbody>
    EOF;
    $DATO= Liquidacion::get();
    foreach( $DATO as $row){
        $nombres= $row->nombres." ".$row->apellidos;
        $estado= ($row->estado =="P" )? "PENDIENTE": ($row->estado =="A" ? "APROBADO":"RECHAZADO") ;
        
        $html.="<tr> <td>{$row->CTA_BANCO}</td> <td>{$row->ULT_PAGO}</td> <td>{$row->CAPITAL}</td> </tr>";
    }
    $html.="</tbody> </table> ";
    /********* */

    $tituloDocumento= "LIQUIDA-".date("d")."-".date("m")."-".date("yy")."-".rand();

       // $this->load->library("PDF"); 	
        $pdf = new PDF(); 
        $pdf->prepararPdf("$tituloDocumento.pdf", $tituloDocumento, ""); 
        $pdf->generarHtml( $html);
        $pdf->generar();
}

}