<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkVendaTableSaidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saidas', function (Blueprint $table) {
            $table->integer('fk_venda')->unsigned();
            $table->foreign('fk_venda')->references('id_venda')->on('vendas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('saidas', function (Blueprint $table) {
            $table->dropColumn('fk_venda');
        });
    }
}
