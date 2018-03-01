<?php

use Illuminate\Database\Seeder;

class TblCadastroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Cadastro::create([
            'nome_completo'            => 'GILBERTO BRUNO DA CRUZ PEREIRA',
            'id_empresa'               => 1,
            'nome_fantasia'            => 'BRUNO PEREIRA',
            'pessoa_f_j'               => 'F',
            'cpf_cnpj'                 => '05812349100',
            'rg_ssp'                   => '0940508849',
            'data_nascimento'          => '1996/02/13',
            'telefone_principal'       => '67991085386',
            'email_principal'          => 'brunno.pereira7@gmail.com',
            'pessoa_contato'           => 'BRUNO PEREIRA',
            'endereco_municipio_cod'   => '5002704',
            'listar_para_usuarios'     => 'S',
            'eh_usuarios'              => 'S',
            'eh_cliente'               => 'N',
            'eh_fornecedor'            => 'S',
            'observacao'               => 'Fornecedor Sistema'
        ]);
    }
}
