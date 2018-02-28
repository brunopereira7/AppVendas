<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'tbl_municipio';
    protected $fillable = [
        'id',
        'nome_municipio',
        'codigo_municipio',
        'uf_municipio'
    ];
}
