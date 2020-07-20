<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{

      /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table= "notificaciones";

    protected $primaryKey = 'IDNRO';

    protected $fillable= [   'CI','PRESENTADO','PROVI_1','NOTIFI_1','ADJ_AI','AI_NRO','AI_FECHA','INTIMACI_1','INTIMACI_2','CITACION','PROVI_CITA','NOTIFI_2','ADJ_SD','SD_NRO','SD_FECHA','NOTIFI_3','ADJ_LIQUI','LIQUIDACIO','PROVI_2','NOTIFI_4','ADJ_APROBA','APROBA_AI','APRO_FECHA','APROB_IMPO','SALDO_EXT','ADJ_OFICIO','NOTIFI_5','EMBARGO_N','EMB_FECHA','EMBAR_EJEC','SD_FINIQUI','FEC_FINIQU','INIVISION','FEC_INIVI','ARREGLO_EX','LEVANTA','FEC_LEVANT','DEPOSITADO','EXTRAIDO_C','EXTRAIDO_L','OTRA_INSTI','EXCEPCION','APELACION','INCIDENTE' ];

    public $timestamps = false;

 

}