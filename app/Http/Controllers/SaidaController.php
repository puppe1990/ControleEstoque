<?php

namespace App\Http\Controllers;

use Request;
use App\Produto;
use App\Categoria;
use App\Saida;
use App\Http\Requests\SaidasRequest;
use Carbon\Carbon; 


class SaidaController extends Controller
{
    public function listarSaida(){

        $produtos = Produto
        ::join('saidas', 'produtos.id_produto', '=', 'saidas.fk_produto')
        ->select('saidas.id_saida','produtos.path_image as imagens','produtos.codigo_produto','produtos.descricao', 'produtos.valor', 'saidas.created_at','saidas.quantidade','saidas.fk_venda')
        ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
        ->get();

    	return view('saida.listagem')->with(['produtos' => $produtos]);
    }

    public function novo(){

        $produtos = Produto::all();
        return view('saida.formulario')->with(['produtos' => $produtos]);
    }

    public function adiciona(SaidasRequest $request){

        $request["created_at"] = date("Y-m-d H:i:s",strtotime($request->created_at));
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
        $params["created_at"] = date("Y-m-d H:i:s",strtotime($params["created_at"]));
        $saida->update($params);

        Request::session()->flash('message.level', 'success');
        Request::session()->flash('message.content', 'Saída Alterada com Sucesso!');

        return redirect()
               ->action('SaidaController@listarSaida');
    }
}
