<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saida extends Model
{
    protected $fillable = ['quantidade','fk_produto'];	
	protected $primaryKey = 'id_saida';
}
