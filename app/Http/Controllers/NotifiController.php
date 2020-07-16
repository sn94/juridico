<?php

namespace App\Http\Controllers;

use App\Demanda;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use App\Demandados;

class NotifiController extends Controller
{
    

    public function __construct()
    {
        date_default_timezone_set("America/Asuncion");
    }
   


 
  
/**Nuevos datos de seguimiento */

public function agregar( Request $request, $iddeman){
    if( ! strcasecmp(  $request->method() , "post"))  {//hay datos
            
        //Quitar el campo _token
        $Params=  $request->input(); 

        //Devuelve todo elemento de Params que no este presente en el segundo argumento
        $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"] ),function($ar1, $ar2){
            if( $ar1 == $ar2) return 0;    else 1; 
         } ); 
         //insert to DB 
        $r= DB::table('notificaciones')->insert(  $Newparams  );
        //obtener nombre de demandado a partir de idnro 
       
        $reg= Demanda::find( $iddeman);
        if( is_null($reg) ){
            echo "Código Inválido";
        }else{
            $ci= $reg->CI;
            $demanObj=  Demandados::where("CI", $ci)->first();
            $nom= $demanObj->TITULAR;
            return view('notificaciones.msg_agregado', [ 'ci'=> $ci, 'nombre'=> $nom, 'iddeman'=>$iddeman ]     ); 
        }/** */
    }
    else
    {
        $demandao= new Demanda(); 
        $reg= $demandao->find( $iddeman);   
        if( is_null($reg) ){
            echo "Código Inválido";
        }else{
            $ci= $reg->CI;
            $demanObj= new Demandados(); 
            $nom= $demanObj->where("CI", $ci)->first()->TITULAR; 
            return view('notificaciones.agregar',  [ 'ci'=> $ci, 'nombre'=> $nom, 'iddeman'=>$iddeman ]  ); }
        }/** */

      
}
    //*************************************************** */
    /***NOtificaciones vencidas*** */


    private function fecha_sgte( $fecha){
        
        $fechaformateada=  date_parse_from_format( "d/m/Y", $fecha);//un arreglo
       //convertir a segundos
        //strtotime recibe la fecha en formato Y-m-d
        $date1 = strtotime( $fechaformateada['year']."/".$fechaformateada['month']."/".$fechaformateada['day']  ); //fecha en seg 
        $fechasgte =  strtotime("+1 day", $date1);//fecha de notificacion mas 1 dia
        return $fechasgte;
    }
    private function es_notifi_vencida( $fech){
        /****DIAS PARA EL VENCIMIENTO */
        $dias_vtos= DB::table("diasvto")->get("dias")->first();; 
        $diavto= $dias_vtos->dias;//dias para el vencimiento
        $vencido_datos= array("vencido"=>false);
         /**VERIFICACION FECHA VALIDA */
        $fecha_demanda = date_create_from_format('j/m/Y',  trim( $fech ));  
        if( $fecha_demanda ){//Si la fecha convertida es valida  

            $i=1;
            while($i<= $diavto){ 
               $fechasgte= $this->fecha_sgte( $fech);
                //FECHA DE NOTIFICACION ES ANTERIOR O IGUAL A HOY, Y NO ES DOMINGO  NI SABADO
               if( $fechasgte <= time()  &&  date("N", $fechasgte)!=1 && date("N",$fechasgte)!=7  ){ 
                  
                 $vencido_datos= array("vencido"=> true, "fechavenci"=>  date("d-m-Y", $fechasgte) );
                $i= $diavto;//salir
               }//END IF
                 $i++; 
            }//END WHILE 
        }//END IF
        return $vencido_datos;
    }



    /*
    Procesar demandas con notificaciones vencidas
    */
    public function procesar_notifi_venc(){
        $demandas= DB::table("demandas") 
        ->where('arreglo_ex', '')
        ->where('embargo_n', '0')
        ->where('sd_finiqui', '0')
        ->get(); 
        foreach ($demandas as $it)
        {
            $fechaHoy= date("d/m/Y");
            $obs_notifi="";
            //Primer escenario
            if( ($this->es_notifi_vencida(  $it->NOTIFI_1 ) )['vencido']  &&  strlen($it->ADJ_AI) <= 1){//adjunto autointerlocutorio sin fecha
                $obs_notifi= "Adj. AI venció al ". ($this->es_notifi_vencida(  $it->NOTIFI_1 ))['fechavenci']; 
                
            }
            //Segundo Escenario
            if( ($this->es_notifi_vencida( $it->INTIMACI_2 ))['vencido'] &&  strlen($it->CITACION) <= 1){
                $obs_notifi= "Citación venció al ". ($this->es_notifi_vencida(  $it->INTIMACI_2))['fechavenci']; 
                
            }
            //Tercer escenario
            if( ($this->es_notifi_vencida( $it->NOTIFI_2 ))['vencido'] &&  strlen($it->ADJ_SD) <= 1){
                $obs_notifi= "Adj. SD. venció al ". ($this->es_notifi_vencida(  $it->NOTIFI_2))['fechavenci']; 
               
            }   
            //Cuarto escenario
            if( $it->SALDO <= 0  &&  strlen($it->ADJ_LIQUI) <= 1 ){
                $obs_notifi= "Adj. Liquid. Sin Fecha, saldo: ". $it->SALDO; 
               
            }
            //Quinto escenario
            if( ($this->es_notifi_vencida( $it->NOTIFI_4 ))['vencido'] &&  strlen($it->ADJ_APROBA) <= 1){
                $obs_notifi= "Adj. Aprob. venció al ". ($this->es_notifi_vencida(  $it->NOTIFI_4))['fechavenci']; 
             
            }  
            //Sexto escenario
            if( ($this->es_notifi_vencida( $it->NOTIFI_5 ))['vencido'] &&  strlen($it->ADJ_OFICIO) <= 1){
                $obs_notifi= "Adj. Oficio. venció al ". ($this->es_notifi_vencida(  $it->NOTIFI_5))['fechavenci']; 
            
            } 
            
            $Datos= array(
                "TITULAR"=> $it->TITULAR,"DEMANDANTE"=> $it->DEMANDANTE,"COD_EMP"=> $it->COD_EMP,
                "JUZGADO"=> $it->JUZGADO,"ACTUARIA"=> $it->ACTUARIA,"JUEZ"=> $it->JUEZ,"DEMANDA"=> $it->DEMANDA,
                "SALDO"=> $it->SALDO,"EMBARGO_NR"=> $it->EMBARGO_NR,"FEC_EMBARG"=> $it->FEC_EMBARG,
                "INSTITUCIO"=> $it->INSTITUCIO,"INST_TIPO"=> $it->INST_TIPO,"FECHA"=> $fechaHoy,"OBS"=> $obs_notifi
            );
            $est=DB::table("vtos")->insert( $Datos);
            var_dump($est);
        }//END FOREACH
       
    }
/**
 * Lista de demandas con fecha de  notificaciones vencidas
 */
    public function notificaciones_venc(){
        $vtos= DB::table("vtos")->get(); 
        return view('demandas.list_noti_venc', ['lista' => $vtos ]); 
    }


 



}