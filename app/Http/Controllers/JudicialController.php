<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\CuentaJudicial;
use App\Demanda;
use App\Demandados;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB; 

class JudicialController extends Controller
{
    

    public function __construct()
    {
        date_default_timezone_set("America/Asuncion");
    }




    public function index( $iddeman){
        $demandaob=Demanda::find( $iddeman);
        //Datos pers
        $ci= $demandaob->CI;
        $nombre=  Demandados::where("CI", $ci)->first()->TITULAR; 
        //grilla de movimiento
        $movis=CuentaJudicial::where("CTA_JUDICI", $demandaob->CTA_BANCO)
       ->get();
        return view('cta_judicial.index',
         ["ci"=>$ci, "nombre"=> $nombre, "id_demanda"=> $iddeman,   "movi"=> $movis]); 
    }


   public function listar($iddeman){
        //grilla de movimiento
        $ob=Demanda::find( $iddeman);
        $movis=CuentaJudicial::where("CTA_JUDICI", $ob->CTA_BANCO )->get();
        return view('cta_judicial.grilla', ["movi"=>$movis] );
   }

    public function nuevo(Request $request, $iddeman=0){

        if( ! strcasecmp(  $request->method() , "post"))  {
               //Quitar el campo _token
               $Params=  $request->input(); 
               //Devuelve todo elemento de Params que no este presente en el segundo argumento
               $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"] ),function($ar1, $ar2){
                   if( $ar1 == $ar2) return 0;    else 1; 
                } ); 

           $cta= new CuentaJudicial();
           $cta->fill(  $Newparams);

           DB::beginTransaction();
           try {
            $cta->save(); 
             DB::commit();
             return view("cta_judicial.mensaje_success");
           } catch (\Exception $e) {
               DB::rollback();
               echo json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos<br>$e") );
           }  
        }
        else{
            $demandaob=Demanda::find( $iddeman);
            //Datos pers
            $ci= $demandaob->CI;
            $nombre=  Demandados::where("CI", $ci)->first()->TITULAR; 
            return view('cta_judicial.cargar', ["id_demanda"=>$iddeman, "CI"=>$ci, "TITULAR"=> $nombre, "dato"=> $demandaob, "OPERACION"=>"A"]); 
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

           $cta= CuentaJudicial::find( $idnro);
           $cta->fill(  $Newparams);
           DB::beginTransaction();
           try {
            $cta->save();
          /*
            if($cta->TIPO_MOVI == "D")
            {$obj_D=Demanda::find( $iddeman); $obj_D->SALDO=  intval($cta->SALDO)+intval($cta->IMPORTE);}
            */
         /*   if($cta->TIPO_MOVI == "E")
            {$obj_D=Demanda::find( $iddeman); $obj_D->SALDO=  intval($cta->SALDO)-intval($cta->IMPORTE);}
         */
             DB::commit();
             return view("cta_judicial.mensaje_success2", ["mensaje"=> "Movimiento actualizado"]);
           } catch (\Exception $e) {
               DB::rollback();
               echo json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos<br>$e") );
           }  
        }
        else{
            $ctaob=CuentaJudicial::find( $idnro);
            //Datos pers Filtrar
            $demandaObj= Demanda::where("CTA_BANCO", $ctaob->CTA_JUDICI)->first();
            $ci= $demandaObj->CI;
            $nombre= Demandados::where("CI", $ci)->first()->TITULAR; 
            $ctaob->CI= $ci;  $ctaob->TITULAR= $nombre; 
            return view('cta_judicial.cargar', ["id_demanda"=> $demandaObj->IDNRO,  "CI"=>$ci, "TITULAR"=> $nombre, "dato"=> $ctaob, "OPERACION"=>"M"]); 
        }

      
    }



    public function view( $idnro){
        $dat=CuentaJudicial::find(  $idnro);
        $demandaObj= Demanda::where("CTA_BANCO", $dat->CTA_JUDICI)->first();
        $ci= $demandaObj->CI;
        $nombre= Demandados::where("CI", $ci)->first()->TITULAR; 
        $dat->CI= $ci;  $dat->TITULAR= $nombre; 
        return view("cta_judicial.cargar", [ "dato"=> $dat, "OPERACION"=>"V", "id_demanda"=> $demandaObj->IDNRO] );
    }


    public function delete( $idnro){
        $dat=CuentaJudicial::find(  $idnro);
        $dat->delete();
        echo json_encode( array("idnro"=>  $idnro) );
      //  return view("cta_judicial.mensaje_success2", ["mensaje"=> "Movimiento borrado"]); 
    }


    public function ver_saldo_all( ){
        //SALDO JUDICIAL
        //monto de la demanda - extracciones
        $demanda_=Demanda::sum("DEMANDA");
        $SaldoJudicial=  intval($demanda_);
        $Extracciones=0;
        $mov_cta_jud=CuentaJudicial::where( "TIPO_MOVI", "E")->get();
        foreach( $mov_cta_jud as $it):
            if(  $it->TIPO_MOVI == "E") //extracciones
            $Extracciones+=  intval(  $it->IMPORTE);
        endforeach;
        $SaldoJudicial-= $Extracciones;
        // SALDO EN CUENTA
        //depositos - extracciones
        $Depositos=0; 
        foreach( $mov_cta_jud as $it):
            if(  $it->TIPO_MOVI == "D")
            $Depositos+=  intval(  $it->IMPORTE);
        endforeach;
        $SaldoEnCuenta= $Depositos - $Extracciones; 

        return array("saldo_judi"=> $SaldoJudicial, "saldo_en_c"=> $SaldoEnCuenta);
    }

    public function ver_saldo_array( $iddeman){
         //saldo judicial 
        //monto de la demanda - extracciones
        $demanda_=Demanda::find( $iddeman);
        $SaldoJudicial=  intval($demanda_->DEMANDA);
        $Extracciones=0;
        $dt=CuentaJudicial::where( "CTA_JUDICI", $demanda_->CTA_BANCO)->get();
        foreach( $dt as $it):
            if(  $it->TIPO_MOVI == "E")
            $Extracciones+=  intval(  $it->IMPORTE);
        endforeach;
        $SaldoJudicial-= $Extracciones;
        //saldo en cuenta
        //depositos - extracciones
        $Depositos=0; 
        foreach( $dt as $it):
            if(  $it->TIPO_MOVI == "D")
            $Depositos+=  intval(  $it->IMPORTE);
        endforeach;
        $SaldoEnCuenta= $Depositos - $Extracciones; 
        return array("saldo_judi"=> $SaldoJudicial, "saldo_en_c"=> $SaldoEnCuenta);
    }

    public function ver_saldo( $iddeman){
        echo json_encode(  $this->ver_saldo_array( $iddeman ));
    }


 




























  

 



    //************************************************************ */
    //depositos en la cta judicial
    /************************************************************** */
    public function deposito_en_cuenta()
    {

        $dts = DB::select('select d.CTA_BANCO,d.TITULAR,d.FECHA,d.IMPORTE from demandas de  join deposito d on de.CTA_BANCO=d.CTA_BANCO order by d.CTA_BANCO,de.CTA_BANCO');

        return view('cta_judicial.deposito_cuenta', ['lista' => $dts]); 
    }
//extracciones de la cta judicial
    public function extraccion_cuenta()
    {

        $dts = DB::select('select d.CTA_BANCO,d.TITULAR,d.FECHA,d.IMPORTE from demandas de  join deposito d on de.CTA_BANCO=d.CTA_BANCO order by d.CTA_BANCO,de.CTA_BANCO');

        return view('cta_judicial.extraccion_cuenta', ['lista' => $dts]); 
    }

     



}