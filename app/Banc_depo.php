<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banc_depo extends Model
{

      /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table= "ctas_dep";

    protected $primaryKey = 'IDNRO';

    protected $fillable= [  'CUENTA','FECHA','IMPORTE','NUMERO','CONCEPTO' ];

    public $timestamps = false;

 

}