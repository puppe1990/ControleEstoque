<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\Produto;
use App\Categoria;
use App\Http\Requests\ProdutosRequest;

class ProdutoController extends Controller
{
    public function listar(){

        $produtos = Produto
        ::leftJoin('entradas', 'produtos.id_produto', '=', 'entradas.fk_produto')
        ->leftJoin('saidas', 'produtos.id_produto', '=', 'saidas.fk_produto')
        ->select('produtos.id_produto','produtos.codigo_produto','produtos.descricao', 'produtos.valor',DB::raw('sum(entradas.quantidade) as quantidadeEntrada'),DB::raw('sum(saidas.quantidade) as quantidadeSaida'))
        ->groupBy('produtos.descricao','produtos.codigo_produto','produtos.valor','produtos.id_produto')
        ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
        ->orderBy('produtos.id_produto','ASC')
        ->get();

    	return view('produto.listagem')->with(['produtos' => $produtos]);
    }

    public function novo(){

        $categorias = Categoria::all();
    	return view('produto.formulario')->with(['categorias' => $categorias]);
    }

    public function adiciona(ProdutosRequest $request){

		Produto::create($request->all());

        Request::session()->flash('message.level', 'success');
        Request::session()->flash('message.content', 'Produto Adicionado com Sucesso!');
		
		return redirect()->action('ProdutoController@listar');
	}

	public function remove($id_produto){

        $produto = Produto::find($id_produto);
        $produto->delete();

        Request::session()->flash('message.level', 'danger');
        Request::session()->flash('message.content', 'Produto Removido com Sucesso!');

        return redirect()
               ->action('ProdutoController@listar');
    }

    public function mostra($id){

        $produto = Produto::find($id);
        $categorias = Categoria::all();

        if(empty($produto)) {
            return "Essa produto não existe";
        }
        return view('produto.edita')->with(['categorias' => $categorias,'p' => $produto]);
    }

    public function edita($id_produto){

        $produto = Produto::find($id_produto);
        $params = Request::all();
        $produto->update($params);

        Request::session()->flash('message.level', 'success');
        Request::session()->flash('message.content', 'Produto Alterado com Sucesso!');

        return redirect()
               ->action('ProdutoController@listar');
    }
}
