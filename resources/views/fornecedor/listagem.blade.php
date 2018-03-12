@extends('layout.principal')
@section('conteudo')
<div class="container">
  <h2>Fornecedores</h2>     
  <ul>
      <li><a href="{{action('FornecedorController@novo')}}">Cadastrar Fornecedor</a></li>
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
        <th>Nome Fornecedor</th>
        <th>Celular</th>
        <th>E-Mail</th>
        <th>Editar Fornecedor</th>
        <th>Remover Fornecedor</th>
      </tr>
    </thead>
    <tbody>
      @foreach($fornecedores as $f)
        <tr>
          <td>{{ $f->id_fornecedor }}</td>
          <td>{{ $f->nome_loja }}</td>
          <td>{{ $f->celular }}</td>
          <td>{{ $f->email }}</td>
          <td><a href="/ListarFornecedor/mostrar/{{ $f->id_fornecedor }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
          <td><a href="/ListarFornecedor/remove/{{ $f->id_fornecedor }}"><span class="glyphicon glyphicon-trash"></span></a></td>
        </tr>     

      @endforeach
    </tbody>
  </table>
</div>
@stop