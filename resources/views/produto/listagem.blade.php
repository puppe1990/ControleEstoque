@extends('layout.principal')
@section('conteudo')
<div class="container">
  <h2>Produtos</h2>
  <ul class="nav navbar-nav">
    <li><a href="{{action('ProdutoController@novo')}}">Cadastrar Produto</a></li>
  </ul>  

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Código Produto</th>
        <th>Descrição</th>
        <th>Valor</th>
        <th>Entrada</th>
        <th>Saída</th>
        <th>Saldo</th>
        <th>Editar</th>
        <th>Excluir</th>
      </tr>
    </thead>
    <tbody>
      @foreach($produtos as $p)
        <tr>
          <td>{{ $p->codigo_produto }}</td>
          <td>{{ $p->descricao }}</td>
          <td>R$ {{ $p->valor }}</td>
          <td>{{ $p->quantidade }}</td>
          <td></td>
          <td></td>
          <td><a href="/Produtos/mostrar/{{ $p->id_produto }}"><span class="glyphicon glyphicon-trash"></span></a></td>
          <td><a href="/Produtos/remove/{{ $p->id_produto }}"><span class="glyphicon glyphicon-trash"></span></a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop