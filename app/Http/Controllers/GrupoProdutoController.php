<?php

namespace App\Http\Controllers;

use Request;
use App\GrupoProduto;
use App\Produto;
use App\Http\Requests\GrupoProdutosRequest;


class GrupoProdutoController extends Controller
{
    public function listarGrupoProduto(){
        $grupoProdutos = GrupoProduto::all();
        return view('grupoProduto.listagem')
               ->with(['grupoProdutos' => $grupoProdutos]);
    }

    public function novo(){
        return view('grupoProduto.formulario');
    }

    public function adiciona(GrupoProdutosRequest $request){
		GrupoProduto::create($request->all());
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
        return view('entrada.edita')
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
}
