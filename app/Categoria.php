<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
   protected $fillable = ['nome'];
   protected $primaryKey = 'id_categoria';
}
