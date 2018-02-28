<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoLiberacao extends Model
{
    protected $table = 'tbl_grupo_liberacao';
    protected $fillable = [
        'id',
        'id_empresa',
        'acesso_descricao',
        'acesso_adm',
        'libera_cadastrar_pessoa',
        'libera_editar_pessoa',
        'libera_deletar_pessoa',
        'libera_visualizar_pessoa',
        'libera_venda_balcao',
        'libera_venda_pedido',
        'libera_venda_comanda',
        'libera_venda_desconto',
        'libera_venda_desconto_acima_teto',
        'visualiza_venda_propia',
        'libera_venda_edita',
        'libera_venda_cancela'
    ];
}
