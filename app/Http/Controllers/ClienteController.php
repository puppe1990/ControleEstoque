<?php

namespace App\Http\Controllers;

use Request;
use App\Cliente;
use App\Http\Requests\ClienteRequest;

class ClienteController extends Controller
{
    public function listar(){
        $clientes = Cliente::all();

    	return view('cliente.listagem')->with(['clientes' => $clientes]);
    }

    public function novo(){
    	return view('cliente.formulario');
    }

    public function adiciona(ClienteRequest $request){

		Cliente::create($request->all());
        Request::session()->flash('message.level', 'success');
        Request::session()->flash('message.content', 'Cliente Adicionada com Sucesso!');
		
		return redirect()->action('ClienteController@listar')->withInput(Request::only('nome'));
	}

    public function remove($id_cliente){

        $cliente = Cliente::find($id_cliente);
        $cliente->delete();

        Request::session()->flash('message.level', 'danger');
        Request::session()->flash('message.content', 'Cliente Removida com Sucesso!');

        return redirect()
               ->action('ClienteController@listar');
    }

    public function mostra($id){

        $cliente = Cliente::find($id);

        if(empty($cliente)) {
            return "Essa cliente não existe";
        }
        return view('cliente.edita')->with('c', $cliente);
    }

    public function edita($id_cliente){

        $cliente = Cliente::find($id_cliente);
        $params = Request::all();
        $cliente->update($params);

        Request::session()->flash('message.level', 'success');
        Request::session()->flash('message.content', 'Cliente Alterada com Sucesso!');

        return redirect()
               ->action('ClienteController@listar');
    }
}
