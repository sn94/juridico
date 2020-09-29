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
Route::get( "demandas-editar/{iddeman}/{tab}", 'DemandaController@editar_demandan');//editar demanda
Route::post( "demandas-editar", 'DemandaController@editar_demandan');//editar demanda
Route::get( "demandas-borrar/{iddeman}", 'DemandaController@borrar');//Borrar demanda
Route::get("demandas-by-ci/{ci}", 'DemandaController@demandas_by_ci');//lista  de demandas por CEDULA
Route::get("demandas-by-id/{idnro}", 'DemandaController@demandas_by_id');//lista  de demandas a traves de IDNRO
Route::get("ficha-demanda/{idnro}/{tab}", "DemandaController@ver_demandan");//ficha de demandas
Route::get("ficha-demanda/{idnro}", "DemandaController@ver_demandan");//ficha de demandas
Route::get("arregloextr-recibo/{idrecibo}", "ArregloExtrajudiController@mostrarRecibo");//recibo de pago extrajudicial
Route::post("honorarios", "DemandaController@honorarios");//ficha de demandas
Route::get("ver-recibos/{idarreglo}", "ArregloExtrajudiController@mostrarRecibos");//ficha de demandas

/***INTERVENCION CONTRAPARTE**** */
Route::post("contraparte/{idnro}", "DemandaController@contraparte"); 
Route::post("contraparte", "DemandaController@contraparte"); 




/**************LIQUIDACION********************* */
/*Route::get( "demandas-liquidar", 'DemandaController@liquidar');//liquidar demanda
//Route::get("ficha-demanda/{codemp}", "DemandaController@ficha_demanda");//ficha de demandas
Route::get("liquidaciones", 'DemandaController@demandas_p_liquidi');//lista de demandas para liquidacion
Route::get("liquida-by-o/{origen}", 'DemandaController@demandas_p_liquidi_b_o');//lista  de demandas para notif. por origen
*/



/**
 * Notificacion-seguimiento
 */
 
Route::post("enotifi", "NotifiController@editar"); //nuevo seguimiento (notificacion)
Route::get("vnotifi/{iddeman}", "NotifiController@ficha"); //ficha de seguimiento (notificacion) individual
Route::get("dema-noti-venc", "NotifiController@notificaciones_venc");//lista de demandas con notificaciones vencidas y no vencidas
Route::post("dema-noti-venc", "NotifiController@notificaciones_venc");//lista de demandas con notificaciones vencidas y no vencidas
Route::get("proce-noti-venc", "NotifiController@procesar_notifi_venc");//procesar demandas con notificaciones vencidas y no vencidas
Route::get("del-noti-venc", "NotifiController@borrar_noti_vencidas");//borrar notificaciones vencidas

//Route::get("create-notifi", "NotifiController@crear_notificaciones");//procesar demandas con notificaciones vencidas


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
Route::get("calcsaldo/{iddeman}/{tipo}", "JudicialController@saldo_C_y_L"); 

/**LIQUIDACION */
Route::get("nliquida/{iddeman}", "LiquidaController@nuevo"); 
Route::post("nliquida", "LiquidaController@nuevo"); 
Route::get("eliquida/{idnro}", "LiquidaController@editar"); 
Route::post("eliquida", "LiquidaController@editar"); 
Route::get("vliquida/{idnro}", "LiquidaController@view"); 
Route::get("dliquida/{idnro}", "LiquidaController@delete"); 
Route::get("lliquida/{iddeman}", "LiquidaController@list"); 
Route::get("liquida/{iddeman}", "LiquidaController@index"); 

Route::get("liquida/{idnro}/{tipo}", "LiquidaController@reporte"); //reporte xls o pdf de liquidacion




