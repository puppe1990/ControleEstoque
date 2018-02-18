<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\Categoria;
use App\Produto;
use App\Http\Requests\RelatorioRequest;

class RelatorioController extends Controller
{
    public function novo(){
    	return view('relatorio.formulario');
    }

    public function mostra(RelatorioRequest $request){

    	// var_dump($request->all());exit;
 	
		switch ($request["id_relatorio"]) {
			case '1':
				$relatorios = Produto
		        ::join('saidas', 'saidas.fk_produto', '=', 'produtos.id_produto')
		        ->select('produtos.codigo_produto','produtos.descricao',DB::raw('count(produtos.id_produto) as contador'))
        		->whereBetween('saidas.created_at',array($request["inicio"],$request["fim"]))
		        ->groupBy('produtos.codigo_produto','produtos.descricao')
		        ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
		        ->orderBy('contador','DESC')
		        ->get();

		        $_REQUEST["id_relatorio"] = $request["id_relatorio"];
				break;

			case '2':
				$relatorios = Produto
		        ::join('saidas', 'saidas.fk_produto', '=', 'produtos.id_produto')
        		->join('categorias', 'categorias.id_categoria', '=', 'produtos.fk_categoria')
		        ->select('categorias.nome',DB::raw('count(produtos.id_produto) as contador'))
        		->whereBetween('saidas.created_at',array($request["inicio"],$request["fim"]))
		        ->groupBy('categorias.nome')
		        ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
		        ->orderBy('contador','DESC')
		        ->get();
		        $_REQUEST["id_relatorio"] = $request["id_relatorio"];
				break;

			case '3':
				$relatorios = Produto
		        ::join('entradas', 'entradas.fk_produto', '=', 'produtos.id_produto')
        		->join('categorias', 'categorias.id_categoria', '=', 'produtos.fk_categoria')
		        ->select('categorias.nome',DB::raw('count(produtos.id_produto) as contador'))
        		->whereBetween('entradas.created_at',array($request["inicio"],$request["fim"]))
		        ->groupBy('categorias.nome')
		        ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
		        ->orderBy('contador','DESC')
		        ->get();
		        $_REQUEST["id_relatorio"] = $request["id_relatorio"];
				break;

			
			default:
				echo "Erro Fera!";
				break;
		}

    	return view('relatorio.formulario')->with(['relatorios' => $relatorios,'_REQUEST' => $_REQUEST]);
        exit;
		
		// return view('relatorio.formulario');
	}
}
