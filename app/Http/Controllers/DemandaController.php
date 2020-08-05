<?php

namespace App\Http\Controllers;

use App\Demanda;
use App\Demandados;
use App\Http\Controllers\Controller;
use App\Notificacion;
use App\Observacion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB; 

class DemandaController extends Controller
{
    

    public function __construct()
    {
        date_default_timezone_set("America/Asuncion");
    }

/****
 * DEMANDAS
 * 
 */
/**
 * Listado de demandas
 * *
 * */
    public function demandas(){
        $o_de= DB::table("odemanda")->get();

        $dts= DB::table("demandas2")
        ->join("demandado", "demandado.CI", "=", "demandas2.CI")
        ->select("demandado.CI", "demandado.TITULAR", "demandas2.*")
        ->get();
       // $dts = DB::select("select IDNRO,TITULAR,CI,DEMANDANTE,COD_EMP,CTA_BANCO,BANCO,GARANTE,CI_GARANTE from demandas2  order by TITULAR");
        return view('demandas.list', ['lista' => $dts, "odemanda" => $o_de]); 
    }

/**
 * LiSTA DE DEMANDAS POR ORIGEN
 */
    public function demandas_by_origen(  $origen){ 
 
       /* $dts = DB::select("select IDNRO,TITULAR,CI,DEMANDANTE,COD_EMP,CTA_BANCO,BANCO,GARANTE,CI_GARANTE from demandas where O_DEMANDA='$origen' order by TITULAR");
        return view('demandas2.list_tabla_demanda', ['lista' => $dts ]); */
    }


/**
 * LISTA DE DEMANDAS DE UNA PERSONA
 * 
 */
 
 public function adjuntarSaldosDemanda( $ci){
    $judi=new JudicialController();
    $lst= Demanda::where("CI", $ci)->orderBy("IDNRO")->get();
    $n_lst= array();
    foreach( $lst as $it){
        $idn= $it->IDNRO;
        $arr= $judi->ver_saldo_array( $idn);
        $arr['IDNRO']= $idn;
       array_push( $n_lst, $arr);

    }
 return $n_lst; 
 }
 public function demandas_by_ci($ci){
  
    $lista= DB::table("demandas2")
    ->join("notificaciones", "notificaciones.IDNRO", "=", "demandas2.IDNRO")
    ->select("demandas2.*", "notificaciones.PRESENTADO", "notificaciones.SD_FINIQUI", "notificaciones.FEC_FINIQU")
    ->where("demandas2.CI", $ci)
    ->orderBy("demandas2.IDNRO")
    ->get();
 
       $persona= Demandados::where("ci", $ci)->first();//persona
       $saldos= $this->adjuntarSaldosDemanda($ci);

        return view("demandado.list_demandas", 
        ['lista'=>   $lista,   'ci'=>$ci, 'nombre'=> $persona->TITULAR, "saldos"=> $saldos ] );
     
     

     
   
 }

/**
 * FICHA DE DEMANDA SEGUN COD_EMP
 */
    public function ficha_demanda(  $codemp){
        $data= DB::table("demandas")->where('cod_emp', $codemp)->first();
        return view("demandas.ficha_demanda", ['ficha'=>   $data] );
    }

    public function ficha_de_demanda(  $idnro){
        $data= Demanda::find( $idnro);
        $demanObj=  Demandados::where("CI", $data->CI)->first();
        $nom= $demanObj->TITULAR;
        return view("demandas.ficha_demanda", ['ficha'=>   $data, 'idnro'=>$idnro, 'nom'=>  $nom] );
    }

  /*
    NUEVA DEMANDA
    */

    public function show_form_nuevo( $id_d){//Id de demandado
        $qu= Demandados::find( $id_d);
        if( is_null( $qu) ){  echo "Código inválido";
        }else{
            $ci= $qu->CI;//cedula  
            $nom=$qu->TITULAR;//nombre
            return view('demandas.agregar.index', ['ci'=>  $ci ,'id_demandado'=>$id_d, 'nombre'=> $nom ]); 
        }
    }
    /**
     * request
     * ultimo codigo generado, id de demandado
     */
    public function nueva_demanda(Request $request, $idd=0){
         
        if( ! strcasecmp(  $request->method() , "post"))  {
            
            //Quitar el campo _token
            $Params=  $request->input(); 
            //Devuelve todo elemento de Params que no este presente en el segundo argumento
            $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"] ),function($ar1, $ar2){
                if( $ar1 == $ar2) return 0;    else 1; 
             } ); 
          
