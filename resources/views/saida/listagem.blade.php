@extends('layout.principal')
@section('conteudo')
<div class="container">
  <h2>Saídas</h2>
  <ul class="nav navbar-nav">
    <li><a href="{{action('ProdutoController@novo')}}">Lançar Saída</a></li>
  </ul>  

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Código Produto</th>
        <th>Descrição</th>
        <th>Valor</th>
        <th>Data</th>
        <th>Quantidade</th>
      </tr>
    </thead>
    <tbody>
      @foreach($produtos as $p)
        <tr>
          <td>{{ $p->codigo_produto }}</td>
          <td>{{ $p->descricao }}</td>
          <td>R$ {{ $p->valor }}</td>
          <td>{{ $p->created_at }}</td>
          <td>{{ $p->quantidade }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop