<?php
 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
//use Illuminate\Routing\Route;
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
Route::get('/', "WelcomeController@index");
/*
Datos personales
*/
    /*************************LISTADO*****************/
Route::get("ldemandados", "DatosPersoController@index"); //lista datos personales
Route::get("ldemandados/{argumento}", "DatosPersoController@index"); //lista datos personales

Route::get("existe-ci/{ci}", "DatosPersoController@existe"); //existencia de Nro de CI
/****************************C R U D************** */
Route::get("ndemandado", "DatosPersoController@nuevo"); //Agregar datos personales
Route::post("ndemandado", "DatosPersoController@nuevo"); //Agregar datos personales
Route::get("vdemandado/{ci}", "DatosPersoController@view"); //vista datos personales
Route::get("edemandado/{idnro}", "DatosPersoController@editar"); //editar datos personales
Route::post("edemandado", "DatosPersoController@editar"); //editar datos personales
Route::get("ddemandado/{ci}", "DatosPersoController@borrar"); //Borrar datos personales
/**
 * Demandas
 */
/************************C R U D*************** */
Route::get( "demandas-agregar/{ci}", 'DemandaController@nueva_demandan');//nueva demanda para un Nro CI
Route::get( "demandas-agregar", 'DemandaController@nueva_demandan');//nueva demanda nuevo demandado
Route::post( "demandas-agregar", 'DemandaController@nueva_demandan');//nueva demanda nuevo demandado procesamiento
Route::get( "demandas-editar/{iddeman}", 'DemandaController@editar_demandan');//editar demanda
Route::post( "demandas-editar", 'DemandaController@editar_demandan');//editar demanda
Route::get( "demandas-borrar/{iddeman}", 'DemandaController@borrar');//Borrar demanda
Route::get("demandas-by-ci/{ci}", 'DemandaController@demandas_by_ci');//lista  de demandas por CEDULA
Route::get("ficha-demanda/{idnro}", "DemandaController@ver_demandan");//ficha de demandas
/**************LIQUIDACION********************* */
Route::get( "demandas-liquidar", 'DemandaController@liquidar');//liquidar demanda
//Route::get("ficha-demanda/{codemp}", "DemandaController@ficha_demanda");//ficha de demandas
Route::get("liquidaciones", 'DemandaController@demandas_p_liquidi');//lista de demandas para liquidacion
Route::get("liquida-by-o/{origen}", 'DemandaController@demandas_p_liquidi_b_o');//lista  de demandas para notif. por origen




/**
 * Notificacion-seguimiento
 */
 
Route::post("enotifi", "NotifiController@editar"); //nuevo seguimiento (notificacion)
Route::get("vnotifi/{iddeman}", "NotifiController@ficha"); //ficha de seguimiento (notificacion) individual
Route::get("dema-noti-venc", "NotifiController@notificaciones_venc");//lista de demandas con notificaciones vencidas
Route::get("proce-noti-venc", "NotifiController@procesar_notifi_venc");//procesar demandas con notificaciones vencidas


/**
 * Observacion
 */

 
Route::post("eobser", "ObservaController@editar"); //nueva observacion de demanda
Route::get("vobser/{iddeman}", "ObservaController@ficha"); //nueva observacion de demanda

/**CTA JUDICIAL */
Route::get("ctajudicial/{iddeman}", "JudicialController@index"); //con la grilla
Route::get("ncuentajudi/{iddeman}", "JudicialController@nuevo"); 
Route::post("ncuentajudi/{iddeman}", "JudicialController@nuevo"); 
Route::get("ecuentajudi/{idnro}", "JudicialController@editar"); 
Route::post("ecuentajudi/{idnro}", "JudicialController@editar"); 
Route::get("vcuentajudi/{idnro}", "JudicialController@view"); 
Route::get("dcuentajudi/{idnro}", "JudicialController@delete"); 
Route::get("lcuentajudi/{idnro}", "JudicialController@listar"); 
Route::get("calcsaldo/{iddeman}", "JudicialController@ver_saldo"); 


Route::get("nliquida/{iddeman}", "LiquidaController@nuevo"); 
Route::post("nliquida", "LiquidaController@nuevo"); 
Route::get("eliquida/{idnro}", "LiquidaController@editar"); 
Route::post("eliquida", "LiquidaController@editar"); 
Route::get("vliquida/{idnro}", "LiquidaController@view"); 
Route::get("dliquida/{idnro}", "LiquidaController@delete"); 
Route::get("lliquida/{iddeman}", "LiquidaController@list"); 
Route::get("liquida/{iddeman}", "LiquidaController@index"); 

Route::get("html_liquida/{idnro}", "LiquidaController@list_html"); //una liquidacion 
Route::get("jsonliquida/{idnro}", "LiquidaController@liquida_json"); //un solo reg. de liquid.
Route::get("pdfliquida/{idnro}", "LiquidaController@liquida_pdf"); //lista de liquidaciones en pdf
Route::get("pdflliquida/{iddeman}", "LiquidaController@list_pdf"); //list. de liquid. de una demanda en pdf


Route::get('auxiliar',   'AuxiController@index');
Route::get('auxiliar/{tabl}',   'AuxiController@index');
Route::post('nuevoaux',   'AuxiController@agregar');
Route::get('editaux/{tabl}/{idnro}',   'AuxiController@editar');
Route::get('delaux/{tabl}/{idnro}',   'AuxiController@borrar');
Route::post('editaux',   'AuxiController@editar');
Route::get('lauxiliar/{tabl}',   'AuxiController@list');



Route::get('params',   'ParamController@index');
Route::get('lparams',   'ParamController@listar_odema');
Route::get('nparam',   'ParamController@agregar');
Route::post('nparam',   'ParamController@agregar');
Route::get('nodema',   'ParamController@agregarOdemanda');
Route::post('nodema',   'ParamController@agregarOdemanda');
Route::get('eodema/{id}',   'ParamController@editarOdemanda');
Route::post('eodema',   'ParamController@editarOdemanda');
Route::get('dodema/{id}',   'ParamController@borrar');


Route::get('filtros',   'FilterController@index');
Route::get('nfiltro',   'FilterController@agregar');
Route::post('nfiltro',   'FilterController@agregar');
Route::get('efiltro/{id}',   'FilterController@editar');
Route::post('efiltro',   'FilterController@editar');


Route::get('users',   'UserController@index');
Route::get('new-user',   'UserController@agregar');
Route::post('new-user',   'UserController@agregar');
Route::get('edit-user/{idnro}',   'UserController@editar');
Route::post('edit-user',   'UserController@editar');
Route::get('del-user/{id}',   'UserController@borrar');
Route::get('list-user',   'UserController@list');






Route::get('test/{ci}',   'DemandaController@adjuntarSaldosDemanda');
 

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
