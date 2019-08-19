<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use DB;
use App\Venda;
use App\Produto;
use App\Saida;
use App\Cliente;
use App\Http\Requests\VendaRequest;

class VendaController extends Controller
{
    public function listarVenda(){

        $vendas = DB::select( DB::raw("SELECT v.id_venda,v.valor_venda,v.desconto,v.divulgacao,
                                              v.porcentagem,v.online,v.created_at,c.nome, v.troca,
                                              v.tipo_pagamento
                                       FROM vendas v
                                       LEFT JOIN clientes c ON c.id_clientes = v.fk_cliente") );

    	return view('venda.listagem')->with(['vendas' => $vendas]);
    }

    public function novo(){
        $produtos = Produto::all();
    	$clientes = Cliente::all();
        return view('venda.formulario')->with(['produtos' => $produtos,'clientes' => $clientes]);
    }

    public function adiciona(VendaRequest $request){

        $request = Request::all();
        $tamanho = count($request["saida"]["quantidade"]);

        $request["created_at"] = date("Y-m-d H:i:s",strtotime($request["created_at"]));

        $venda = Venda::create(['valor_venda' => $request["valor_venda"],'desconto' => $request["desconto"],'porcentagem' => $request["porcentagem"],'online' => $request["online"],'divulgacao' => $request["divulgacao"],
            'fk_cliente' => $request["fk_cliente"], 'created_at' => $request["created_at"], 'tipo_pagamento' => $request["tipo_pagamento"]] );

        $insertedId = $venda->id_venda;

        for($i = 0;$i <= $tamanho - 1;$i++){
            Saida::create(['fk_produto' => $request["saida"]["fk_produto"][$i], 'quantidade' => $request["saida"]["quantidade"][$i],'created_at' => $request["created_at"],'fk_venda' => $insertedId]);
        }

        Request::session()->flash('message.level', 'success');
        Request::session()->flash('message.content', 'Venda Adicionada com Sucesso!');
		
		return redirect()->action('VendaController@listarVenda')->withInput(Request::only('nome'));
	}

    public function remove($id_venda){

        try{
            $venda = Venda::find($id_venda);
            $venda->delete();

            Request::session()->flash('message.level', 'danger');
            Request::session()->flash('message.content', 'Venda Removida com Sucesso!');
        } catch (\Exception $e){
            DB::rollback();
            Request::session()->flash('message.level', 'danger');
            Request::session()->flash('message.content', 'Para apagar esta venda. Você precisa excluir todas as saídas vinculadas a esta venda.');
        }    

        return redirect()
               ->action('VendaController@listarVenda');
    }

    public function mostra($id){

        $venda = Venda::find($id);

        $produtosSaida = Produto
        ::join('saidas','saidas.fk_produto', '=', 'produtos.id_produto')
        ->join('vendas', 'vendas.id_venda', '=', 'saidas.fk_venda')
        ->select('produtos.descricao','produtos.id_produto','produtos.valor','saidas.quantidade','produtos.codigo_produto','saidas.id_saida','saidas.fk_venda')
        ->where('saidas.fk_venda','=',$venda->id_venda)
        ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
        ->get();

        $clientes = Cliente::all();
        $produtos = Produto::all();
        $tipo_pagamento = ['Débito', 'Crédito', 'Dinheiro'];

        if(empty($venda)) {
            return "Essa venda não existe";
        }
        return view('venda.edita')->with(['v'=> $venda, 'produtos' => $produtos,'clientes' => $clientes, 'produtosSaida' => $produtosSaida, 'tipo_pagamento' => $tipo_pagamento]);
    }

    public function edita($id_venda){

        $venda = Venda::find($id_venda);
        $params = Request::all();
        $params["created_at"] = date("Y-m-d H:i:s",strtotime($params["created_at"]));
        $venda->update($params);
        $tamanho = count($params["saida"]["quantidade"]);

        $saida = Saida::where('fk_venda', $params["fk_venda"]);
        $saida->delete();

        for($i = 0;$i <= $tamanho - 1;$i++){
            Saida::create(['fk_produto' => $params["saida"]["fk_produto"][$i], 'quantidade' => $params["saida"]["quantidade"][$i],'created_at' => $params["created_at"],'fk_venda' => $params["id_venda"]]);
        }

        Request::session()->flash('message.level', 'success');
        Request::session()->flash('message.content', 'Venda Alterada com Sucesso!');

        return redirect()
               ->action('VendaController@listarVenda');
    }

}