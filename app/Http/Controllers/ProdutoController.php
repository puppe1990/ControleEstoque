<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\Produto;
use App\Categoria;
use App\Http\Requests\ProdutosRequest;
use App\Repositories\ImageRepository;

class ProdutoController extends Controller
{
    public function listar(){

        $produtos = Produto
        ::leftJoin('entradas', 'produtos.id_produto', '=', 'entradas.fk_produto')
        ->leftJoin(DB::raw('(select produtos.id_produto,sum(saidas.quantidade) as quantidadeSaida
                            from saidas 
                            inner join produtos on produtos.id_produto = saidas.fk_produto
                            group by produtos.id_produto) as temp'), 'temp.id_produto', '=', 'produtos.id_produto')
        ->join('categorias', 'categorias.id_categoria', '=', 'produtos.fk_categoria')
        ->select('produtos.id_produto','produtos.codigo_produto','produtos.descricao', 'produtos.valor',DB::raw('sum(entradas.quantidade) as quantidadeEntrada'),'temp.quantidadeSaida','categorias.nome','produtos.path_image as imagens')
        ->groupBy('produtos.descricao','produtos.codigo_produto','produtos.valor','produtos.id_produto','categorias.nome','produtos.path_image','temp.quantidadeSaida')
        ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
        ->orderBy('produtos.id_produto','ASC')
        ->get();

    	return view('produto.listagem')->with(['produtos' => $produtos]);
    }

    public function novo(){

        $categorias = Categoria::all();
    	return view('produto.formulario')->with(['categorias' => $categorias]);
    }

    public function adiciona(ProdutosRequest $request, ImageRepository $repo){

        if ($request->hasFile('primaryImage')) {
            $request['path_image'] = $repo->saveImage($request->primaryImage, 'produtos', 250);
        }

        Produto::create($request->all());

        Request::session()->flash('message.level', 'success');
        Request::session()->flash('message.content', 'Produto Adicionado com Sucesso!');
		
		return redirect()->action('ProdutoController@listar');
	}

	public function remove($id_produto){

        try {
            $produto = Produto::find($id_produto);
            $produto->delete();

            Request::session()->flash('message.level', 'danger');
            Request::session()->flash('message.content', 'Produto Removido com Sucesso!');           

        } catch (\Exception $e) {
            DB::rollback();
            Request::session()->flash('message.level', 'danger');
            Request::session()->flash('message.content', 'Para apagar este produto. Você precisa excluir todas entradas e saídas do produto: '.$produto->codigo_produto.' - '.$produto->descricao);
        }

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

    public function edita($id_produto, ImageRepository $repo){

        $produto = Produto::find($id_produto);
        $params = Request::all();

        if (isset($params['primaryImage'])) {
            $produto['path_image'] = $repo->saveImage($params['primaryImage'], 'produtos', 250);
            $produto->update($params);
        }else{
            $produto->update($params);
        }

        Request::session()->flash('message.level', 'success');
        Request::session()->flash('message.content', 'Produto Alterado com Sucesso!');

        return redirect()
               ->action('ProdutoController@listar');
    }

    public function getProduto( $id_produto ){
        $produto = Produto::where('id_produto', '=', $id_produto)->first();
        return response()->json( $produto );
    }

    public function maiorProduto(){
        return $produto = DB::select( 
                            DB::raw("SELECT MAX(CAST(codigo_produto AS unsigned integer)) + 1 as codigo_produto 
                                     FROM produtos;") 
                          );
    }
}
