<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
   	protected $fillable = ['quantidade','fk_produto'];	
	protected $primaryKey = 'id_entrada';
}
