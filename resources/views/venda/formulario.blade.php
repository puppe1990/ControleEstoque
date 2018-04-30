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

    <fieldset>
        <!-- <div class="form-group">
            <label class="col-md-4 control-label" for="produto">Produto</label>   -->
            <div class="container">
                <div class="row" id="lista">
                    <!-- <div class="col-md-3">
                        <label for="fk_produto">Produto</label>
                        <input type="text" name="fk_produto" value="1" class="form-control input-md" disabled="">
                    </div>
                    <div class="col-md-3">
                        <label for="fk_produto">Quantidade</label>
                        <input type="text" class="form-control input-md" id="quantidade0" pattern="[0-9]+$" onkeyup="atualizaSubTotal(this.value,cont)" onfocus="this.value=''">
                    </div>
                    <div class="col-md-3">
                        <label for="fk_produto">Valor</label>
                        <input type="text" class="form-control input-md" id="valor1" disabled="">
                    </div>
                    <div class="col-md-3">
                        <label for="fk_produto">Produto</label>
                        <input type="text" class="form-control input-md" id="subtotal1" disabled="">
                    </div>
                </div>    
                <div class="row" id="lista">
                    <div class="col-md-3">
                        <label for="fk_produto">Produto</label>
                        <input type="text" name="fk_produto" value="1" class="form-control input-md" disabled="">
                    </div>
                    <div class="col-md-3">
                        <label for="fk_produto">Quantidade</label>
                        <input type="text" class="form-control input-md" id="quantidade1" pattern="[0-9]+$" onkeyup="atualizaSubTotal(this.value,cont)" onfocus="this.value=''">
                    </div>
                    <div class="col-md-3">
                        <label for="fk_produto">Valor</label>
                        <input type="text" class="form-control input-md" id="valor2" disabled="">
                    </div>
                    <div class="col-md-3">
                        <label for="fk_produto">Sub Total</label>
                        <input type="text" class="form-control input-md" id="subtotal2" disabled="">
                    </div> -->
                </div>
            </div>    
          <!--   </div>
        </div>  -->       

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