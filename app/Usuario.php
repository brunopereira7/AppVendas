<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'tbl_usuario';
    protected $fillable = [
        'id',
        'ativo',
        'cadastro_id',
        'login',
        'senha',
        'senha_confirma',
        'grupo_liberacao_id'
    ];
    protected $hidden = ['senha', 'senha_confirma'];
}