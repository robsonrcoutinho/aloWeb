<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemPedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_pedido', function (Blueprint $table) {
            $table->unsignedInteger('fk_id_pedido');
            $table->unsignedInteger('fk_id_produto');
            $table->integer('quant_produto');
            $table->double('valor_total',6,2);
            $table->double('valor_unitario',6,2);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_pedido');
    }
}
