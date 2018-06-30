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
        <img src="{{ $destaque->imagens }}" width="300">
        <div class="caption">
          <h3>{{ $destaque->descricao }}</h3>
          <p>Entradas: {{ $destaque->quantidadeEntrada ? $destaque->quantidadeEntrada : 0  }}</p>
          <p>Saídas: {{ $destaque->quantidadeSaida ? $destaque->quantidadeSaida : 0  }}</p>
          <p>Total: {{ $destaque->quantidadeEntrada - $destaque->quantidadeSaida }}</p>
        </div>
      </div>
    </div>
  @endforeach
</div>

  
</div>
@stop