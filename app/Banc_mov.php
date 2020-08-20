<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banc_mov extends Model
{

      /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table= "ctasban_mov";

    protected $primaryKey = 'IDNRO';

    protected $fillable= [ 'BANCO','CUENTA','FECHA','NUMERO','CODIGO','IMPORTE','CONCEPTO','PROJECTO','NRO_RECIBO','PROVEEDOR','TIPO_MOV' ];

    public $timestamps = false;

 

}