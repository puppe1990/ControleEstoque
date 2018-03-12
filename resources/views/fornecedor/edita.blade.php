@extends('layout.principal')
@section('conteudo')

<form class="form-horizontal" method="post" action="/CadastrarFornecedor/edita/{{ $f->id_fornecedor }}">
      <fieldset>

      <!-- Form Name -->
      <legend>Cadastro de Fornecedor</legend>

      <!-- Text input-->
        <div class="form-group">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label class="col-md-4 control-label" for="textinput">Nome Fornecedor</label>  
            <div class="col-md-4">
                <input id="textinput" name="nome_loja" value="{{ $f->nome_loja }}" type="text" placeholder="Insira nome do fornecedor" class="form-control input-md" required>  
            </div>
            <input type="hidden" name="id_fornecedor" value="{{ $f->id_fornecedor }}">
        </div> 
                <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Celular</label>  
            <div class="col-md-4">
                <input id="textinput" name="celular" value="{{ $f->celular }}" type="text" placeholder="Insira celular do fornecedor" class="form-control input-md" required>  
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">E-Mail</label>  
            <div class="col-md-4">
                <input id="textinput" name="email" value="{{ $f->email }}" type="text" placeholder="Insira email do fornecedor" class="form-control input-md">  
            </div>
        </div>         
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Endereço</label>  
            <div class="col-md-4">
                <input id="textinput" name="endereco" value="{{ $f->endereco }}" type="text" placeholder="Insira endereço do fornecedor" class="form-control input-md">  
            </div>
        </div>        
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Ponto de Referência</label>  
            <div class="col-md-4">
                <input id="textinput" name="ponto_referencia" value="{{ $f->ponto_referencia }}" type="text" placeholder="Insira ponto de referência do fornecedor" class="form-control input-md">  
            </div>
        </div>         
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Observações</label>  
            <div class="col-md-4">
                <textarea id="textinput" name="observacao" rows="5"  type="text" placeholder="Insira observações sobre o fornecedor" class="form-control input-md">{{ $f->observacao }}</textarea>
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