@extends('layout.principal')
@section('conteudo')
<div class="container">
  <h2>Clientes</h2>     
  <ul>
      <li><a href="{{action('ClienteController@novo')}}">Cadastrar Cliente</a></li>
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
        <th>Nome Cliente</th>
        <th>CPF</th>
        <th>Celular</th>
        <th>E-Mail</th>
        <th>Data de inclusão</th>
        <th>Horário</th>
        <th>Editar Cliente</th>
        <th>Remover Cliente</th>
      </tr>
    </thead>
    <tbody>
      @foreach($clientes as $c)
        <tr>
          <td>{{ $c->id_clientes }}</td>
          <td>{{ $c->nome }}</td>
          <td>{{ $c->cpf }}</td>
          <td>{{ $c->celular }}</td>
          <td>{{ $c->email }}</td>
          <td>{{ date('d/m/Y', strtotime($c->created_at)) }}</td>
          <td>{{ date('H:i:s', strtotime($c->created_at)) }}</td>
          <td><a href="/ListarCliente/mostrar/{{ $c->id_clientes }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
          <td><a href="/ListarCliente/remove/{{ $c->id_clientes }}"><span class="glyphicon glyphicon-trash"></span></a></td>
        </tr>     

      @endforeach
    </tbody>
  </table>
</div>
@stop