            $demandado=Demandados::find( $idd);
            $ci= $demandado->CI;//cedula de demandado
            $nombre= $demandado->TITULAR;
            //DB INSERT
            //instancia de demanda
            $obdema=new Demanda();
            $obdema->fill(  $Newparams );
            if($obdema->save()){//exito
                //ULTIMO ID GENERADO
                $ultimoIdGen=  $obdema->IDNRO;
                //MENSAJE RESPUESTA JSON
                echo json_encode(array(  'ci'=> $ci, 'nombre'=> $nombre,'id_demanda'=>$ultimoIdGen  ));
                //return view('demandas.msg_agregado', [  'ci'=> $ci, 'nombre'=> $nombre,'id_demanda'=>$ultimoIdGen ]     ); 

            }else{
                //fallo
                echo json_encode(array(  'error'=> 'Un problema en el servidor impidió guardar los datos. Contacte con su desarrollador.' ));
               
            }
        }
        else{
            if(  $idd!= 0){//id de demandado 
                $qu= Demandados::find( $idd);
                if( is_null( $qu) ){  echo "Código inválido";
                }else{
                    $ci= $qu->CI;//cedula  
                    $nom=$qu->TITULAR;//nombre
                    return view('demandas.agregar.index', ['ci'=>  $ci ,'id_demandado'=>$idd, 'nombre'=> $nom ]); 
                }
            }else{
                //Vista sin valores iniciales
              // return view('demandas.agregar_nodata'); 
               return view('demandas.agregar.index'); 
            }
            
        }
    }


    public function nueva_demandan(Request $request, $ci=0){//idd id_demandado
         
        $origen= DB::table("odemanda")->get();
        if( ! strcasecmp(  $request->method() , "post"))  {
            
            //Quitar el campo _token
            $Params=  $request->input(); 
            //Devuelve todo elemento de Params que no este presente en el segundo argumento
            $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"] ),function($ar1, $ar2){
                if( $ar1 == $ar2) return 0;    else 1; 
             } ); 
            /***ini transac */ 
             DB::beginTransaction();
             try {
                $deman=new Demanda();
                $deman->fill(  $Newparams );
                $deman->save();
               $noti= new Notificacion(); $noti->IDNRO= $deman->IDNRO; $noti->CI= $deman->CI; $noti->save();
               $obs= new Observacion(); $obs->IDNRO= $deman->IDNRO;    $obs->CI= $deman->CI; $obs->save(); 
               DB::commit();
               echo json_encode( array( 'ci'=> $deman->CI, "id_demanda"=> $deman->IDNRO) );
             } catch (\Exception $e) {
                 DB::rollback();
                 echo json_encode( array( 'error'=> "Hubo un error al guardar uno de los datos<br>$e") );
             } 
            /**end transac */
            
        }
        else{    
            if( $ci != 0){
                $ficha= Demandados::where("CI", $ci)->first();
                return view('demandas.agregarn.index',    [ 'ci'=>$ci, 'nombre'=>$ficha->TITULAR, 'ficha0'=> $ficha, 'OPERACION'=>"A+", "origen"=>$origen]); 
            }else{
                return view('demandas.agregarn.index',    [   'OPERACION'=>"A", "origen"=>$origen  ]);  
            } 
        }
    }



    
    public function editar_demandan(Request $request, $iddeman=0){//idd id_demanda
        $origen= DB::table("odemanda")->get();

           //instancia de demanda
           $obdema= NULL;
           if($iddeman==0) {$iddeman= $request->input("IDNRO"); }
           $obdema= Demanda::find( $iddeman );
           $obnoti= Notificacion::find( $iddeman);
           $obobs= Observacion::find( $iddeman);
           $obDataPerso= Demandados::where("CI", $obdema->CI)->first();

        if( ! strcasecmp(  $request->method() , "post"))  {
            
            //Quitar el campo _token
            $Params=  $request->input(); 
            //Devuelve todo elemento de Params que no este presente en el segundo argumento
            $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"] ),function($ar1, $ar2){
                if( $ar1 == $ar2) return 0;    else 1; 
             } );  
          
             /** DATOS DE TITULAR */
            $demandado=Demandados::where("CI", $obdema->CI)->first();
            //OBTENER DATOS
            $ci= $obdema->CI;//cedula de demandado
            $nombre= $demandado->TITULAR;
            //Actualizar en BD
            $obdema->fill(  $Newparams );
            if($obdema->save() ){//exito  
                echo json_encode(array(  'ci'=> $ci, 'nombre'=> $nombre,'id_demanda'=>$iddeman ));
            }else{ //fallo
                echo json_encode(array(  'error'=> 'Un problema en el servidor impidió guardar los datos. Contacte con su desarrollador.' )); 
            }
        }
        else{  //get 
            $ci= $obdema->CI;//cedula  
            $nom= Demandados::where("CI",$ci)->first()->TITULAR;//nombre 
            //Devolver
            //Cedula    ID demanda  Nombre  Operacion   
            return view('demandas.agregarn.index', [ 'ci'=>  $ci ,'id_demanda'=>$iddeman,'ficha0'=>$obDataPerso, 'ficha'=> $obdema, 'ficha2'=>$obnoti, 'ficha3'=>$obobs, 'nombre'=> $nom , 'OPERACION'=>"M", "origen"=>$origen]); //Modificar M  
            }
        }


        
    public function ver_demandan(Request $request, $iddeman=0){//idd id_demanda
        $origen= DB::table("odemanda")->get();

        //instancia de demanda 
        $obdema= Demanda::find( $iddeman );
        $obnoti= Notificacion::find( $iddeman);
        $obobs= Observacion::find( $iddeman);
        $obDataPerso= Demandados::where("CI", $obdema->CI)->first();
         $ci= $obdema->CI;//cedula  
         $nom= Demandados::where("CI",$ci)->first()->TITULAR;//nombre 
         //Devolver
         //Cedula    ID demanda  Nombre  Operacion   
         return view('demandas.agregarn.index',
          [ 'ci'=>  $ci ,'id_demanda'=>$iddeman,  "origen"=>  $origen,
          'ficha0'=>$obDataPerso, 'ficha'=> $obdema, 'ficha2'=>$obnoti, 'ficha3'=>$obobs,
           'nombre'=> $nom , 'OPERACION'=>"V"]); //ver V  
         
     }

 
