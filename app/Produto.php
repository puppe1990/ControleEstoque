<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
   	protected $fillable = ['descricao','valor','fk_categoria','codigo_produto','path_image','destaque','valor_compra'];	
	protected $primaryKey = 'id_produto';
  
}
