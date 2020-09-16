<?php
namespace App\Helpers;
use Exception;
class Helper
{
    
    /***
     * Devuelve una cadena numerica con separadores de puntos
     */
    public static function number_f( $ar){

      try{
        $v= floatval( $ar);
        return number_format($v, 0, '', '.');  
      }catch( Exception $err){
        return 0;
      }
      }
//Formato numero decimal de coma  a punto
      public static function fromComaToDot( $ar){
        return str_replace( ",", ".", $ar);
      }

    /***
     * Devuelve una fecha Y-m-d a partir de una fecha d/m/Y
     */
    public static function fecha_f( $fe){ //dma a  amd
        //convertir de d/m/Y a Y/m/d
       if( $fe==""  ) return "";
        $fecha= explode("/",  $fe);
        if( sizeof( $fecha) > 1){

          if( strlen($fecha[2] ) == 4 ){// dia mes anio
            if(  strlen($fecha[1])==1   )  $fecha[1]= "0".$fecha[1];
            if(  strlen($fecha[0])==1   )  $fecha[0]= "0".$fecha[0];
            echo $fecha[2] ."-".$fecha[1]."-".$fecha[0]; 
          }else{
            echo   $fecha[2]."-".$fecha[1]."-". $fecha[0]; 
          }
        }else
        echo $fe;//la fecha esta en otro formato
      }

/**Devuelde de yyyy-mm-dd a dd-mm-yyyy */
      public static function fecha_dma( $fe){ 
        //convertir de d/m/Y a Y/m/d
       if( $fe==""  || $fe =="0000-00-00" ) return "";
      
        $fecha= explode("-",  $fe);
        if( sizeof( $fecha) > 1){
           return   $fecha[2]."/".$fecha[1]."/". $fecha[0]; 
        }else
        return  $fe;//la fecha esta en otro formato
      }


 
      public static function beautyDate( $fecha){
        $retorna="";
        if( $fecha=="") return $retorna;
        try{
          $retorna=\Carbon\Carbon::parse($fecha)->format('d/m/Y');
        }catch(Exception $e)
        {
          $retorna= Helper::fecha_f($fecha);
        }
        return $retorna;
      }

}