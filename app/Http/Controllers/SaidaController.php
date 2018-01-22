<?php

namespace App\Http\Controllers;

use Request;
use App\Produto;
use App\Categoria;
use App\Saida;
use App\Http\Requests\SaidasRequest;


class SaidaController extends Controller
{
    public function listarSaida(){

        // $produtos = Produto::all();
        $produtos = Produto
        ::join('saidas', 'produtos.id_produto', '=', 'saidas.fk_produto')
        ->select('saidas.id_saida','produtos.codigo_produto','produtos.descricao', 'produtos.valor', 'saidas.created_at','saidas.quantidade')
        ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
        ->get();

    	return view('saida.listagem')->with(['produtos' => $produtos]);
    }

    public function novo(){

        $produtos = Produto::all();
        return view('saida.formulario')->with(['produtos' => $produtos]);
    }

    public function adiciona(SaidasRequest $request){

        Saida::create($request->all());

        Request::session()->flash('message.level', 'success');
        Request::session()->flash('message.content', 'Saída Adicionada com Sucesso!');
        
        return redirect()->action('SaidaController@listarSaida');
    }

    public function remove($id_saida){

        $saida = Saida::find($id_saida);
        $saida->delete();

        Request::session()->flash('message.level', 'danger');
        Request::session()->flash('message.content', 'Saída Removida com Sucesso!');

        return redirect()
               ->action('SaidaController@listarSaida');
    }

    public function mostra($id_saida){

        $saida = saida::find($id_saida);
        $produtos = Produto::all();

        if(empty($saida)) {
            return "Essa saída não existe";
        }
        return view('saida.edita')->with(['produtos' => $produtos, 'e' => $saida]);
    }

    public function edita($id_saida){

        $saida = Saida::find($id_saida);
        $params = Request::all();
        $saida->update($params);

        Request::session()->flash('message.level', 'success');
        Request::session()->flash('message.content', 'Saída Alterada com Sucesso!');

        return redirect()
               ->action('SaidaController@listarSaida');
    }
}
