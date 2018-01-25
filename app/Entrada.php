<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
   	protected $fillable = ['quantidade','fk_produto','created_at'];	
	protected $primaryKey = 'id_entrada';
}
