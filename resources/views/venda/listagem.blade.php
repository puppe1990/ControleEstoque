@extends('layout.principal')
@section('conteudo')
<div class="container">
  <h2>Vendas</h2>     
  <ul>
      <li><a href="{{action('VendaController@novo')}}">Cadastrar Venda</a></li>
  </ul>  
  @if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}"> 
      {!! session('message.content') !!}
    </div>
  @endif

  <table id="listagem" class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Nome Categoria</th>
        <th>Editar Categoria</th>
        <th>Remover Categoria</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
@stop