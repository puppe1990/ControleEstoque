<?php

namespace App\Http\Controllers;

use Request;
use App\Produto;
use App\Categoria;
use App\Http\Requests\EntradasRequest;


class MovimentacaoController extends Controller
{
    public function listarEntrada(){

        // $produtos = Produto::all();
        $produtos = Produto
        ::join('entradas', 'produtos.id_produto', '=', 'entradas.fk_produto')
        ->select('produtos.codigo_produto','produtos.descricao', 'produtos.valor', 'entradas.created_at','entradas.quantidade')
        ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
        ->get();

    	return view('entrada.listagem')->with(['produtos' => $produtos]);
    }

    public function listarSaida(){

        // $produtos = Produto::all();
        $produtos = Produto
        ::join('entradas', 'produtos.id_produto', '=', 'entradas.fk_produto')
        ->select('produtos.codigo_produto','produtos.descricao', 'produtos.valor', 'entradas.created_at','entradas.quantidade')
        ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
        ->get();

    	return view('saida.listagem')->with(['produtos' => $produtos]);
    }

    public function novo(){

        $produtos = Produto::all();
        return view('entrada.formulario')->with(['produtos' => $produtos]);
    }

    public function adiciona(EntradasRequest $request){

        Movimentacao::create($request->all());
        
        return redirect()->action('EntradaController@listarEntrada');
    }
}
