<?php

namespace App\Http\Controllers;

use Request;
use App\Fornecedor;
use App\Http\Requests\FornecedorRequest;

class FornecedorController extends Controller
{
    public function listar(){
        $fornecedores = Fornecedor::all();

    	return view('fornecedor.listagem')->with(['fornecedores' => $fornecedores]);
    }

    public function novo(){
    	return view('fornecedor.formulario');
    }

    public function adiciona(FornecedorRequest $request){

		Fornecedor::create($request->all());
        Request::session()->flash('message.level', 'success');
        Request::session()->flash('message.content', 'Fornecedor Adicionado com Sucesso!');
		
		return redirect()->action('FornecedorController@listar')->withInput(Request::only('nome'));
	}

    public function remove($id_fornecedor){

        $fornecedor = Fornecedor::find($id_fornecedor);
        $fornecedor->delete();

        Request::session()->flash('message.level', 'danger');
        Request::session()->flash('message.content', 'Fornecedor Removido com Sucesso!');

        return redirect()
               ->action('FornecedorController@listar');
    }

    public function mostra($id){

        $fornecedor = Fornecedor::find($id);

        if(empty($fornecedor)) {
            return "Essa fornecedor não existe";
        }
        return view('fornecedor.edita')->with('f', $fornecedor);
    }

    public function edita($id_fornecedor){

        $fornecedor = Fornecedor::find($id_fornecedor);
        $params = Request::all();
        $fornecedor->update($params);

        Request::session()->flash('message.level', 'success');
        Request::session()->flash('message.content', 'Fornecedor Alterado com Sucesso!');

        return redirect()
               ->action('FornecedorController@listar');
    }
}
