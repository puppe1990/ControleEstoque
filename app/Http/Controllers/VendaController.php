<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use App\Venda;
use App\Produto;
use App\Http\Requests\VendaRequest;

class VendaController extends Controller
{
    public function listarVenda(){
        // $vendas = Venda::all();

    	// return view('venda.listagem')->with(['vendas' => $vendas]);
    	return view('venda.listagem');
    }

    public function novo(){
    	$produtos = Produto::all();
        return view('venda.formulario')->with(['produtos' => $produtos]);
    }

    public function adiciona(VendasRequest $request){

		Venda::create($request->all());
        Request::session()->flash('message.level', 'success');
        Request::session()->flash('message.content', 'Venda Adicionada com Sucesso!');
		
		return redirect()->action('VendaController@listar')->withInput(Request::only('nome'));
	}

    public function remove($id_venda){

        $venda = Venda::find($id_venda);
        $venda->delete();

        Request::session()->flash('message.level', 'danger');
        Request::session()->flash('message.content', 'Venda Removida com Sucesso!');

        return redirect()
               ->action('VendaController@listar');
    }

    public function mostra($id){

        $venda = Venda::find($id);

        if(empty($venda)) {
            return "Essa venda não existe";
        }
        return view('venda.edita')->with('c', $venda);
    }

    public function edita($id_venda){

        $venda = Venda::find($id_venda);
        $params = Request::all();
        $venda->update($params);

        Request::session()->flash('message.level', 'success');
        Request::session()->flash('message.content', 'Venda Alterada com Sucesso!');

        return redirect()
               ->action('VendaController@listar');
    }
}
