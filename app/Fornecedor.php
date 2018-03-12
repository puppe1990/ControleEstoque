<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedores';
    protected $fillable = ['nome_loja','celular','email','endereco','ponto_referencia','observacao'];	
	protected $primaryKey = 'id_fornecedor';
  
}
