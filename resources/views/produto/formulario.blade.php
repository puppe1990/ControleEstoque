@extends('layout.principal')
@section('conteudo')

<form class="form-horizontal" method="post" action="/NovoProduto/adiciona" enctype="multipart/form-data">
    <fieldset>


    <!-- Form Name -->
    <legend>Cadastro de Produto</legend>

    @if (count($errors) > 0)
        <div class="form-group">
            <div class="col-md-6 col-xs-6 col-sm-6">
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error) 
                        <li>{{ $error }}</li>
                    @endforeach 
                    </ul>   
                </div>
            </div>    
        </div>    
    @endif  

    {{ csrf_field() }}
    
    <!-- Text input-->
    <div class="form-group">
        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->

        <label class="col-md-4 control-label" for="textinput">Código do Produto</label>  
        <div class="col-md-4">
            <input id="textinputcadastro" name="codigo_produto" value="{{ old('codigo_produto') }}" type="text" placeholder="Insira um código" class="form-control input-md" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label" for="textinput">Descrição</label>  
        <div class="col-md-4">
            <input id="textinput" name="descricao" value="{{ old('descricao') }}" type="text" placeholder="Insira uma descrição" class="form-control input-md" required>
        </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="valor">Valor Venda</label>  
        <div class="col-md-4">
            <input id="valor" name="valor" value="{{ old('valor') }}" type="text" placeholder="Insira o valor do produto" class="form-control input-md" required>
        </div>
    </div>    

    <div class="form-group">
      <label class="col-md-4 control-label" for="valor">Valor Compra</label>  
        <div class="col-md-4">
            <input id="valor_compra" name="valor_compra" value="{{ old('valor_compra') }}" type="text" placeholder="Insira o valor de compra" class="form-control input-md" required>
        </div>
    </div>

    <!-- Select Basic -->
    <div class="form-group">
        <label class="col-md-4 control-label" for="categoria">Categoria</label>
        <div class="col-md-4">
            <select id="categoria" name="fk_categoria" value="{{ old('fk_categoria') }}" class="form-control js-example-basic-multiple-limit">
                @foreach($categorias as $c)
                    <option value="{{ $c->id_categoria }}">{{ $c->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label" for="destaque">Destaque</label>  
        <div class="col-md-3">
            <input name="destaque" type="hidden" value="0">
            <input name="destaque" id="destaque" type="checkbox" value="1">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label" for="categoria">Inserir Foto</label>
        <div class="col-md-4">
            <input type='file' id="primaryImage" name="primaryImage" value="{{ old('primaryImage') }}" accept="image/*" />
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