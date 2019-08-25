<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/ap1/v1/produto/{id_produto}', 'API\ProdutoController@getProduto');
Route::group(['middleware' => 'auth'], function () {

	Route::get('/home', 'ModuloController@listar')->name('Pagina inicial');

	//Produtos
	Route::group(['prefix' => 'Produtos'], function(){
		Route::get('','ProdutoController@listar')->name('Listar Produtos');
		Route::get('/remove/{id_produto}','ProdutoController@remove');
		Route::get('/mostrar/{id_produto}','ProdutoController@mostra');
		Route::get('/maiorProduto','ProdutoController@maiorProduto');
	});	

	Route::group(['prefix' => 'NovoProduto'], function(){
		Route::get('','ProdutoController@novo')->name('Cadastrar Produto');
		Route::post('/adiciona','ProdutoController@adiciona');
		Route::post('/edita/{id_produto}','ProdutoController@edita');
	});
	
	//Grupo Produtos
	Route::group(['prefix' => 'GrupoProdutos'], function(){
		Route::get('','GrupoProdutoController@listar')->name('Listar GrupoProdutos');
		Route::get('/remove/{id}','GrupoProdutoController@remove');
		Route::get('/mostrar/{id}','GrupoProdutoController@mostra');
	});

	Route::group(['prefix' => 'NovoGrupoProduto'], function(){
		Route::get('','GrupoProdutoController@novo')->name('Cadastrar GrupoProduto');
		Route::post('/adiciona','GrupoProdutoController@adiciona');
		Route::post('/edita/{id_produto}','GrupoProdutoController@edita');
	});

	Route::group(['prefix' => 'NovoProduto'], function(){
		Route::get('','ProdutoController@novo')->name('Cadastrar Produto');
		Route::post('/adiciona','ProdutoController@adiciona');
		Route::post('/edita/{id_produto}','ProdutoController@edita');
	});	


	//Categorias
	Route::get('/ListarCategoria','CategoriaController@listar')->name('Listar Categorias');
	Route::get('/ListarCategoria/remove/{id_categoria}','CategoriaController@remove');
	Route::get('/ListarCategoria/mostrar/{id_categoria}','CategoriaController@mostra');

	Route::get('/CadastrarCategoria','CategoriaController@novo')->name('Cadastrar Categoria');
	Route::post('/CadastrarCategoria/adiciona','CategoriaController@adiciona');
	Route::post('/CadastrarCategoria/edita/{id_categoria}','CategoriaController@edita');

	//Entrada
	Route::get('/ListarEntrada','EntradaController@listarEntrada')->name('Listar Entradas');
	Route::get('/ListarEntrada/remove/{id_entrada}','EntradaController@remove');
	Route::get('/ListarEntrada/mostrar/{id_entrada}','EntradaController@mostra');
	Route::get('/LancarEntrada','EntradaController@novo')->name('Cadastrar Entrada');
	Route::post('/LancarEntrada/adiciona','EntradaController@adiciona');
	Route::post('/LancarEntrada/edita/{id_entrada}','EntradaController@edita');

	//Saída
	Route::get('/ListarSaida','SaidaController@listarSaida')->name('Listar Saidas');
	Route::get('/ListarSaida/remove/{id_saida}','SaidaController@remove');
	Route::get('/ListarSaida/mostrar/{id_saida}','SaidaController@mostra');
	Route::get('/LancarSaida','SaidaController@novo');
	Route::post('/LancarSaida/adiciona','SaidaController@adiciona');
	Route::post('/LancarSaida/edita/{id_saida}','SaidaController@edita');

	//Relatórios
	Route::get('/ListarRelatorio','RelatorioController@novo')->name('Listar Relatorios');
	Route::post('/ListarRelatorio/mostrar/','RelatorioController@mostra');

	//Clientes
	Route::get('/ListarCliente','ClienteController@listar')->name('Listar Clientes');
	Route::get('/ListarCliente/remove/{id_cliente}','ClienteController@remove');
	Route::get('/ListarCliente/mostrar/{id_cliente}','ClienteController@mostra');

	Route::get('/CadastrarCliente','ClienteController@novo')->name('Cadastrar Cliente');
	Route::post('/CadastrarCliente/adiciona','ClienteController@adiciona');
	Route::post('/CadastrarCliente/edita/{id_cliente}','ClienteController@edita');	

	//Fornecedores
	Route::get('/ListarFornecedor','FornecedorController@listar')->name('Listar Fornecedores');
	Route::get('/ListarFornecedor/remove/{id_fornecedor}','FornecedorController@remove');
	Route::get('/ListarFornecedor/mostrar/{id_fornecedor}','FornecedorController@mostra');

	Route::get('/CadastrarFornecedor','FornecedorController@novo')->name('Cadastrar Fornecedor');
	Route::post('/CadastrarFornecedor/adiciona','FornecedorController@adiciona');
	Route::post('/CadastrarFornecedor/edita/{id_fornecedor}','FornecedorController@edita');

	//Vendas
	Route::get('/ListarVenda','VendaController@listarVenda')->name('Listar Vendas');
	Route::get('/ListarVenda/remove/{id_venda}','VendaController@remove');
	Route::get('/ListarVenda/mostrar/{id_venda}','VendaController@mostra');

	Route::get('/CadastrarVenda','VendaController@novo')->name('Cadastrar Venda');
	Route::post('/CadastrarVenda/adiciona','VendaController@adiciona');
	Route::post('/CadastrarVenda/edita/{id_venda}','VendaController@edita');

	//Categorias
	Route::get('/ListarDestaque','DestaqueController@listar')->name('Listar Destaques');

});


Auth::routes();

$this->get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/entrar', 'Auth\LoginController@entrar')->name('entrar');




