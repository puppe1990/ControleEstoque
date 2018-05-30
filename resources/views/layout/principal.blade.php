<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.simplo7.net/static/17741/configuracao/favicon.png" type="image/x-icon" rel="shortcut icon" />
        <!-- <link rel="stylesheet" href="{{URL::asset('bootstrap/css/bootstrap.min.css')}}"> -->
        <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet"> -->
        <link href="/css/app.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
        <!-- <script src="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></script> -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        <!-- <link rel="stylesheet" type="text/css" href="/css/personal.css"> -->
        
        <meta name="viewport" content="width=device-width">

    	<title>Controle de Estoque Purchase Store</title>
    </head>
    <body>
    	<nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                  <a class="navbar-brand" href="{{action('ProdutoController@listar')}}">Purchase Store</a>
                </div>
            <div class="dropdown">
                <button class="btn btn-default btn-lg dropdown-toggle" type="button" data-toggle="dropdown">Menus
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li class="active"><a href="{{action('ProdutoController@listar')}}">Listar Produtos</a></li>
                    <li><a href="{{action('CategoriaController@listar')}}">Listar Categorias</a></li>
                    <li><a href="{{action('EntradaController@listarEntrada')}}">Listar Entradas de Produtos</a></li>
                    <li><a href="{{action('VendaController@listarVenda')}}">Listar Vendas</a></li>
                    <li><a href="{{action('ClienteController@novo')}}">Cadastrar Clientes</a></li>
                    <li><a href="{{action('ClienteController@listar')}}">Listar Clientes</a></li>
                    <li><a href="{{action('SaidaController@listarSaida')}}">Listar Saídas de Produtos</a></li>
                    <li><a href="{{action('RelatorioController@novo')}}">Listar Relatórios</a></li>
                    <li><a href="{{action('FornecedorController@listar')}}">Listar Fornecedores</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sair</a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>
                    </li>
                </ul>
                <a href="{{action('VendaController@novo')}}">Cadastrar Venda</a>
            </div>
        </nav>
  
        @yield('conteudo')

        <footer>
            <div>Purchase Store 2016-2018</div>
        </footer>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/date-uk.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="/js/scripts.js"></script>
    </body>
</html>