/**
 * EDITAR DEMANDA
 */
public function editar_demanda(Request $request, $iddeman=0){
    //instancia de demanda
    $obdema= Demanda::find( $iddeman);
    $obnoti= Notificacion::find( $iddeman);
    $obobs= Observacion::find( $iddeman);

    if( ! strcasecmp(  $request->method() , "post"))  {
        //Quitar el campo _token
        $Params=  $request->input(); 
        //Devuelve todo elemento de Params que no este presente en el segundo argumento
        $Newparams= array_udiff_assoc(  $Params,  array("_token"=> $Params["_token"] ),function($ar1, $ar2){
            if( $ar1 == $ar2) return 0;    else 1; 
         } ); 
        //DB INSERT 
        $obdema->fill(  $Newparams );
        $obdema->save();
        //ULTIMO ID GENERADO
        $ci= $obdema->CI; 
        return view('demandas.msg_agregado', [  'ci'=> $ci, 'iddeman'=>$iddeman ]     ); 
    }
    else{
        if(  $iddeman!= 0){
            //datos para la vista 
            $qu= Demandados::where( "CI", $obdema->CI)->first();
            if( is_null( $qu) ){  echo "Código inválido";
            }else{
                $ci= $qu->CI;//cedula  
                $nom=$qu->TITULAR;//nombre
                 
                return view('demandas.editar.index', 
                ['ci'=>  $ci ,'id_demanda'=>$iddeman, 'nombre'=> $nom , 'ficha'=>$obdema, 'ficha2'=>$obnoti, 'ficha3'=>$obobs]); 
            }
        }else{
            //Vista sin valores iniciales
           return view('demandas.editar_nodata' , ['ci'=>  $obdema->CI ,'iddeman'=>$iddeman, 'nombre'=> $obdema->TITULAR, 'ficha'=>$obdema ]); 
        }
        
    }
}



public function borrar($iddeman){

    DB::beginTransaction();
    try {
        //Borrar demandas notificaciones y observacion asociada al CI Nro
        Demanda::find($iddeman)->delete();
        Notificacion::find( $iddeman)->delete();
        Observacion::find($iddeman)->delete();
        DB::commit();
      echo json_encode( array( 'id_deman'=> $iddeman) );
    } catch (\Exception $e) {
        DB::rollback();
        echo json_encode( array( 'error'=> "Hubo un error al borrar uno de los datos<br>$e") );
    }    
 }/** end  */







/**
 * LIQUIDACIONES
 * 
 */

public function demandas_p_liquidi(){
    $o_de= DB::table("odemanda")->get();

    $dts = DB::select("select TITULAR,CI,DEMANDANTE,COD_EMP,CTA_BANCO,BANCO,GARANTE,CI_GARANTE from demandas  order by TITULAR");
    return view('liquidaciones.liquidaciones', ['lista' => $dts, "odemanda" => $o_de]); 
}


public function demandas_p_liquidi_b_o( $origen){ 
    $dts = DB::select("select TITULAR,CI,DEMANDANTE,COD_EMP,CTA_BANCO,BANCO,GARANTE,CI_GARANTE from demandas where O_DEMANDA='$origen' order by TITULAR");
    return view('liquidaciones.liqui_tabla', ['lista' => $dts ]); 
}
  

    /*
    *
    LIQUIDAR DEMANDA
    **
    */
    public function liquidar(){
        return view('demandas.liquidar'); 
    }


    //*************************************************** */
      

 


 



}