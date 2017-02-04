<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

       Schema::table('produtos', function (Blueprint $table) {
            $table->foreign('fk_id_categoria')->references('id')->on('categorias');
            $table->foreign('fk_id_marca')->references('id')->on('marcas');
        });

        Schema::table('pedidos', function (Blueprint $table) {
            $table->foreign('fk_id_usuario')->references('id')->on('usuarios');
        });

        Schema::table('item_pedido', function (Blueprint $table) {
            $table->foreign('fk_id_pedido')->references('id')->on('pedidos');
            $table->foreign('fk_id_produto')->references('id')->on('produtos');
        });

        Schema::table('estoques', function (Blueprint $table) {
            $table->foreign('fk_id_produto')->references('id')->on('produtos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
