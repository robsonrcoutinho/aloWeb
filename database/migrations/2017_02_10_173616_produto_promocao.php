<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProdutoPromocao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_promocao', function (Blueprint $table) {
            $table->unsignedInteger('fk_id_produto');
            $table->unsignedInteger('fk_id_promocao');
            $table->foreign('fk_id_produto')->references('id')->on('produtos');
            $table->foreign('fk_id_promocao')->references('id')->on('promocaos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto_promocao');
    }
}
