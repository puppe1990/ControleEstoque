@extends('layout.principal')
@section('conteudo')

<form class="form-horizontal" method="post" action="/CadastrarCategoria/edita/{{ $c->id_categoria }}">
      <fieldset>

      <!-- Form Name -->
      <legend>Cadastro de Categoria</legend>

      <!-- Text input-->
        <div class="form-group">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label class="col-md-4 control-label" for="textinput">Nome</label>  
            <div class="col-md-4">
                <input id="textinput" name="nome" value="{{ $c->nome }}" type="text" placeholder="Insira nome da categoria" class="form-control input-md" required>  
            </div>
            <input type="hidden" name="id_categoria" value="{{ $c->id_categoria }}">
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