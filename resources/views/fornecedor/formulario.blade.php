@extends('layout.principal')
@section('conteudo')

<form class="form-horizontal" method="post" action="/CadastrarFornecedor/adiciona">
      <fieldset>

      <!-- Form Name -->
      <legend>Cadastro de Fornecedor</legend>

      <!-- Text input-->
        <div class="form-group">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label class="col-md-4 control-label" for="textinput">Nome Fornecedor</label>  
            <div class="col-md-4">
                <input id="textinput" name="nome_loja" value="{{ old('nome_loja') }}" type="text" placeholder="Insira nome do fornecedor" class="form-control input-md" required>  
            </div>
        </div> 
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Celular</label>  
            <div class="col-md-4">
                <input id="textinput" name="celular" value="{{ old('celular') }}" type="text" placeholder="Insira celular do fornecedor" class="form-control input-md" required>  
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">E-Mail</label>  
            <div class="col-md-4">
                <input id="textinput" name="email" value="{{ old('email') }}" type="text" placeholder="Insira email do fornecedor" class="form-control input-md">  
            </div>
        </div>         
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Endereço</label>  
            <div class="col-md-4">
                <input id="textinput" name="endereco" value="{{ old('endereco') }}" type="text" placeholder="Insira endereço do fornecedor" class="form-control input-md">  
            </div>
        </div>        
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Ponto de Referência</label>  
            <div class="col-md-4">
                <input id="textinput" name="ponto_referencia" value="{{ old('ponto_referencia') }}" type="text" placeholder="Insira ponto de referência do fornecedor" class="form-control input-md">  
            </div>
        </div>         
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Observações</label>  
            <div class="col-md-4">
                <textarea id="textinput" name="observacao" rows="5" value="{{ old('observacao') }}" type="text" placeholder="Insira observações sobre o fornecedor" class="form-control input-md"></textarea>
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