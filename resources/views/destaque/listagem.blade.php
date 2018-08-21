@extends('layout.principal')
@section('conteudo')
<div class="container">
  <h2>Produtos Estrelas</h2>     

  @if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}"> 
      {!! session('message.content') !!}
    </div>
  @endif

  <div class="row">
  @foreach($destaques as $destaque)  
    <div class="col-sm-6 col-md-4">
      <div class="thumbnail">
        <img src="{{ $destaque->imagens }}" width="30%">
        <div class="caption">
          <h3>{{ $destaque->descricao }}</h3>
          <p>Entradas: {{ $destaque->quantidadeEntrada ? $destaque->quantidadeEntrada : 0  }}</p>
          <p>Saídas: {{ $destaque->quantidadeSaida ? $destaque->quantidadeSaida : 0  }}</p>
          <p>Total: {{ $destaque->quantidadeEntrada - $destaque->quantidadeSaida }}</p>
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
                @if($destaque->id_produto == $linha->id_produto)
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