<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\Categoria;
use App\Produto;
use App\Venda;
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
		        ->join('vendas', 'vendas.id_venda', '=', 'saidas.fk_venda')
				->select('produtos.codigo_produto',
						 'produtos.path_image',
						 'produtos.descricao',
						 DB::raw('count(produtos.id_produto) as contador'))
        		->whereBetween('saidas.created_at', array($request["inicio"],$request["fim"]))
        		->where('vendas.online', '=', 0)
		        ->groupBy('produtos.codigo_produto', 'produtos.path_image','produtos.descricao')
		        ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
		        ->orderBy('contador','DESC')
		        ->get();

		        $_REQUEST["id_relatorio"] = $request["id_relatorio"];
				break;
			case '2':
				$relatorios = Produto
							::join('saidas', 'saidas.fk_produto', '=', 'produtos.id_produto')
							->join('vendas', 'vendas.id_venda', '=', 'saidas.fk_venda')
							->select('produtos.codigo_produto',
									'produtos.path_image',
									'produtos.descricao',
									DB::raw('count(produtos.id_produto) as contador'))
							->whereBetween('saidas.created_at', array($request["inicio"],$request["fim"]))
							->where('vendas.online', '=', 1)
							->groupBy('produtos.codigo_produto', 
										'produtos.path_image',
										'produtos.descricao')
							->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
							->orderBy('contador','DESC')
							->get();

				$_REQUEST["id_relatorio"] = $request["id_relatorio"];
				break;
			case '3':
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

			case '4':
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

			case '5':
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

			case '6':
				$relatorios = Venda
		        ::select(DB::raw('sum(vendas.valor_venda) as valor'),DB::raw('count(id_venda) as quantidade'),DB::raw('sum(vendas.valor_venda)/count(vendas.id_venda) as ticket_medio'))
        		->whereBetween('vendas.created_at',array($request["inicio"],$request["fim"]))
        		->where('online', '=', 1)
        		->where('divulgacao', '=', 0)
		        ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
		        ->get();
		        $_REQUEST["id_relatorio"] = $request["id_relatorio"];
				break;

			case '7':
				$relatorios = Venda
		        ::select(DB::raw('sum(vendas.valor_venda) as valor'),DB::raw('count(vendas.id_venda) as quantidade'),DB::raw('sum(vendas.valor_venda)/count(vendas.id_venda) as ticket_medio'))
        		->whereBetween('vendas.created_at',array($request["inicio"],$request["fim"]))
        		->where('divulgacao', '=', 0)
		        ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
		        ->get();
		        $_REQUEST["id_relatorio"] = $request["id_relatorio"];
				break;

			case '8':
				$relatorios = Venda
		        ::select(DB::raw('sum(vendas.valor_venda) as valor'),DB::raw('count(vendas.id_venda) as quantidade'),DB::raw('sum(vendas.valor_venda)/count(vendas.id_venda) as ticket_medio'))
        		->whereBetween('vendas.created_at',array($request["inicio"],$request["fim"]))
        		->where('divulgacao', '=', 1)
		        ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
		        ->get();
		        $_REQUEST["id_relatorio"] = $request["id_relatorio"];
				break;

			case '9':
				$relatorios = Venda
		        ::join('clientes', 'clientes.id_clientes', '=', 'vendas.fk_cliente')
		        ->select('clientes.id_clientes','clientes.nome','clientes.email','clientes.celular',DB::raw('sum(vendas.valor_venda) as valor'),DB::raw('count(clientes.id_clientes) as num_vendas'))
        		->whereBetween('vendas.created_at',array($request["inicio"],$request["fim"]))
        		->where('divulgacao', '=', 0)
		        ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
		        ->groupBy('clientes.nome','clientes.email','clientes.celular','clientes.id_clientes')
		        ->orderBy('valor','DESC')
		        ->get();

		        $_REQUEST["id_relatorio"] = $request["id_relatorio"];
				break;

			case '10':

       			$relatorios = DB::select( DB::raw("select (select sum(p.valor_compra*e.quantidade) valor_entrada from produtos p
													inner join entradas e on e.fk_produto = p.id_produto) - (select sum(p.valor_compra*s.quantidade) valor_entrada from produtos p
													inner join saidas s on s.fk_produto = p.id_produto) as valor_compra,
													(select sum(p.valor*e.quantidade) valor_entrada from produtos p
													inner join entradas e on e.fk_produto = p.id_produto) - (select sum(p.valor*s.quantidade) valor_entrada from produtos p
													inner join saidas s on s.fk_produto = p.id_produto) as valor_venda 
													from dual;") );

		        $_REQUEST["id_relatorio"] = $request["id_relatorio"];
				break;


			default:
				echo "Erro Fera!";
				break;
		}

    	return view('relatorio.formulario')->with(['relatorios' => $relatorios,'_REQUEST' => $_REQUEST]);
        exit;
		
	}
}
