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

    protected $fillable= [  'CI','DEMANDANTE','O_DEMANDA','COD_EMP','JUZGADO','ACTUARIA','JUEZ','FINCA_NRO',
    'CTA_CATAST', 'DEMANDA','SALDO','EMBARGO_NR','FEC_EMBARG','INSTITUCIO','INST_TIPO','CTA_BANCO','BANCO',
'EXPED_NRO', 'FOLIO_EXPED', 'ADJ_LEV_EMB_FEC'];

    public $timestamps = false;

 

}