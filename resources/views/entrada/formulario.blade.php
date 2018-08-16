@extends('layout.principal')
@section('conteudo')

<form class="form-horizontal" method="post" action="/LancarEntrada/adiciona">
    <fieldset>

    <!-- Form Name -->
    <legend>Lançamento de entrada</legend>
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

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="produto">Código/Nome do Produto</label>
        <div class="col-md-4">
            <select id="categoria" name="fk_produto" class="form-control">
                @foreach($produtos as $p)
                    <option value="{{ $p->id_produto}}">{!! $p->codigo_produto !!} - {!! $p->descricao !!}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="quantidade">Data Entrada</label>  
        <div class="col-md-4">
            <input name="created_at" value="{{ old('created_at') }}" id="datetime" type="datetime-local" placeholder="Insira um valor" class="form-control input-md" required>
        </div>
        <div onclick="inserirHoraAtual()" class="btn btn-success">INCLUIR HORÁRIO ATUAL</div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="quantidade">Quantidade</label>  
        <div class="col-md-4">
            <input id="valor" name="quantidade" value="{{ old('quantidade') }}" type="text" placeholder="Insira quantidade do produto" class="form-control input-md" required>
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