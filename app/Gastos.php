<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{

      /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table= "gastos";

    protected $primaryKey = 'IDNRO';

    protected $fillable= [  'CODIGO','FECHA','NUMERO','DETALLE1','DETALLE2' , 'IMPORTE'];

    public $timestamps = false;

 
 

}