<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblGrupoLiberacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_grupo_liberacao', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_empresa',
                $table->string('acesso_descricao',100),
                $table->string('acesso_adm',1)->default('N')
$table->string('libera_cadastrar_pessoa',1)->default('N')
$table->string('libera_editar_pessoa',1)->default('N')
$table->string('libera_deletar_pessoa',1)->default('N')
$table->string('libera_visualizar_pessoa',1)->default('N')
$table->string('libera_venda_balcao',1)->default('N')
$table->string('libera_venda_pedido',1)->default('N')
$table->string('libera_venda_comanda',1)->default('N')
$table->string('libera_venda_desconto',1)->default('N')
$table->string('libera_venda_desconto_acima_teto',1)->default('N')
$table->string('visualiza_venda_propia',1)->default('S')
$table->string('libera_venda_edita',1)->default('N')
$table->string('libera_venda_cancela',1)->default('N')
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
        Schema::dropIfExists('tbl_grupo_liberacao');
    }
}
