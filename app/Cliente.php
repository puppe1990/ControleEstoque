<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
   	protected $fillable = ['nome','email','celular', 'cpf'];	
	protected $primaryKey = 'id_clientes';
  
}