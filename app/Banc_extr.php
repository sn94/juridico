<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banc_extr extends Model
{

      /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table= "ctas_ext";

    protected $primaryKey = 'IDNRO';

    protected $fillable= [  'CUENTA','FECHA','IMPORTE','NUMERO','CODIGO','CONCEPTO', 'PROJECTO','NRO_RECIBO','PROVEEDOR' ];

    public $timestamps = false;

 

}