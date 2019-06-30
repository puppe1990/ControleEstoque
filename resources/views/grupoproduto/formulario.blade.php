@extends('layout.principal')
@section('conteudo')

<form class="form-horizontal" method="post" action="/NovoGrupoProduto/adiciona">
      <fieldset>

      <!-- Form Name -->
      <legend>Cadastro de Grupo de Produto</legend>

      <!-- Text input-->
        <div class="form-group">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label class="col-md-4 control-label" for="textinput">Nome</label>  
            <div class="col-md-4">
                <input id="textinput" name="nome" value="{{ old('nome') }}" type="text" placeholder="Insira nome do grupo de produto" class="form-control input-md" required>  
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-md-4 control-label" for="produto">Código/Nome do Produto</label>
                <div class="col-md-3">
                    <select id="categoria" class="form-control" name="produtos[]" multiple="multiple">
                        @foreach($produtos as $p)
                            <option label="{{ $p->valor }}" value="{{ $p->id_produto }}">{!! $p->codigo_produto !!} - {!! $p->descricao !!}</option>
                        @endforeach
                    </select>
                </div>
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