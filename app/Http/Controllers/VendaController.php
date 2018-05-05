<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use App\Venda;
use App\Produto;
use App\Saida;
use App\Cliente;
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
    	$clientes = Cliente::all();
        return view('venda.formulario')->with(['produtos' => $produtos,'clientes' => $clientes]);
    }

    public function adiciona(VendaRequest $request){

        $request = Request::all();
        $tamanho = count($request["saida"]["quantidade"]);

        // var_dump($request);exit;
        $request["created_at"] = date("Y-m-d H:i:s",strtotime($request["created_at"]));
        
        Venda::create(['valor_venda' => $request["valor_venda"],'desconto' => $request["desconto"],'porcentagem' => $request["porcentagem"],'online' => $request["online"],
            'fk_cliente' => $request["fk_cliente"],'created_at' => $request["created_at"]]);

        for($i = 0;$i <= $tamanho - 1;$i++){
            Saida::create(['fk_produto' => $request["saida"]["fk_produto"][$i], 'quantidade' => $request["saida"]["quantidade"][$i],'created_at' => $request["created_at"]]);
        }

        Request::session()->flash('message.level', 'success');
        Request::session()->flash('message.content', 'Venda Adicionada com Sucesso!');
		
		return redirect()->action('VendaController@listarVenda')->withInput(Request::only('nome'));
	}

    public function remove($id_venda){

        $venda = Venda::find($id_venda);
        $venda->delete();

        Request::session()->flash('message.level', 'danger');
        Request::session()->flash('message.content', 'Venda Removida com Sucesso!');

        return redirect()
               ->action('VendaController@listarVenda');
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
               ->action('VendaController@listarVenda');
    }

}
