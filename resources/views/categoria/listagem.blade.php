@extends('layout.principal')
@section('conteudo')
<div class="container">
  <h2>Categorias</h2>     
  <ul>
      <li><a href="{{action('CategoriaController@novo')}}">Cadastrar Categoria</a></li>
  </ul>             
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Nome Categoria</th>
        <th>Editar Categoria</th>
        <th>Remover Categoria</th>
      </tr>
    </thead>
    <tbody>
      @foreach($categorias as $c)
        <tr>
          <td>{{ $c->id_categoria }}</td>
          <td>{{ $c->nome }}</td>
          <td><a href="/ListarCategoria/mostrar/{{ $c->id_categoria }}"><span class="glyphicon glyphicon-trash"></span></a></td>
          <td><a href="/ListarCategoria/remove/{{ $c->id_categoria }}"><span class="glyphicon glyphicon-trash"></span></a></td>
        </tr>     

      @endforeach
    </tbody>
  </table>
</div>
@stop