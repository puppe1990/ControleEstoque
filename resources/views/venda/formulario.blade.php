@extends('layout.principal')
@section('conteudo')
<form class="form-horizontal" method="post" action="/CadastrarVenda/adiciona">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="container">
        <div class="row">
            <fieldset>
                <!-- Form Name -->
                <legend>Cadastro de Venda
                    <button type="button" class="btn btn-default btn-number">
                        <a href="{{action('ClienteController@novo')}}" target="_blank">
                            <span class="glyphicon glyphicon-user">Cadastrar Cliente</span>
                        </a>
                    </button>
                </legend>
                <!-- Text input-->
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="cliente">Nome da Cliente</label>
                        <div class="col-md-3">
                            <select id="nomeClientes" name="fk_cliente" class="form-control">
                                @foreach($clientes as $c)
                                    <option value="{{ $c->id_clientes }}">{{ $c->cpf }} - {{ $c->nome }}</option>
                                @endforeach
                            </select>                
                        </div>
                    </div>
                </div>

                <div class="col-md-12">     
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="produto">Código/Nome do Produto</label>
                        <div class="col-md-3">
                            <select id="categoria" class="form-control">
                                @foreach($produtos as $p)
                                    <option label="{{ $p->valor }}" value="{{ $p->id_produto }}">{!! $p->codigo_produto !!} - {!! $p->descricao !!}</option>
                                @endforeach
                            </select>                
                        </div>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-number" onclick="listaVenda()" data-type="plus" data-field="quant[1]">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </span>
                    </div>
                </div>    
            </fieldset>   
            <fieldset>     
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
                    <div onclick="inserirHoraAtual()" class="btn btn-success">INCLUIR HORÁRIO ATUAL</div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="tipo_pagamento">Tipo de pagamento</label>
                    <div class="col-md-3">
                        <select class="form-control" id="tipo_pagamento" name="tipo_pagamento">
                            <option value="1">Débito</option>
                            <option value="2">Crédito</option>
                            <option value="3">Dinheiro</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="quantidade">On-line/MotoBoy</label>  
                    <div class="col-md-3">
                        <input name="online" type="hidden" value="0">
                        <input name="online" id="online" type="checkbox" value="1">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="quantidade">Troca</label>
                    <div class="col-md-3">
                        <input name="troca" type="hidden" value="0">
                        <input name="troca" id="troca" type="checkbox" value="1">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="divulgacao">Divulgação</label>  
                    <div class="col-md-3">
                        <input name="divulgacao" type="hidden" value="0">
                        <input name="divulgacao" id="divulgacao" type="checkbox" value="1">
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
        </div>     
    </div>  
</form>

@stop