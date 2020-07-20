<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demanda extends Model
{

      /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table= "demandas2";

    protected $primaryKey = 'IDNRO';

    protected $fillable= [  'CI','DEMANDANTE','O_DEMANDA','COD_EMP','DOC_DENUNC','LOCALIDAD','DOC_DEN_GA','LOCALIDA_G','JUZGADO','ACTUARIA','JUEZ','FINCA_NRO','CTA_CATAST'];

    public $timestamps = false;


    public function demandado()
    {
        return $this->belongsTo('App\Demandados', "IDNRO");
    }

}