/** ** SUPERVISOR  */
Route::group(['middleware' => 'admin'], function () {


/***TABLAS AUXILIARES */
Route::get('auxiliar',   'AuxiController@index');
Route::get('auxiliar/{tabl}',   'AuxiController@index');
Route::post('nuevoaux',   'AuxiController@agregar');
Route::get('editaux/{tabl}/{idnro}',   'AuxiController@editar');
Route::get('delaux/{tabl}/{idnro}',   'AuxiController@borrar');
Route::post('editaux',   'AuxiController@editar');
Route::get('lauxiliar/{tabl}',   'AuxiController@list');
Route::get('res-aux/{tabl}',   'AuxiController@get');

/**  PARAMETROS** */
Route::get('params',   'ParamController@index');
Route::get('lparams',   'ParamController@listar_odema');
Route::get('nparam',   'ParamController@agregar');
Route::post('nparam',   'ParamController@agregar');
Route::get('nodema',   'ParamController@agregarOdemanda');
Route::post('nodema',   'ParamController@agregarOdemanda');
Route::get('eodema/{id}',   'ParamController@editarOdemanda');
Route::post('eodema',   'ParamController@editarOdemanda');
Route::get('dodema/{id}',   'ParamController@borrar');



/***FILTROS */
Route::get('filtros',   'FilterController@index');
Route::get('filtro-nombre/{id}',   'FilterController@get_name');
Route::get('nfiltro',   'FilterController@cargar');
Route::post('nfiltro',   'FilterController@cargar');
Route::get('efiltro/{tipo}/{id}',   'FilterController@cargar');
Route::post('efiltro/{tipo}',   'FilterController@cargar');
Route::get('dfiltro/{id}',   'FilterController@borrar');
Route::get('filtro/{id}/{tipo}/{givehtml}',   'FilterController@reporte');
Route::get('filtro/{id}/{tipo}',   'FilterController@reporte');
Route::get('filtro/{id}/{tipo}',   'FilterController@reporte');
Route::get('res-filtro/{tipo}',   'FilterController@get_parametros'); //Recursos de datos para crear filtros
Route::get('rel-filtro',   'FilterController@relaciones_filtro'); //Datos de relaciones para crear filtros
Route::get('filtro-aviso-rec/{id}',   'FilterController@aviso_recorte_cols');
Route::get('filtro-orden/{col}/{sentido}',   'FilterController@filtro_orden');
/*************************** */

/***USUARIOS */
Route::get('users',   'UserController@index');
Route::get('new-user',   'UserController@agregar');
Route::post('new-user',   'UserController@agregar');
Route::get('edit-user/{idnro}',   'UserController@editar');
Route::post('edit-user',   'UserController@editar');
Route::get('del-user/{id}',   'UserController@borrar');
Route::get('list-user',   'UserController@list');

}  );


Route::get('signin',   'UserController@sign_in');
Route::post('signin',   'UserController@sign_in');
Route::get('signout',   'UserController@sign_out'); 






/**         BANCOS          ** */
Route::get('bank',   'BancoController@index'); 
Route::get('bank-informes',   'BancoController@informes'); 
Route::post('bank-informes',   'BancoController@informes'); 
Route::get('bank-informes/{tipo}',   'BancoController@informes'); 
Route::post('bank-informes/{tipo}',   'BancoController@informes'); 
Route::get('nbank',   'BancoController@agregar'); 
Route::post('nbank',   'BancoController@agregar'); 
Route::get('ebank/{id}',   'BancoController@editar'); 
Route::post('ebank',   'BancoController@editar'); 
Route::get('emovibank/{id}',   'BancoController@editar_movimiento'); 
Route::post('emovibank',   'BancoController@editar_movimiento'); 
Route::get('dbank/{id}',   'BancoController@borrar'); 
Route::get('dmovibank/{id}',   'BancoController@borrar_movimiento'); 
Route::get('vbank/{id}',   'BancoController@ViewCtaBanco'); 
Route::get('lbank',   'BancoController@listar'); 
Route::get('lmovibank/{id}',   'BancoController@listar_movimiento'); //listar movimientos de una cuenta
Route::get('depobank/{id}',   'BancoController@deposito'); 
Route::post('depobank',   'BancoController@deposito'); 
Route::get('extrbank/{id}',   'BancoController@extraccion'); 
Route::post('extrbank',   'BancoController@extraccion'); 
Route::get('bank/{id}/{tipo}',   'BancoController@reporte'); //extracto



