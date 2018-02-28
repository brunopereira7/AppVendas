<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_empresa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ativo', 1)->default('S');
            $table->string('razao_social', 200);
            $table->string('nome_fantasia', 200)->nullable();
            $table->string('pessoa_f_j', 1);
            $table->string('cpf_cnpj', 20)->nullable();
            $table->string('rg_ssp', 50)->nullable();
            $table->string('inscricao_estadual', 50)->nullable();
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
            $table->string('cadastro_usuario', 200);
            $table->integer('cadastro_usuario_id');
            $table->timestamp('cadastro_data')->useCurrent = true;
            $table->string('licenca_software', 1000);
            $table->string('cod_verificacao', 200);
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
        Schema::dropIfExists('tbl_empresa');
    }
}
