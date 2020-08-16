<?php

namespace App\Http\Controllers;

use App\CuentaJudicial;
use App\Demanda;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use App\Demandados;
use App\Liquidacion;
use App\Observacion;

class WelcomeController extends Controller
{
    

    public function __construct()
    { 

        date_default_timezone_set("America/Asuncion");
    }
   


    public function index(){
        $demanda= Demanda::sum("DEMANDA");  
        $judiob= new JudicialController();$judi= $judiob->ver_saldo_all();
        $saldo_c= CuentaJudicial::where("TIPO_CTA", "C")->where("TIPO_MOVI","E")->sum("IMPORTE");
        $saldo_l= CuentaJudicial::where("TIPO_CTA", "L")->where("TIPO_MOVI","E")->sum("IMPORTE");
        
        return view('welcome',  [
        "demanda"=>$demanda, //Demandas 
        "saldo_judi"=> intval($judi['saldo_judi']) < 0 ? "0": $judi['saldo_judi'] ,//Saldos
        "saldo_c"=> $saldo_c,//Saldo: Total de ext. de capital
        "saldo_l"=> $saldo_l //Saldo: Total de ext. de Liquidacion
        ]);

    }


  
  


}