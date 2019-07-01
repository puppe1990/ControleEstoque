<?php

namespace App\Http\Controllers;

use Request;
use App\GrupoProduto;
use App\Produto;
use App\Http\Requests\GrupoProdutosRequest;
use DB;

class GrupoProdutoController extends Controller
{
    public function listar(){
        $grupoProdutos = GrupoProdutoController::queryContagemGrupoProdutos();
        $produtos = GrupoProdutoController::queryAllProducts();
        return view('grupoproduto.listagem')
               ->with(['grupoProdutos' => $grupoProdutos, 
                      'produtos' => $produtos]);
    }

    public function novo(){
        $produtos = Produto::all();
        return view('grupoproduto.formulario')
               ->with(['produtos' => $produtos]);
    }

    public function adiciona(GrupoProdutosRequest $request){
        $grupoProdutos = $request->all();
        foreach($grupoProdutos["produtos"] as $value){
            GrupoProduto::create(['nome' => $grupoProdutos["nome"],
                                  'produto_id' => $value]);
        }
        Request::session()->flash('message.level', 'success');
        Request::session()->flash('message.content', 'Grupo Produtos Adicionada com Sucesso!');
		
        return redirect()
               ->action('GrupoProdutoController@listar')
               ->withInput(Request::only('nome'));
	}

    public function remove($id){
        $entrada = GrupoEntrada::find($id);
        $entrada->delete();

        Request::session()->flash('message.level', 'danger');
        Request::session()->flash('message.content', 'Grupo Produto Removidos com Sucesso!');

        return redirect()
               ->action('GrupoEntradaController@listarGrupoEntrada');
    }

    public function mostra($id){
        $grupoProdutos = Produto::all();

        if(empty($entrada)) {
            return "Esse Grupo Produto não existe";
        }
        return view('grupoproduto.edita')
               ->with(['grupoProdutos' => $grupoProdutos]);
    }

    public function edita($id){
        $grupoProduto = GrupoProduto::find($id);
        $params = Request::all();
        $grupoProduto->update($params);

        Request::session()->flash('message.level', 'success');
        Request::session()->flash('message.content', 'Grupo Produto Alterado com Sucesso!');

        return redirect()
               ->action('GrupoProdutoController@listar');
    }

    private function queryContagemGrupoProdutos(){
        return Produto
            ::leftJoin('entradas', 'produtos.id_produto', '=', 'entradas.fk_produto')
            ->leftJoin(DB::raw('(select produtos.id_produto,sum(saidas.quantidade) as quantidadeSaida
                                from saidas 
                                inner join produtos on produtos.id_produto = saidas.fk_produto
                                group by produtos.id_produto) as temp'), 'temp.id_produto', '=', 'produtos.id_produto')
            ->join('grupo_produtos', 'grupo_produtos.produto_id', '=', 'produtos.id_produto')
            ->select('grupo_produtos.nome',
                     DB::raw('sum(entradas.quantidade) as quantidadeEntrada'),
                     DB::raw('sum(temp.quantidadeSaida) as quantidadeSaida'))
            ->groupBy('grupo_produtos.nome')
            ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
            ->get();
    }

    private function queryAllProducts(){
        return Produto
               ::leftJoin('entradas', 'produtos.id_produto', '=', 'entradas.fk_produto')
               ->leftJoin(DB::raw('(select produtos.id_produto,sum(saidas.quantidade) as quantidadeSaida
                                    from saidas
                                    inner join produtos
                                    on produtos.id_produto = saidas.fk_produto
                                    group by produtos.id_produto) as temp'), 'temp.id_produto', '=', 'produtos.id_produto')
               ->join('grupo_produtos', 'grupo_produtos.produto_id', '=', 'produtos.id_produto')
               ->select('produtos.id_produto',
                        'produtos.codigo_produto',
                        'produtos.descricao',
                        'produtos.valor',
                        'grupo_produtos.nome',
                        DB::raw('sum(entradas.quantidade) as quantidadeEntrada'),
                        'temp.quantidadeSaida')
               ->groupBy('produtos.descricao',
                         'produtos.codigo_produto',
                         'produtos.valor',
                         'produtos.id_produto',
                         'grupo_produtos.nome',
                         'temp.quantidadeSaida')
               ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
               ->orderBy('produtos.id_produto','ASC')
               ->get();
    }
    
}
