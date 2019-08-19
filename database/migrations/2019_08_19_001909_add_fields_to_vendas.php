<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToVendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendas', function (Blueprint $table) {
            $table->enum('tipo_pagamento', ['Débito', 'Crédito', 'Dinheiro'])->nullable();
            $table->boolean('troca')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendas', function (Blueprint $table) {
            $table->dropColumn('tipo_pagamento');
            $table->dropColumn('troca');
        });
    }
}
