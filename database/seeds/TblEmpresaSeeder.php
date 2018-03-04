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
            'licenca_software' => 'Vkc1d1ZrMXJNVlZXV0hCUFpXdFdNMVJWVWtKbFJUbEZXa1JvVGxkSVpEVlVWVkpHVGtWNFZWRlljRTFXUlVZMldtdFNTbVF3TVZWYU0xSk9Va1pHTUZSVlVrdFBSa1p6VTJ4YVZXRjZhRzVXVlZaWFZURktWbUpHVGxKWFNHUTFWRlZTUms1RmVGVlJXSEJOVmtWR05sTlZVa3BrTURseFUxUktVR0ZzUmpOYWExSkhUMFUxUlZSVVVrNVdSbkJ2VjJ4U1UyRXdPVVZhUjJ4UVZrVndjRlJXVW5KT1ZuQnhWVzB4V2sxc1JYaFVXSEJUWVZacmVWTllhRTloYkVVNQ==',
            'cod_verificacao' => '43816ae4d87b92b199f4fcd534bcb164'
        ]);
    }
}
