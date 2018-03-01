<?php

use Illuminate\Database\Seeder;

class TblEmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Empresa::create([
            'id' => 1,
            'ativo' => 'S',
            'razao_social' => 'EMPRESA DEMONSTRAÇÃO',
            'nome_fantasia' => 'EMPRESA DEMONSTRAÇÃO',
            'pessoa_f_j' => 'F',
            'telefone_principal' => '67991085386',
            'email_principal' => 'brunno.pereira7@gmail.com',
            'cadastro_usuario_id' => 1,
            'cadastro_usuario' => 'Seeder',
            'licenca_software' => '',
            'cod_verificacao' => ''
        ]);
    }
}
