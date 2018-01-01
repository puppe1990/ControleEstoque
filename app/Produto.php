<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
   	protected $fillable = ['descricao','valor','fk_categoria','codigo_produto'];	
	protected $primaryKey = 'id_produto';
  
}
