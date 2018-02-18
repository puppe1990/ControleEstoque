@extends('layout.principal')
@section('conteudo')

    <fieldset>
        <!-- Form Name -->
        <legend>Cadastro de Venda</legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="produto">Código/Nome do Produto</label>
            <div class="col-md-3">
                <select id="categoria" name="fk_produto" class="form-control">
                    @foreach($produtos as $p)
                        <option value="{{ $p->valor}}">{!! $p->codigo_produto !!} - {!! $p->descricao !!}</option>
                    @endforeach
                </select>                
            </div>
            <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-number" onclick="listaVenda()" data-type="plus" data-field="quant[1]">
                          <span class="glyphicon glyphicon-plus"></span>
                      </button>
                </span>
        </div>
    </fieldset>
<form class="form-horizontal" method="post" action="/CadastrarVenda/adiciona">

    <fieldset>
        <div class="form-group">
            <div class="col-md-offset-3 col-md-2" for="desconto">
                <div id="label"></div>
            </div>  
            <div class="col-md-3">
                <div id="lista"></div>
            </div>
        </div>        

        <div class="form-group">
            <label class="col-md-4 control-label" for="desconto">Desconto</label>  
            <div class="col-md-3">
                <input id="desconto" name="desconto" value="{{ old('desconto') }}" type="text" placeholder="Insira desconto do produto" class="form-control input-md" required>
            </div>
        </div> 

        <div class="form-group">
            <label class="col-md-4 control-label" for="desconto">Total</label>  
            <div class="col-md-3">
                <input id="total" name="total" value="{{ old('total') }}" type="text" class="form-control input-md" disabled required>
            </div>
        </div>
        
    </fieldset>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-5 control-label" for="salvar"></label>
            <div class="col-md-3">
              <button class="btn btn-success">SALVAR</button>
            </div>
        </div> 
</form>



@stop