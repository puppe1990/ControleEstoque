<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{URL::asset('bootstrap/css/bootstrap.min.css')}}">
    <link href="/css/app.css" rel="stylesheet">
    <link href="{{URL::asset('vendor/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
    <script src="vendor/select2/dist/js/select2.min.js"></script>
    <script src="{{URL::asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
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


</body>
</html>