<?php

namespace App\Http\Controllers;

use Request;
use App\Destaque;
use App\Produto;
use App\Http\Requests\DestaquesRequest;
use DB;

class DestaqueController extends Controller
{
    public function listar(){

        $destaques = Produto
            ::leftJoin('entradas', 'produtos.id_produto', '=', 'entradas.fk_produto')
            ->leftJoin(DB::raw('(select produtos.id_produto,sum(saidas.quantidade) as quantidadeSaida
                                from saidas 
                                inner join produtos on produtos.id_produto = saidas.fk_produto
                                group by produtos.id_produto) as temp'), 'temp.id_produto', '=', 'produtos.id_produto')
            ->join('categorias', 'categorias.id_categoria', '=', 'produtos.fk_categoria')
            ->select('produtos.id_produto','produtos.codigo_produto','produtos.descricao', 'produtos.valor',DB::raw('sum(entradas.quantidade) as quantidadeEntrada'),'temp.quantidadeSaida','categorias.nome','produtos.path_image as imagens')
            ->where('destaque', '=', 1)
            ->groupBy('produtos.descricao','produtos.codigo_produto','produtos.valor','produtos.id_produto','categorias.nome','produtos.path_image','temp.quantidadeSaida')
            ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
            ->orderBy('quantidadeSaida','DESC')
            ->get();

        $linhaTempoEntrada = Produto
            ::join('entradas', 'produtos.id_produto', '=', 'entradas.fk_produto')
            ->select(DB::raw("'Entrada' as transacao"),'entradas.created_at as data','entradas.quantidade','produtos.id_produto')
            ->where('destaque', '=', 1);        

        $linhaTempoGeral = Produto
            ::join('saidas', 'produtos.id_produto', '=', 'saidas.fk_produto')
            ->select(DB::raw("'Saida' as transacao"),'saidas.created_at as data','saidas.quantidade','produtos.id_produto')
            ->where('destaque', '=', 1)
            ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
            ->union($linhaTempoEntrada)
            ->orderBy('data','ASC')
            ->get();

    	return view('destaque.listagem')->with(['destaques' => $destaques,'linhaTempoGeral' => $linhaTempoGeral]);
    }

}
