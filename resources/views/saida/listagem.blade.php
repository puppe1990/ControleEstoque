@extends('layout.principal')
@section('conteudo')
<div class="container">
  <h2>Saídas</h2>
  @if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}"> 
      {!! session('message.content') !!}
    </div>
  @endif

  <table id="listagem" class="table table-bordered">
    <thead>
      <tr>
        <th>Código Produto</th>
        <th>Foto</th>
        <th>Descrição</th>
        <th>Valor</th>
        <th>Data</th>
        <th>Horário</th>
        <th>Quantidade</th>
        <th>Código da Venda</th>
        <th>Mostrar</th>
        <th>Excluir</th>
      </tr>
    </thead>
    <tbody>
      @foreach($produtos as $p)
        <tr>
          <td>{{ $p->codigo_produto }}</td>
          <td id="imagem">{!! $p->imagens ? "<img width=\"150\" src=\"$p->imagens\">" : 'Sem Foto' !!}</td>
          <td>{{ $p->descricao }}</td>
          <td>R$ {{ $p->valor }}</td>
          <td>{{ date('d/m/Y', strtotime($p->created_at)) }}</td>
          <td>{{ date('H:i:s', strtotime($p->created_at)) }}</td>
          <td>{{ $p->quantidade }}</td>
          <td>{{ $p->fk_venda }}</td>
          <td><a href="/ListarSaida/mostrar/{{ $p->id_saida }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
          <td><a href="/ListarSaida/remove/{{ $p->id_saida }}"><span class="glyphicon glyphicon-trash"></span></a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop