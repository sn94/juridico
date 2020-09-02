<?php

namespace App\Http\Controllers;

use App\Arreglo_extrajudicial;
use App\Contraparte;
use App\Demanda;
use App\Demandados;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Notificacion;
use App\Observacion;
use App\pdf_gen\PDF;
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
        $arr= $judi->saldo_C_y_L( $idn);
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
     

    private function formar_parametros(){//parametros basicos
        $origen= DB::table("odemanda")->get();//Origen de demanda
        $demandantes= DB::table("demandan")->get();//Demandantes
        $actuarias= DB::table("actuaria")->get();//Actuarias
        $jueces= DB::table("juez")->get();//Juez
        $instituciones= DB::table("instituc")->get();//Instituciones
        $inst_tipo= DB::table("instipo")->get();//tipo de Instituciones 
        $juzgados= DB::table("juzgado")->get();// JUzgado
        $localidades= DB::table("localida")->get();// Localidad
        $bancos= DB::table("bancos")->get();// Bancos

        return array("origen"=>$origen ,"demandantes"=> $demandantes ,   "actuarias"=> $actuarias, "jueces"=>$jueces,
         "instituciones"=> $instituciones, "instipos"=>$inst_tipo, "juzgados"=> $juzgados, "localidades"=>$localidades,
        "bancos"=> $bancos );
    }


    public function nueva_demandan(Request $request, $ci=0){//idd id_demandado
         
        
        if( ! strcasecmp(  $request->method() , "post"))  {
            
            //Quitar el campo _token
            $Params=  $request->input();  
            /***ini transac */ 
             DB::beginTransaction();
             try {
                $deman=new Demanda();
                $deman->fill(  $Params );
                $deman->save();
               $noti= new Notificacion(); $noti->IDNRO= $deman->IDNRO; $noti->CI= $deman->CI; $noti->save();
               $obs= new Observacion(); $obs->IDNRO= $deman->IDNRO;    $obs->CI= $deman->CI; $obs->save();
               $contra= new Contraparte(); $contra->IDNRO= $deman->IDNRO; $contra->save();
               $obarre= new Arreglo_extrajudicial();  $obarre->IDNRO= $deman->IDNRO;  $obarre->save(); 
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
                return view('demandas.agregarn.index',  
                array_merge( $this->formar_parametros() ,
                 [ 'ci'=>$ci, 'nombre'=>$ficha->TITULAR, 'ficha0'=> $ficha, 'OPERACION'=>"A+"])     ); 
            }else{
                $pars= array_merge( $this->formar_parametros() , array( 'OPERACION'=>"A"  ) );
                return view('demandas.agregarn.index', $pars);  
            } 
        }
    }



    
    public function editar_demandan(Request $request, $iddeman=0){//idd id_demanda
       

           //instancia de demanda
           $obdema= NULL;
           if($iddeman==0) {$iddeman= $request->input("IDNRO"); }
           $obdema= Demanda::find( $iddeman );
           $obnoti= Notificacion::find( $iddeman);
           $obobs= Observacion::find( $iddeman);
           $obDataPerso= Demandados::where("CI", $obdema->CI)->first();
           //Contraparte-intervencion
           $obcontraparte= Contraparte::find( $iddeman);
           if( is_null( $obcontraparte) ){//Crear una instancia de intervencion-contraparte si no existe
               $obcontraparte= new Contraparte();
               $obcontraparte->IDNRO= $iddeman;
               $obcontraparte->save();
           }
           //Existe Arreglo Extrajudicial?
           $obarre=Arreglo_extrajudicial::find( $iddeman );
           if( is_null( $obarre)  ){//Crear una inst. de arreglo ext.judicial si no existe
               $obarre= new Arreglo_extrajudicial();
               $obarre->IDNRO= $iddeman;
               $obarre->save();
           }
        

        if( ! strcasecmp(  $request->method() , "post"))  {
            
            //Quitar el campo _token
            $Params=  $request->input();    
            //Actualizar en BD
            $obdema->fill(  $Params );
            if($obdema->save() ){//exito  
                echo json_encode(array(   'ok'=> "GUARDADO" ));
            }else{ //fallo
                echo json_encode(array(  'error'=> 'Un problema en el servidor impidió guardar los datos. Contacte con su desarrollador.' )); 
            }
        }
        else{  //get 
            $ci= $obdema->CI;//cedula  
            $nom= Demandados::where("CI",$ci)->first()->TITULAR;//nombre 
            //Devolver 
            $pars= array_merge( $this->formar_parametros() ,
             array( 'ci'=>  $ci ,'id_demanda'=>$iddeman,'ficha0'=>$obDataPerso, 'ficha'=> $obdema,
              'ficha2'=>$obnoti,  'ficha3'=>$obobs, 'ficha4'=> $obcontraparte,'ficha5'=> $obarre,
               'nombre'=> $nom , 'OPERACION'=>"M" ) 
                );
            return view('demandas.agregarn.index',  $pars); //Modificar M  
            }
        }



    public function contraparte(Request $request, $iddeman=""){
        $id_demanda= $iddeman =="" ?  $request->input("IDNRO") : $iddeman;
       $contra=  Contraparte::find( $id_demanda);
       //Si no existe
       if( is_null($contra) )  $contra= new Contraparte();
       $contra->fill(  $request->input() ); 
       if($contra->save())
       echo json_encode( array( 'ok'=>"GUARDADO" )    );
       else
       echo json_encode( array( 'error'=>"ERROR AL GUARDAR" )    ); 
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
         //Arreglo extrajudicial
         $arreglo=Arreglo_extrajudicial::find($iddeman);
         //Devolver
         //Cedula    ID demanda  Nombre  Operacion   
         $pars= array_merge( $this->formar_parametros() , array( 'OPERACION'=>"A"  ) );
         $propios= array(  'ci'=>  $ci ,'id_demanda'=>$iddeman, 
         'ficha0'=>$obDataPerso, 'ficha'=> $obdema, 'ficha2'=>$obnoti, 'ficha3'=>$obobs,
         'ficha4'=> $arreglo,  'nombre'=> $nom , 'OPERACION'=>"V");
         return view('demandas.agregarn.index',  array_merge( $pars, $propios ) ); //ver V   
         
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
      

 


 


    public function reporte($id, $tipo){//ID_DEMANDA TIPO
        $DEMANDA_OBJ=Demanda::find( $id );
        $SEGUIMI_OBJ=Notificacion::find($id);
        $OBSERVA_OBJ=Observacion::find( $id );
         
        if( $tipo == "xls"){
            echo json_encode( array( "0"=> array_merge($DEMANDA_OBJ,$SEGUIMI_OBJ,$OBSERVA_OBJ)) );  
        }else{
            //Pdf format
            //Demanda
            $TOTAL=  Helper::number_f( $DATO->TOTAL );
            $EXTRAIDO=Helper::number_f( $DATO->EXTRAIDO );
            $SALDO= Helper::number_f( $DATO->SALDO );
            $EXT_LIQUID=Helper::number_f( $DATO->EXT_LIQUID );
            $NEW_SALDO= Helper::number_f( $DATO->NEW_SALDO );
            $html=<<<EOF
            <style>
            h1,h2,h3,h4,h5,h6{  color: #151515;}
            span{
                font-weight: bolder;
            }
            .subtitulo{ font-size: 7pt; font-weight: bold; text-align: center;text-decoration: underline; background-color: #bcfdb0; border-bottom: 1px solid #8ef861;}
            .panel{
                margin-top:0px;
                border-top: 1px solid #797979;
                border-bottom: 1px solid #797979;
                border-left: 1px solid #797979;
                border-right: 1px solid #797979;
            } 
            td{ text-align:left; }
            table.tabla{ 
                font-family: helvetica;
                font-size: 7pt; 
                color: #151515;
            }
            </style>
            
            <h6>CI° {$DEMANDA_OBJ->CI} TITULAR: {$DEMANDA_OBJ->TITULAR}</h6>
            <table class="tabla">
            <tbody>
            <tr> 
            <td style='text-align:left;'>
            <span>DIRECCIÓN:</span> {$DEMANDA_OBJ->DOMICILIO}<br><br>
            <span>TELÉFONO:</span> {$DEMANDA_OBJ->TELEFONO}<br><br>
            <span>CELULAR:</span> {$DEMANDA_OBJ->CELULAR}<br><br>
            </td>
            <td>
            <span>DIRECCIÓN LABORAL:</span> {$DEMANDA_OBJ->CTA_MESES}<br><br>
            <span>TELÉFONO LABORAL:</span> {$DEMANDA_OBJ->INT_X_MES}<br><br>
            <span>LIQUIDACIÓN.:</span> {$DEMANDA_OBJ->LIQUIDACIO}
            </td>
            <td>
            <span>FINIQUITO:</span> {$DEMANDA_OBJ->FINIQUITO}<br><br>
            <span>IMP.EXTR.:</span> {$EXTRAIDO}<br><br>
            <span>SALDO:</span> {$SALDO}<br><br>
            </td>
            <td>
            <span>EXTR.LIQUID.:</span> {$EXT_LIQUID}<br><br>
            <span>NUEVO SALDO:</span> {$NEW_SALDO}
            </td>
            </tr> 
            </tbody> 
            </table> 
            <p class="subtitulo"> TOTALES</p>
            <table class="tabla panel">
            <tr>
            <td><span>CAPITAL:</span> {$DATO->CAPITAL}<br></td>
            <td><span>IMP.INTERÉS.:</span> {$DATO->IMP_INTERE}<br></td>
            <td><span>GAST.NOTIF.:</span> {$DATO->GAST_NOTIF}<br></td>
            <td><span>GAST.NOTIF.GTE.:</span> {$DATO->GAST_NOTIG}<br></td>
            </tr>
            <tr>
            <td><span>GAST.EMBARGO.:</span> {$DATO->GAST_EMBAR}<br></td>
            <td><span>GAST.INTIMAC.:</span> {$DATO->GAST_INTIM}<br></td>
            <td><span>I.V.A.:</span> {$DATO->IVA}<br></td>
            <td> <span>HONORARIOS.:</span> {$DATO->HONORARIOS}<br></td>
            </tr>
            <tr>
            <td><span>TOTAL:</span> $TOTAL <br></td>
            <td></td>
            <td></td>
            <td></td>
            </tr>
            </table>
            EOF; 
           // echo $html;
            $tituloDocumento= "LIQUIDACION-".date("d")."-".date("m")."-".date("yy")."-".rand();
                $pdf = new PDF(); 
                $pdf->prepararPdf("$tituloDocumento.pdf", $tituloDocumento, ""); 
                $pdf->generarHtml( $html);
                $pdf->generar();
    
        }//End pdf format option  
    }//End Function


}