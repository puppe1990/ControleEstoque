<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaVendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->increments('id_venda');
            $table->double('valor_venda', 8, 2);
            $table->double('desconto', 8, 2); 
            $table->double('porcentagem', 8, 2); 
            $table->boolean('online'); 
            $table->boolean('divulgacao'); 
            $table->integer('fk_cliente')->unsigned();
            $table->foreign('fk_cliente')->references('id_clientes')->on('clientes');
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
        //
    }
}
