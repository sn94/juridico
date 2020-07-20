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
/*
Datos personales
*/
Route::get("ldemandados", "DatosPersoController@index"); //lista datos personales
Route::get("ndemandado", "DatosPersoController@nuevo"); //Agregar datos personales
Route::post("ndemandado", "DatosPersoController@nuevo"); //Agregar datos personales
Route::get("vdemandado/{ci}", "DatosPersoController@view"); //vista datos personales
Route::get("edemandado/{idnro}", "DatosPersoController@editar"); //editar datos personales
Route::post("edemandado/{idnro}", "DatosPersoController@editar"); //editar datos personales
/**
 * Demandas
 */
Route::get("demandas", 'DemandaController@demandas');//lista de demandas
Route::get("demandas-by-o/{origen}", 'DemandaController@demandas_by_origen');//lista de demandas por origen de demanda
Route::get( "demandas-agregar/{idd}", 'DemandaController@nueva_demanda');//nueva
Route::post( "demandas-agregar/{idd}", 'DemandaController@nueva_demanda');//nueva demanda
Route::get( "demandas-editar/{iddeman}", 'DemandaController@editar_demanda');//editar demanda
Route::post( "demandas-editar/{iddeman}", 'DemandaController@editar_demanda');//editar demanda
Route::get( "demandas-agregar", 'DemandaController@nueva_demanda');//nueva
Route::get( "demandas-liquidar", 'DemandaController@liquidar');//liquidar demanda
Route::get("ficha-demanda/{idnro}", "DemandaController@ficha_de_demanda");//ficha de demandas
//Route::get("ficha-demanda/{codemp}", "DemandaController@ficha_demanda");//ficha de demandas
Route::get("liquidaciones", 'DemandaController@demandas_p_liquidi');//lista de demandas para liquidacion
Route::get("liquida-by-o/{origen}", 'DemandaController@demandas_p_liquidi_b_o');//lista  de demandas para notif. por origen
Route::get("demandas-by-ci/{ci}", 'DemandaController@demandas_by_ci');//lista  de demandas por CEDULA



/**
 * Notificacion-seguimiento
 */
Route::get("nnotifi", "NotifiController@agregar"); //nuevo seguimiento (notificacion)
Route::post("nnotifi", "NotifiController@agregar"); //nuevo seguimiento (notificacion)
Route::get("nnotifi/{iddeman}", "NotifiController@agregar"); //nuevo seguimiento (notificacion)
Route::post("nnotifi/{iddeman}", "NotifiController@agregar"); //nuevo seguimiento (notificacion)
Route::get("enotifi/{iddeman}", "NotifiController@editar"); //nuevo seguimiento (notificacion)
Route::post("enotifi/{iddeman}", "NotifiController@editar"); //nuevo seguimiento (notificacion)
Route::get("vnotifi/{iddeman}", "NotifiController@ficha"); //ficha de seguimiento (notificacion) individual
Route::get("dema-noti-venc", "NotifiController@notificaciones_venc");//lista de demandas con notificaciones vencidas
Route::get("proce-noti-venc", "NotifiController@procesar_notifi_venc");//procesar demandas con notificaciones vencidas


/**
 * Observacion
 */
Route::get("nobser", "ObservaController@agregar"); //nueva observacion de demanda
Route::post("nobser", "ObservaController@agregar"); //nueva observacion de demanda
Route::get("nobser/{iddeman}", "ObservaController@agregar"); //nueva observacion de demanda
Route::post("nobser/{iddeman}", "ObservaController@agregar"); //nueva observacion de demanda
Route::get("eobser/{iddeman}", "ObservaController@editar"); //nueva observacion de demanda
Route::post("eobser/{iddeman}", "ObservaController@editar"); //nueva observacion de demanda
Route::get("vobser/{iddeman}", "ObservaController@ficha"); //nueva observacion de demanda

Route::get('test',  function(){
    return view("demandas.form");
});

Route::get('depcta', 'JudicialController@deposito_en_cuenta');
Route::get('extcta', 'JudicialController@extraccion_cuenta');
//Route::get('liquidaciones', 'JudicialController@liquidacion');