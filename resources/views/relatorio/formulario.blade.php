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
                      <option value="1">Produtos Mais Vendidos Loja Física</option>
                      <option value="2">Produtos Mais Vendidos Ecommerce</option>
                      <option value="3">Produtos Mais Vendidos Geral</option>
                      <option value="4">Categorias Mais Vendidas</option>
                      <option value="5">Categorias Mais Entradas</option>
                      <option value="6">Quantidade de vendas on-line/Ticket Médio por data</option>
                      <option value="7">Valor Total/Ticket Médio por data</option>
                      <option value="8">Gasto com Divulgação</option>
                      <option value="9">Clientes que mais compraram</option>
                      <option value="10">Valor Total em Roupas</option>
              </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="quantidade">Data Início</label>  
            <div class="col-md-4">
                <input name="inicio" id="datetimeinital" value="{{ old('inicio') }}" type="date" placeholder="Insira um valor" class="form-control input-md" required>
            </div>
            <div onclick="inserirPrimeiroDiaMes()" class="btn btn-success">INCLUIR PRIMEIRO DIA DO MÊS ATUAL</div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="quantidade">Data Final</label>  
            <div class="col-md-4">
                <input name="fim" id="datetime" value="{{ old('fim') }}" type="date" placeholder="Insira um valor" class="form-control input-md" required>
            </div>
          <div onclick="inserirDataAtualRelatorio()" class="btn btn-success">INCLUIR DATA ATUAL</div>
          <div onclick="inserirUltimosSeteDias()" class="btn btn-success">ÚLTIMOS 7 DIAS</div>
          <div onclick="inserirUltimosQuinzeDias()" class="btn btn-success">ÚLTIMOS 15 DIAS</div>
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
                        <th>Imagem</th>
                        <th>Descrição</th>
                        <th>Quantidade</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($relatorios as $r)
                        <tr>
                          <td>{{ $r->codigo_produto }}</td>
                          <td id="imagem">{!! $r->path_image ? "<img width=\"150\" src=\"$r->path_image\">" : 'Sem Foto' !!}</td>
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
                    <th>Código Produto</th>
                    <th>Imagem</th>
                    <th>Descrição</th>
                    <th>Quantidade</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($relatorios as $r)
                    <tr>
                      <td>{{ $r->codigo_produto }}</td>
                      <td id="imagem">{{ $r->path_image ? "<img width=\"150\" src=\"$r->path_image\">" : 'Sem Foto' }}</td>
                      <td>{{ $r->descricao }}</td>
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
                        <th>Valor Total</th>
                        <th>Quantidade de vendas</th>
                        <th>Ticket Médio On-line</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($relatorios as $r)
                        <tr>
                          <td>R${{ $r->valor }}</td>
                          <td>{{ $r->quantidade }}</td>
                          <td>R${{ $r->ticket_medio }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                @break
          @case(5)
            <table id="listagem" class="table table-bordered">
                <thead>
                  <tr>
                    <th>Valor Total</th>
                    <th>Quantidade de vendas</th>
                    <th>Ticket Médio Geral</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($relatorios as $r)
                    <tr>
                      <td>R${{ $r->valor }}</td>
                      <td>{{ $r->quantidade }}</td>
                      <td>R${{ $r->ticket_medio }}</td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
          @break
          @case(6)
            <table id="listagem" class="table table-bordered">
                <thead>
                  <tr>
                    <th>Valor Total</th>
                    <th>Quantidade de divulgações</th>
                    <th>Ticket Médio Geral</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($relatorios as $r)
                    <tr>
                      <td>R${{ $r->valor }}</td>
                      <td>{{ $r->quantidade }}</td>
                      <td>R${{ $r->ticket_medio }}</td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
          @break
          @case(7)
            <table id="listagem" class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nome Cliente</th>
                    <th>Celular</th>
                    <th>E-Mail</th>
                    <th>Nº de Vendas</th>
                    <th>Valor Total</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($relatorios as $r)
                    <tr>
                      <td>{{ $r->id_clientes }}</td>
                      <td>{{ $r->nome }}</td>
                      <td>{{ $r->celular }}</td>
                      <td>{{ $r->email }}</td>
                      <td>{{ $r->num_vendas }}</td>
                      <td>R${{ $r->valor }}</td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
          @break         
          @case(8)
            <table id="listagem" class="table table-bordered">
                <thead>
                  <tr>
                    <th class="text-center">Valor Venda</th>
                    <th class="text-center">Valor Compra</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($relatorios as $r)
                    <tr>
                      <td class="text-center">R${{ $r->valor_venda }}</td>
                      <td class="text-center">R${{ $r->valor_compra }}</td>
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