<?php

namespace App\Http\Controllers;

use App\Demanda;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use App\Demandados;
use App\Observacion;

class WelcomeController extends Controller
{
    

    public function __construct()
    {
        date_default_timezone_set("America/Asuncion");
    }
   


    public function index(){
        $demanda=Demanda::count();
        $demndado= Demandados::count();
        $notiven= DB::table("vtos")->count();
        $judiob= new JudicialController();
        $judi= $judiob->ver_saldo_all();
        return view('welcome', 
        ["demandado"=> $demndado, 
        "demanda"=>$demanda, 
        "notiven"=>$notiven, 
        "saldo_judi"=> $judi['saldo_judi'],
         "saldo_n_c"=> $judi['saldo_en_c']]);

    }


  
  


}