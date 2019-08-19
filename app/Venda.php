<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = ['valor_venda', 'desconto', 'porcentagem', 'divulgacao', 'online', 'troca', 'tipo_pagamento', 'fk_cliente', 'created_at'];
    protected $primaryKey = 'id_venda';
}
