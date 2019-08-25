<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Request;
use App\Produto;

class ProdutoController extends Controller
{
    public function getProduto( $id_produto ){
        $produto = Produto::where('id_produto', '=', $id_produto)->first();
        return response()->json( $produto );
    }

}