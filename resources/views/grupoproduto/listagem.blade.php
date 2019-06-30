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
        <img src="{{ $grupoProduto->imagens }}" width="30%">
        <div class="caption">
            <h3>{{ $grupoProduto->descricao }}</h3>
            <p>Entradas: {{ $grupoProduto->quantidadeEntrada ? $grupoProduto->quantidadeEntrada : 0  }}</p>
            <p>Saídas: {{ $grupoProduto->quantidadeSaida ? $grupoProduto->quantidadeSaida : 0  }}</p>
            <p>Total: {{ $grupoProduto->quantidadeEntrada - $grupoProduto->quantidadeSaida }}</p>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Transação</th>
                <th>Data</th>
                <th>Quantidade</th>
                <th>Dias</th>
            </tr>
            </thead>
            <tbody>
            @foreach($linhaTempoGeral as $linha)
                <tr>  
                @if($grupoProduto->id_produto == $linha->id_produto)
                    <td> {{ $linha->transacao }}</td>
                    <td>{{ date('d/m/Y', strtotime($linha->data)) }}</td>
                    <td>{{ $linha->quantidade }}</td>
                    <?php $diferenca = strtotime('today') - strtotime($linha->data) ?>
                    <td>{{ $dias = floor($diferenca / (60 * 60 * 24) + 1) }}</td>
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