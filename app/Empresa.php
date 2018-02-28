<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'tbl_empresa';
    protected $fillable = [
        'id',
        'ativo',
        'razao_social',
        'nome_fantasia',
        'pessoa_f_j',
        'cpf_cnpj',
        'rg_ssp',
        'inscricao_estadual',
        'telefone_principal',
        'telefone_um',
        'email_principal',
        'pessoa_contato',
        'endereco',
        'endereco_numero',
        'endereco_complemento',
        'endereco_bairro',
        'endereco_municipio_cod',
        'endereco_cep',
        'cadastro_usuario',
        'cadastro_usuario_id',
        'cadastro_data',
        'licenca_software',
        'cod_verificacao',
        'observacao'
    ];
}