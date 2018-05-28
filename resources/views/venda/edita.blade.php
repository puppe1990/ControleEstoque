@extends('layout.principal')
@section('conteudo')

<fieldset>
    <!-- Form Name -->
    <legend>Edita Venda
        <button type="button" class="btn btn-default btn-number">
            <a href="{{action('ClienteController@novo')}}" target="_blank">
                <span class="glyphicon glyphicon-user">Cadastrar Cliente</span>
            </a>
        </button>
    </legend>

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
<form class="form-horizontal" method="post" action="/CadastrarVenda/edita/{{ $v->id_venda }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <fieldset>
        <div class="form-group">
            <label class="col-md-4 control-label" for="cliente">Nome da Cliente</label>
            <div class="col-md-3">
                <select id="nomeClientes" name="fk_cliente" class="form-control">
                  @foreach($clientes as $c)
                    @if($v->fk_cliente == $c->id_clientes)
                        <option value="{{ $c->id_clientes}}" selected>{{ $c->nome }}</option>
                    @else
                        <option value="{{ $c->id_clientes }}">{{ $c->nome }}</option> 
                    @endif    
                  @endforeach            
                </select>    
            </div>
        </div>
        <div class="container">
            <div class="row" id="lista">
                <?php $cont = 0;  ?>
                @foreach($produtosSaida as $ps)
                    <div id="row{{$cont}}">
                        <div class="col-md-3">
                            <label>Produto</label>
                            <input type="text" class="form-control input-md" disabled="" value="{!! $ps->codigo_produto !!} - {!! $ps->descricao !!}">
                        </div>
                        <input id="fk_produto" name="saida[fk_produto][]" type="hidden" value="{{ $ps->id_produto }}">
                        <div class="col-md-3">
                            <label>Quantidade</label>
                            <input type="text" class="form-control input-md" name="saida[quantidade][]" value="{{ $ps->quantidade }}" id="{{$cont}}" pattern="[0-9]+$" onkeyup="atualizaSubTotal(this.value,this.id)" onfocus="this.value=''" onchange="atualizaTotal('geral')">
                        </div>
                        <div class="col-md-2">
                            <label>Valor</label>
                            <input type="text" class="form-control input-md" id="valor{{$cont}}" disabled="" value="{{ $ps->valor }}">
                        </div>
                        <div class="col-md-2">
                            <label>Sub Valor</label>
                            <input type="text" class="form-control input-md subtotal" value="{{$ps->valor * $ps->quantidade}}" id="subtotal{{$cont}}" disabled="">
                        </div> 
                        <div class="col-md-1">
                            <label>Deletar</label>
                            <button type="button" class="btn btn-danger btn-sm" id="{{$cont}}" onclick="deletaProduto(this.id)">Deletar Produto</button></div>
                            <input type="hidden" name="saida[id_saida][]" value="{{ $ps->id_saida }}">
                        </div>     
                        <input type="hidden" name="fk_venda" value="{{ $ps->fk_venda }}">
                    <?php $cont++?> 
                @endforeach
                <input type="hidden" id="cont" value="{{ $cont }}">
            </div>
        </div>        
        <div class="form-group"></div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="porcentagem">Desconto %</label>  
            <div class="col-md-3">
                <input id="descontoPorcent" name="porcentagem" onfocus="this.value=''" onchange="calcularDescontoPorcent()" value="{{ $v->porcentagem }}" type="text" placeholder="Insira desconto em porcentagem do produto" class="form-control input-md">
            </div>
        </div> 

        <div class="form-group">
            <label class="col-md-4 control-label" for="desconto">Desconto R$</label>  
            <div class="col-md-3">
                <input id="desconto" name="desconto" onfocus="this.value=''" onchange="calcularDesconto()" value="{{ $v->desconto }}" type="text" placeholder="Insira desconto em dinheiro do produto" class="form-control input-md">
            </div>
        </div> 

        <div class="form-group">
            <label class="col-md-4 control-label" for="quantidade">Data Saída</label>  
            <div class="col-md-3">
                <input name="created_at" id="datetime" value="{{ date('Y-m-d\TH:i:s', strtotime($v->created_at)) }}" type="datetime-local" placeholder="Insira um valor" class="form-control input-md" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="quantidade">On-line</label>  
            <div class="col-md-3">
                <input name="online" type="hidden" value="0">
                {!! $v->online == 1 ? '<input name="online" id="online" type="checkbox" value="1" checked>': '<input name="online" id="online" type="checkbox" value="1">' !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="desconto">Total</label>  
            <div class="col-md-3">
                <input id="total" name="total" value="{{ $v->valor_venda }}" type="text" class="form-control input-md" disabled>
                <input id="valorVenda" name="valor_venda" type="hidden">
            </div>
        </div>
        <input type="hidden" name="id_venda" value="{{ $v->id_venda }}">
        
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