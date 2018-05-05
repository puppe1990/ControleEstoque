@extends('layout.principal')
@section('conteudo')

<fieldset>
    <!-- Form Name -->
    <legend>Cadastro de Venda</legend>

    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="produto">Código/Nome do Produto</label>
        <div class="col-md-3">
            <select id="categoria" class="form-control">
                @foreach($produtos as $p)
                    <option label="{{ $p->valor }}" value="{{ $p->codigo_produto }}">{!! $p->codigo_produto !!} - {!! $p->descricao !!}</option>
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
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <fieldset>
        <div class="form-group">
            <label class="col-md-4 control-label" for="cliente">Nome da Cliente</label>
            <div class="col-md-3">
                <select id="nomeClientes" name="fk_cliente" class="form-control">
                    @foreach($clientes as $c)
                        <option value="{{ $c->id_clientes }}">{{ $c->nome }}</option>
                    @endforeach
                </select>                
            </div>
        </div>
            <div class="container">
                <div class="row" id="lista">
                </div>
            </div>           

        <div class="form-group">
            <label class="col-md-4 control-label" for="porcentagem">Desconto %</label>  
            <div class="col-md-3">
                <input id="descontoPorcent" name="porcentagem" onfocus="this.value=''" onchange="calcularDescontoPorcent()" value="{{ old('descontoPorcent') }}" type="text" placeholder="Insira desconto em porcentagem do produto" class="form-control input-md">
            </div>
        </div> 

        <div class="form-group">
            <label class="col-md-4 control-label" for="desconto">Desconto R$</label>  
            <div class="col-md-3">
                <input id="desconto" name="desconto" onfocus="this.value=''" onchange="calcularDesconto()" value="{{ old('desconto') }}" type="text" placeholder="Insira desconto em dinheiro do produto" class="form-control input-md">
            </div>
        </div> 

        <div class="form-group">
            <label class="col-md-4 control-label" for="quantidade">Data Saída</label>  
            <div class="col-md-3">
                <input name="created_at" id="datetime" value="{{ old('created_at') }}" type="datetime-local" placeholder="Insira um valor" class="form-control input-md" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="quantidade">On-line</label>  
            <div class="col-md-3">
                <input name="online" id="online" type="checkbox" value="1">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="desconto">Total</label>  
            <div class="col-md-3">
                <input id="total" name="total" value="{{ old('total') }}" type="text" class="form-control input-md" disabled>
                <input id="valorVenda" name="valor_venda" type="hidden">
            </div>
        </div>
        
    </fieldset>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-5 control-label" for="salvar"></label>
            <div class="col-md-3">
              <button class="btn btn-success" onclick="valorTotal()">SALVAR</button>
            </div>
        </div> 
</form>



@stop