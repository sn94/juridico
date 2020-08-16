<?php
namespace App\Helpers;
class Helper
{
    
    /***
     * Devuelve una cadena numerica con separadores de puntos
     */
    public static function number_f( $ar){
        $v= floatval( $ar);
        return number_format($v, 0, '', '.');  
      }
//Formato numero decimal de coma  a punto
      public static function fromComaToDot( $ar){
        return str_replace( ",", ".", $ar);
      }

    /***
     * Devuelve una fecha Y-m-d a partir de una fecha d/m/Y
     */
    public static function fecha_f( $fe){ 
        //convertir de d/m/Y a Y/m/d
       if( $fe==""  ) return "";
        $fecha= explode("/",  $fe);
        if( sizeof( $fecha) > 1){
          if(  strlen($fecha[1])==1   )  $fecha[1]= "0".$fecha[1];
          if(  strlen($fecha[0])==1   )  $fecha[0]= "0".$fecha[0];
          echo $fecha[2] ."-".$fecha[1]."-".$fecha[0]; 
        }else
        echo $fe;//la fecha esta en otro formato
      }


 

}