/* ***** ARREGLO EXTRAJUDICIAL  *********/
Route::post('arreglo_extra',   'ArregloExtrajudiController@agregar'); 




/**  GASTOS***** */
Route::get('gastos',   'GastosController@index'); 
Route::get('gasto',   'GastosController@cargar'); //insercion
Route::get('gasto/{tipo}/{id}',   'GastosController@cargar'); //edicion
Route::post('gasto',   'GastosController@cargar'); 
Route::post('gasto/{tipo}',   'GastosController@cargar'); 
Route::get('lgastos',   'GastosController@index'); 
Route::get('dgasto/{id}',   'GastosController@borrar'); //vista completa con grilla
Route::get('grillgastos',   'GastosController@listar'); //solo grilla
Route::post('grillgastos',   'GastosController@listar'); //solo grilla
Route::get('rep-gastos/{tipo}',   'GastosController@reporte'); //solo grilla
Route::post('rep-gastos/{tipo}',   'GastosController@reporte'); //solo grilla
Route::get('filtrar-gastos-codigo/{codigo}',   'GastosController@filtrarPorCodigo'); //solo grilla
Route::get('gast-orden/{col}/{sentido}',   'GastosController@ordenar'); //solo grilla
Route::get('demandas_n_gasto/{ci}',   'GastosController@demandas'); //busqueda de demandas por CEDULA

/**************PLAN DE CUENTAS DE GASTOS */
Route::get('plan-de-cuentas',   'PlanCtaGastoController@index'); 
Route::get('plan-cuenta',   'PlanCtaGastoController@cargar'); 
Route::post('plan-cuenta',   'PlanCtaGastoController@cargar'); 
Route::get('plan-cuenta/{tipo}/{id}',   'PlanCtaGastoController@cargar'); 
Route::post('plan-cuenta/{tipo}',   'PlanCtaGastoController@cargar'); 
Route::get('del-plan-cuenta/{id}',   'PlanCtaGastoController@borrar'); 
Route::get('plan-cuenta-list',   'PlanCtaGastoController@listar'); 
Route::get('plan-cuentas-rep/{tipo}',   'PlanCtaGastoController@reporte'); //Informes

//Mensajes
/********************** */
Route::get('messenger/{tipo}',   'MessengerController@index');  
Route::get('messenger',   'MessengerController@index');  
Route::get('nuevo-msg',   'MessengerController@agregar'); 
Route::post('nuevo-msg',   'MessengerController@agregar'); 
Route::get('ver-msg/{id}',   'MessengerController@ver'); 
Route::get('del-msg/{id}',   'MessengerController@borrar'); 
Route::get('list-msg/{TIPO}',   'MessengerController@listar'); 





/**MODULO INFORMES***** */
/********informes arreglos extrajudiciales*************** */
Route::get('informes-arre-extra',   'InformesController@informes_arr_extr');
Route::get('informes-arre-extra/{html}',   'InformesController@informes_arr_extr');
Route::post('informes-arre-extra',   'InformesController@informes_arr_extr');
Route::post('informes-arre-extra/{html}',   'InformesController@informes_arr_extr');
//version resumida
Route::get('informes-arregloextrajudicial',   'InformesController@informes_arreglos_resumen');
Route::get('informes-arregloextrajudicial/{html}',   'InformesController@informes_arreglos_resumen');
Route::post('informes-arregloextrajudicial',   'InformesController@informes_arreglos_resumen');
Route::post('informes-arregloextrajudicial/{html}',   'InformesController@informes_arreglos_resumen');
 
Route::get('informes-cuentajudicial',   'InformesController@informes_cuenta_judicial');
Route::get('informes-cuentajudicial/{html}',   'InformesController@informes_cuenta_judicial');
Route::post('informes-cuentajudicial',   'InformesController@informes_cuenta_judicial');
Route::post('informes-cuentajudicial/{html}',   'InformesController@informes_cuenta_judicial');
 


Route::get('test',   'ProduccionController@COMPATIBILIDAD_FECHA_BANCO');



 
