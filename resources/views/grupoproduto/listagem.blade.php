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
                <h3>Nome do Grupo: {{ $grupoProduto->nome }}</h3>
                <p>Entrada: {{ $grupoProduto->quantidadeEntrada }}</p>
                <p>Saída: {{ $grupoProduto->quantidadeSaida }}</p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Entrada</th>
                            <th>Saída</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                @if($grupoProduto->nome == $produto->nome)
                                    <td>{{ $produto->id_produto }}</td>
                                    <td>{{ $produto->descricao }}</td>
                                    <td>{{ $produto->quantidadeEntrada }}</td>
                                    <td>{{ $produto->quantidadeSaida }}</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>
</div>
@stop