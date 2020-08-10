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

/**LISTA LIQUIDACIONES DE UNA DEMANDA ESPECIFICA  EN FORMATO JSON*/
public function list_json( $iddeman){
    $obj_demanda= Demanda::find(  $iddeman);
    $lista= Liquidacion::where("CTA_BANCO",  $obj_demanda->CTA_BANCO)->get();
   echo json_encode( $lista );
}

/**LISTA LIQUIDACIONES DE UNA DEMANDA ESPECIFICA EN FORMATO ARRAY*/
public function list_array( $iddeman){
    $obj_demanda= Demanda::find(  $iddeman);
    $lista= Liquidacion::where("CTA_BANCO",  $obj_demanda->CTA_BANCO)->get();
    return $lista;
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
 * INFORME EN HTML
 */
 public function list_html($idnro){
    $DATO=Liquidacion::find( $idnro); 
    return view("liquidaciones.rep_html", ["dato"=> $DATO] );
 }


/**
 * PDF FILES GENERATOR FUNCS
 */
 
     

public function liquida_pdf( $idnro){
    $DATO=  Liquidacion::find(  $idnro); 

    $html=<<<EOF
    <style>
    
    span{
        font-weight: bolder;
    }
    td{ text-align:left; }
    table.tabla{ 
        font-family: helvetica;
        font-size: 8pt; 
    }
    
     
     
    </style>
    
    <h6> {$DATO->TITULAR}</h6>
    <table class="tabla">
    <tbody>
    EOF;
  
    $html.="<tr> 
    <td style='text-align:left;'>
    <span>CAPITAL:</span> {$DATO->CAPITAL}<br><br>
    <span>ULT.PAGO:</span> {$DATO->ULT_PAGO}<br><br>
    <span>ULT.CHEQUE:</span> {$DATO->ULT_CHEQUE}<br><br>
    <span>CTA.MESES:</span> {$DATO->CTA_MESES}<br><br>
    <span>INT.P/MES:</span> {$DATO->INT_X_MES}<br><br>
    <span>IMP.INTERE.:</span> {$DATO->IMP_INTERE}<br><br>
    <span>I.V.A.:</span> {$DATO->IVA}
    </td>
    <td>
    <span>GAST.NOTIF.:</span> {$DATO->GAST_NOTIF}<br><br>
    <span>GAST.NOTIF.GTE.:</span> {$DATO->GAST_NOTIG}<br><br>
    <span>GAST.EMBARGO.:</span> {$DATO->GAST_EMBAR}<br><br>
    <span>GAST.INTIMAC.:</span> {$DATO->GAST_INTIM}<br><br>
    <span>%HONORARIOS:</span> {$DATO->HONO_PORCE}<br><br>
    <span>HONORARIOS.:</span> {$DATO->HONORARIOS}
    </td>
    <td>
    <span>FINIQUITO:</span> {$DATO->FINIQUITO}<br><br>
    <span>TOTAL:</span> {$DATO->TOTAL}<br><br>
    <span>IMP.EXTR.:</span> {$DATO->EXTRAIDO}<br><br>
    <span>SALDO:</span> {$DATO->SALDO}<br><br>
    <span>EXTR.LIQUID.:</span> {$DATO->EXT_LIQUID}<br><br>
    <span>NUEVO SALDO:</span> {$DATO->NEW_SALDO}
    </td> </tr>";
    
    $html.="</tbody> </table> ";
    /********* */

    $tituloDocumento= "LIQUIDACION-".date("d")."-".date("m")."-".date("yy")."-".rand();

       // $this->load->library("PDF"); 	
        $pdf = new PDF(); 
        $pdf->prepararPdf("$tituloDocumento.pdf", $tituloDocumento, ""); 
        $pdf->generarHtml( $html);
        $pdf->generar();
}

}