<!DOCTYPE html>
    <html>
    <head>
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
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        
        <meta name="viewport" content="width=device-width">

    	<title>Controle de Estoque Purchase Store</title>
    </head>
    <body>
    	<nav class="navbar navbar-inverse">
            <div class="container-fluid">
              <div class="navbar-header">
                <a class="navbar-brand" href="{{action('ProdutoController@listar')}}">Purchase Store</a>
              </div>
              <ul class="nav navbar-nav">
                <li class="active"><a href="{{action('ProdutoController@listar')}}">Listar Produtos</a></li>
                <li><a href="{{action('CategoriaController@listar')}}">Listar Categoria</a></li>
                <li><a href="{{action('EntradaController@listarEntrada')}}">Listar Entrada</a></li>
                <li><a href="{{action('SaidaController@listarSaida')}}">Listar Saída</a></li>
              </ul>
            </div>
        </nav>
  
        @yield('conteudo')

        <footer>
            <div>Purchase Store 2016-2018</div>
        </footer>

        <script type="text/javascript" src="js/scripts.js"></script>
    </body>
</html>