<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demandados extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table= "demandado";

    protected $primaryKey = 'IDNRO';

    protected $fillable= [ 'TITULAR','DOMICILIO','CI','TELEFONO','CELULAR','LABORAL','TEL_TRABAJ','GARANTE','CI_GARANTE','TEL_GARANT','DOM_GARANT','LABORAL_G','TEL_LAB_G'];

    public $timestamps = false;
    
}