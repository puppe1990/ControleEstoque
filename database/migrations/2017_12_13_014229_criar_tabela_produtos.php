<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id_produto');
            $table->string('descricao');
            $table->double('valor', 8, 2); 
            $table->double('valor_compra', 8, 2); 
            $table->integer('fk_categoria')->unsigned();
            $table->foreign('fk_categoria')->references('id_categoria')->on('categorias');
            $table->boolean('destaque');
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
        Schema::dropIfExists('produtos');
    }
}
