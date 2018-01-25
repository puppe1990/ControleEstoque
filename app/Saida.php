<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saida extends Model
{
    protected $fillable = ['quantidade','fk_produto','created_at'];	
	protected $primaryKey = 'id_saida';
	protected $dates = ['created_at'];
}
