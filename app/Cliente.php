<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
   	protected $fillable = ['nome','email','celular'];	
	protected $primaryKey = 'id_clientes';
  
}