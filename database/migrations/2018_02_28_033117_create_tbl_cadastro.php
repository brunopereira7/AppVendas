<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCadastro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cadastro', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_empresa');
            $table->string('ativo', 1)->default('S');
            $table->string('nome_completo', 200);
            $table->string('nome_fantasia', 200)->nullable();
            $table->string('pessoa_f_j', 1)->nullable();
            $table->string('cpf_cnpj', 20)->nullable();
            $table->string('rg_ssp', 50)->nullable();
            $table->string('inscricao_estadual', 50)->nullable();
            $table->DATE('data_nascimento')->nullable();
            $table->string('telefone_principal', 20)->nullable();
            $table->string('telefone_um', 20)->nullable();
            $table->string('email_principal', 200)->nullable();
            $table->string('pessoa_contato', 200)->nullable();
            $table->string('endereco', 200)->nullable();
            $table->string('endereco_numero', 100)->nullable();
            $table->string('endereco_complemento', 100)->nullable();
            $table->string('endereco_bairro', 200)->nullable();
            $table->string('endereco_municipio_cod', 20)->nullable();
            $table->string('endereco_cep', 20)->nullable();
            $table->string('listar_para_usuarios', 1)->default('S');
            $table->string('eh_usuarios', 1)->default('N');
            $table->string('eh_cliente', 1)->default('N');
            $table->string('eh_fornecedor', 1)->default('N');
            $table->timestamp('cadastro_data')->useCurrent = true;
            $table->string('cadastro_usuario', 200)->nullable();
            $table->integer('cadastro_usuario_id')->nullable();
            $table->string('observacao', 1000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_cadastro');
    }
}
