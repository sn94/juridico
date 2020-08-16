<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bancos extends Model
{

      /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table= "ctas_banco";

    protected $primaryKey = 'IDNRO';

    protected $fillable= [  'BANCO','TIPO_CTA','CUENTA','TITULAR','SALDO' ];

    public $timestamps = false;

 

}