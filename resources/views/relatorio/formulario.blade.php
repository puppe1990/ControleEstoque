@extends('layout.principal')
@section('conteudo')

<form class="form-horizontal" method="post" action="/ListarRelatorio/mostrar/">
    <fieldset>

        <!-- Form Name -->
        <legend>Listar Relatorio</legend>

        <!-- Text input-->
        <div class="form-group">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label class="col-md-4 control-label" for="textinput">Selecione o Relatório</label>  
            <div class="col-md-4">
              <select id="categoria" name="id_relatorio" value="{{ old('id_relatorio') }}" class="form-control js-example-basic-multiple-limit">
                      <option value="1">Produtos Mais Vendidos</option>
                      <option value="2">Categorias Mais Vendidas</option>
                      <option value="3">Categorias Mais Entradas</option>
                      <option value="4">Quantidade de vendas on-line</option>
              </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="quantidade">Data Início</label>  
            <div class="col-md-4">
                <input name="inicio" id="datetime" value="{{ old('inicio') }}" type="date" placeholder="Insira um valor" class="form-control input-md" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="quantidade">Data Final</label>  
            <div class="col-md-4">
                <input name="fim" id="datetime" value="{{ old('fim') }}" type="date" placeholder="Insira um valor" class="form-control input-md" required>
            </div>
        </div>
        

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="salvar"></label>
            <div class="col-md-4">
              <button class="btn btn-success">GERAR RELATÓRIO</button>
            </div>
        </div>   

    @if(isset($relatorios))
        @switch($_REQUEST["id_relatorio"])
            @case(1)
                <table id="listagem" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Código Produto</th>
                        <th>Descrição</th>
                        <th>Quantidade</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($relatorios as $r)
                        <tr>
                          <td>{{ $r->codigo_produto }}</td>
                          <td>{{ $r->descricao }}</td>
                          <td>{{ $r->contador }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                @break
            @case(2)
                <table id="listagem" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Nome Categoria</th>
                        <th>Quantidade</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($relatorios as $r)
                        <tr>
                          <td>{{ $r->nome }}</td>
                          <td>{{ $r->contador }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                @break
            @case(3)
                <table id="listagem" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Nome Categoria</th>
                        <th>Quantidade</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($relatorios as $r)
                        <tr>
                          <td>{{ $r->nome }}</td>
                          <td>{{ $r->contador }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                @break           
            @case(4)

                <table id="listagem" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Valor</th>
                        <th>Quantidade de vendas</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($relatorios as $r)
                        <tr>
                          <td>R${{ $r->valor }}</td>
                          <td>{{ $r->quantidade }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                @break
                
            @default
                <h1>Erro!</h1>
        @endswitch            
    @endif   

    </fieldset>
</form>







@stop