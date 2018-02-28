<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoLiberacao extends Model
{
    protected $table = 'tbl_grupo_liberacao';
    protected $fillable = [
        'id',
        'nome_municipio',
        'codigo_municipio',
        'uf_municipio'
    ];
}
