@extends('layout.principal')
@section('conteudo')
<div class="container">
    <h2>Grupo de Produtos</h2>
    <ul>
        <li><a href="{{action('GrupoProdutoController@novo')}}">Cadastrar Grupo Produto</a></li>
    </ul>

    @if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}"> 
        {!! session('message.content') !!}
    </div>
    @endif

    <div class="row">
    @foreach($grupoProdutos as $grupoProduto)
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Entrada</th>
                            <th>Saída</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $entrada = 0; 
                            $saida = 0;
                        ?>
                        @foreach($produtos as $produto)
                            <tr>
                                @if($grupoProduto->nome == $produto->nome)
                                    <td>{{ $produto->codigo_produto }}</td>
                                    <td>{{ $produto->descricao }}</td>
                                    <td>{{ $produto->quantidadeEntrada ? $produto->quantidadeEntrada : 0  }}</td>
                                    <td>{{ $produto->quantidadeSaida ? $produto->quantidadeSaida : 0 }}</td>
                                    <td>{{ $produto->quantidadeEntrada - $produto->quantidadeSaida }}</td>
                                    <?php
                                        $entrada = $entrada + $produto->quantidadeEntrada;
                                        $saida = $saida + $produto->quantidadeSaida; ?>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                    <h3>Nome do Grupo: {{ $grupoProduto->nome }}</h3>
                    <p>Entrada: {{ $entrada }}</p>
                    <p>Saída: {{ $saida }}</p>
                </table>
            </div>
        </div>
    @endforeach
</div>
</div>
@stop