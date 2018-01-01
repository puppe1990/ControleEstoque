@extends('layout.principal')
@section('conteudo')

<form class="form-horizontal" method="post" action="/NovoProduto/edita/{{$p->id_produto}}">
    <fieldset>

    <!-- Form Name -->
    <legend>Cadastro de Produto</legend>

    <!-- Text input-->
    <div class="form-group">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <label class="col-md-4 control-label" for="textinput">Código do Produto</label>  
        <div class="col-md-4">
            <input id="textinput" name="codigo_produto" value="{{$p->codigo_produto}}" type="text" placeholder="Insira um código" class="form-control input-md" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label" for="textinput">Descrição</label>  
        <div class="col-md-4">
            <input id="textinput" name="descricao" value="{{$p->descricao}}" type="text" placeholder="Insira uma descrição" class="form-control input-md" required>
        </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="valor">Valor</label>  
        <div class="col-md-4">
            <input id="valor" name="valor" type="text" value="{{$p->valor}}" placeholder="Insira um valor" class="form-control input-md" required>
        </div>
    </div>

    <!-- Select Basic -->
    <div class="form-group">
        <label class="col-md-4 control-label" for="categoria">Categoria</label>
        <div class="col-md-4">
            <select id="categoria" name="fk_categoria" class="form-control">
                @foreach($categorias as $c)
                    @if($p->fk_categoria == $c->id_categoria)
                        <option value="{{ $c->id_categoria}}" selected>{{ $c->nome}}</option>
                    @else
                        <option value="{{ $c->id_categoria}}">{{ $c->nome}}</option> 
                    @endif    
                @endforeach
            </select>
        </div>
    </div>
    <!-- Button -->
    <div class="form-group">
        <label class="col-md-4 control-label" for="salvar"></label>
        <div class="col-md-4">
          <button class="btn btn-success">SALVAR</button>
        </div>
    </div>

    </fieldset>
</form>



@stop