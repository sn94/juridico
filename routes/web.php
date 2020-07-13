<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
$raiz="/juridico";
Route::get('/', function () {
    return view('welcome');
});

Route::get("demandas", 'DemandaController@demandas');//lista de demandas
Route::get("demandas-by-o/{origen}", 'DemandaController@demandas_by_origen');//lista de demandas por origen de demanda
Route::get( "demandas-agregar", 'DemandaController@nueva_demanda');//nueva
Route::post( "demandas-agregar", 'DemandaController@nueva_demanda');//nueva demanda
Route::get( "demandas-liquidar", 'DemandaController@liquidar');//liquidar demanda
Route::get("ficha-demanda/{codemp}", "DemandaController@ficha_demanda");//ficha de demandas
Route::get("liquidaciones", 'DemandaController@demandas_p_liquidi');//lista de demandas para liquidacion
Route::get("liquida-by-o/{origen}", 'DemandaController@demandas_p_liquidi_b_o');//lista  de demandas para notif. por origen

Route::get("dema-noti-venc", "NotifiController@notificaciones_venc");//lista de demandas con notificaciones vencidas
Route::get("proce-noti-venc", "NotifiController@procesar_notifi_venc");//procesar demandas con notificaciones vencidas



Route::get('test',  function(){
    return view("demandas.form");
});

Route::get('depcta', 'JudicialController@deposito_en_cuenta');
Route::get('extcta', 'JudicialController@extraccion_cuenta');
//Route::get('liquidaciones', 'JudicialController@liquidacion');