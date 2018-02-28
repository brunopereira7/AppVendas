<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cadastro extends Model
{
    protected $table = 'tbl_cadastro';
    protected $fillable = [
        'id',
        'id_empresa',
        'ativo',
        'nome_completo',
        'nome_fantasia',
        'pessoa_f_j',
        'cpf_cnpj',
        'rg_ssp',
        'inscricao_estadual',
        'data_nascimento',
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
        'listar_para_usuarios',
        'eh_usuarios',
        'eh_cliente',
        'eh_fornecedor',
        'cadastro_data',
        'cadastro_usuario',
        'cadastro_usuario_id',
        'observacao'
    ];
}
