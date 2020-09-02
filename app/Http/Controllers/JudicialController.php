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
         //****************SALDO JUDICIAL ************
        //monto de la demanda - extracciones
        $demanda_=Demanda::find( $iddeman);  //Buscar demanda por su ID
        $SaldoJudicial=  intval($demanda_->DEMANDA);//Monto de la demanda
        $Extracciones=0;
        $dt=CuentaJudicial::where( "CTA_JUDICI", $demanda_->CTA_BANCO)->get();//Instancia de cta judicial de la demanda
        foreach( $dt as $it):
            if(  $it->TIPO_MOVI == "E") //Si es extraccion
            $Extracciones+=  intval(  $it->IMPORTE);
        endforeach;
        $SaldoJudicial-= $Extracciones; // Restar del monto de demanda las extracciones
        //***********SALDO EN CUENTA********** */
        //depositos - extracciones
        $Depositos=0; 
        foreach( $dt as $it):
            if(  $it->TIPO_MOVI == "D") //deposito
            $Depositos+=  intval(  $it->IMPORTE);
        endforeach;
        $SaldoEnCuenta= $Depositos - $Extracciones; //Restar de los depositos acumula. las extracciones ya calculadas
        return array("saldo_judi"=> $SaldoJudicial, "saldo_en_c"=> $SaldoEnCuenta);
    }

    public function ver_saldo( $iddeman){
        echo json_encode(  $this->ver_saldo_array( $iddeman ));
    }




//CALCULO DE SALDOS PARA UN JUICIO
//Saldo capital
// Saldo capital -  (Extracciones capital  )
//Saldo liquidacion - (extracciones liquidacion)

public function saldo_C_y_L(  $iddeman, $tipo="array" ){
      //monto de la demanda - extracciones
      $demanda_reg=Demanda::find( $iddeman);  //Buscar demanda por su ID
      $MontoDemanda=  intval($demanda_reg->DEMANDA);//Monto de la demanda
      //Consultar registro
      $liquidacion_reg=Liquidacion::where( "CTA_BANCO",  $demanda_reg->CTA_BANCO);
      $total_liquidaciones= 0;
      if( $liquidacion_reg )
      $total_liquidaciones=  intval(  $liquidacion_reg->sum("LIQUIDACIO") );

      //EXTRACCIONES
      $Extracciones_capital=0;
      $Extracciones_liquida=0;

    $cta_judi_reg=CuentaJudicial::where( "CTA_JUDICI", $demanda_reg->CTA_BANCO)->get();//Instancia de cta judicial de la demanda
    //Extracciones de capital    
    foreach( $cta_judi_reg as $it):
            if(  $it->TIPO_MOVI == "E"  &&  $it->TIPO_CTA == "C") //Si es extraccion CAPITAL
            $Extracciones_capital+=  intval(  $it->IMPORTE);
    endforeach;
      //Extracciones de liquidacion    
      foreach( $cta_judi_reg as $it):
        if(  $it->TIPO_MOVI == "E"  &&  $it->TIPO_CTA == "L") //Si es extraccion CAPITAL
        $Extracciones_liquida+=  intval(  $it->IMPORTE);
        endforeach;
  //Calculo de saldos
    //SALDO CAPITAL
    $saldo_capital= $MontoDemanda -  $Extracciones_capital;
    $saldo_liquida= $total_liquidaciones- $Extracciones_liquida;

     
    $data=array( "saldo_capital"=> $saldo_capital, "saldo_liquida"=> $saldo_liquida);
    if( $tipo== "array")
    return $data;
    if( $tipo== "json")
    echo json_encode($data);
}
 


public function saldos_C_y_L(){
$id_deman_list= Demanda::select('IDNRO')->get();
//Totalizar demandas
$total_demandas= Demanda::sum("DEMANDA");  
//Totalizar extracciones de capital
$total_extr_capital= CuentaJudicial::where("TIPO_CTA", "C")->where("TIPO_MOVI","E")->sum("IMPORTE");
//Saldo capital
$saldo_C= $total_extr_capital -  $total_demandas;

//Totalizar liquidaciones
$total_liquidaciones=  Notificacion::sum("IMPORT_LIQUI");
//tOTALIZAR extracciones de liquidacion
$total_extr_liquida= CuentaJudicial::where("TIPO_CTA", "L")->where("TIPO_MOVI","E")->sum("IMPORTE");
 //sALDO liquidacion
 $saldo_L=  $total_liquidaciones - $total_extr_liquida;

 return array( "saldo_capital"=> $saldo_C, "saldo_liquida"=> $saldo_L );
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