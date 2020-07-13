<?php

namespace App\Http\Controllers;

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
        
    }


}