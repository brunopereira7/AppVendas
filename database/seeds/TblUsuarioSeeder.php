<?php

use Illuminate\Database\Seeder;

class TblUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cript = new \App\Http\Controllers\Seguranca();

        App\Usuario::create([
            'ativo' => 'S',
            'cadastro_id' => '1',
            'login' => $cript->criptPadrao('admin'),
            'senha' => $cript->criptPadrao('ourocard'),
            'grupo_liberacao_id' => '1'
        ]);

        App\GrupoLiberacao::create([

            'id_empresa' => 1,
            'acesso_descricao' => 'ADM',
            'acesso_adm' => 'S',
            'libera_cadastrar_pessoa' => 'S',
            'libera_editar_pessoa' => 'S',
            'libera_deletar_pessoa' => 'S',
            'libera_visualizar_pessoa' => 'S',
            'libera_venda_balcao' => 'S',
            'libera_venda_pedido' => 'S',
            'libera_venda_comanda' => 'S',
            'libera_venda_desconto' => 'S',
            'libera_venda_desconto_acima_teto' => 'S',
            'visualiza_venda_propia' => 'N',
            'libera_venda_edita' => 'S',
            'libera_venda_cancela' => 'S'
        ]);
    }
}
