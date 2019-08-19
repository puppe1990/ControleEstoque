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

  <table id="listagemVendas" class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Nome Cliente</th>
        <th>Valor Venda</th>
        <th>Desconto R$</th>
        <th>Desconto %</th>
        <th>Tipo de Pagamento</th>
        <th>On-Line</th>
        <th>Divulgação</th>
        <th>Troca</th>
        <th>Data</th>
        <th>Horário</th>
        <th>Editar Venda</th>
        <th>Remover Venda</th>
      </tr>
    </thead>
    <tbody>
      @foreach($vendas as $v)
        <tr>
          <td>{{ $v->id_venda }}</td>
          <td>{{ $v->nome }}</td>
          <td>R${{ number_format($v->valor_venda, 2, ',', '.') }}</td>
          <td>R${{ number_format($v->desconto, 2, ',', '.') }}</td>
          <td>{{ $v->porcentagem }}%</td>
          <td>{{ $v->tipo_pagamento }}</td>
          <td>{{ $v->online == 1 ? 'Sim' : 'Não' }}</td>
          <td>{{ $v->divulgacao == 1 ? 'Sim' : 'Não' }}</td>
          <td>{{ $v->troca == 1 ? 'Sim' : 'Não' }}</td>
          <td>{{ date('d/m/Y', strtotime($v->created_at)) }}</td>
          <td>{{ date('H:i:s', strtotime($v->created_at)) }}</td>
          <td><a href="/ListarVenda/mostrar/{{ $v->id_venda }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
          <td><a href="/ListarVenda/remove/{{ $v->id_venda }}"><span class="glyphicon glyphicon-trash"></span></a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop