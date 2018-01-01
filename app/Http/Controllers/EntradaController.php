<?php

namespace App\Http\Controllers;

use Request;
use App\Produto;
use App\Categoria;
use App\Entrada;
use App\Http\Requests\EntradasRequest;


class EntradaController extends Controller
{
    public function listarEntrada(){

        // $produtos = Produto::all();
        $produtos = Produto
        ::join('entradas', 'produtos.id_produto', '=', 'entradas.fk_produto')
        ->select('entradas.id_entrada','produtos.codigo_produto','produtos.descricao', 'produtos.valor', 'entradas.created_at','entradas.quantidade')
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

        Entrada::create($request->all());
        
        return redirect()->action('EntradaController@listarEntrada');
    }

    public function remove($id_entrada){

        $entrada = Entrada::find($id_entrada);
        $entrada->delete();

        return redirect()
               ->action('EntradaController@listarEntrada');
    }

    public function mostra($id_entrada){

        $entrada = Entrada::find($id_entrada);
        $produtos = Produto::all();

        if(empty($entrada)) {
            return "Essa entrada não existe";
        }
        return view('entrada.edita')->with(['produtos' => $produtos, 'e' => $entrada]);
    }

    public function edita($id_entrada){

        $entrada = Entrada::find($id_entrada);
        $params = Request::all();
        $entrada->update($params);

        return redirect()
               ->action('EntradaController@listarEntrada');
    }
}
