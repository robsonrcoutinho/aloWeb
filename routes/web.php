<?php

Route::get('/', function () {
    return view('main');
})->name('main')->middleware('auth');

Route::get('home', function () {
    return redirect('main')->middleware('auth');
});

/*Autenticação*/
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

Route::get('login', function () {
    return view('auth.login');
});

Route::post('auth', ['as' => 'auth', 'uses' => 'Auth\LoginController@login']);
/*####*/


Route::group(['prefix' => 'produtos'], function () {
    Route::get('', ['as' => 'produtos', 'uses' => 'ProdutoController@index'])->middleware('can:visualizar,App\Produto');
    Route::get('novo', ['as' => 'produtos.novo', 'uses' => 'ProdutoController@novo'])->middleware('can:salvar,App\Produto');
    Route::post('salvar', ['as' => 'produtos.salvar', 'uses' => 'ProdutoController@salvar'])->middleware('can:salvar,App\Produto');
    Route::get('{id}/editar', ['as' => 'produtos.editar', 'uses' => 'ProdutoController@editar'])->middleware('can:alterar,App\Produto');
    Route::put('{id}/alterar', ['as' => 'produtos.alterar', 'uses' => 'ProdutoController@alterar'])->middleware('can:alterar,App\Produto');
    Route::get('{id}/excluir', ['as' => 'produtos.excluir', 'uses' => 'ProdutoController@excluir'])->middleware('can:excluir,App\Produto');
});

Route::group(['prefix' => 'pedidos'], function () {
    Route::get('', ['as' => 'pedidos', 'uses' => 'PedidoController@index'])->middleware('can:visualizar,App\Pedido');
    Route::get('{id}/detalhar', ['as' => 'pedidos.detalhar', 'uses' => 'PedidoController@detalhar'])->middleware('can:detalhar,App\Pedido');
    Route::get('{id}/aceitar', ['as' => 'pedidos.aceitar', 'uses' => 'PedidoController@aceitar'])->middleware('can:aceitar,pedido');
    Route::get('{id}/despachar', ['as' => 'pedidos.despachar', 'uses' => 'PedidoController@despachar'])->middleware('can:despachar,pedido');
    Route::get('{id}/cancelar', ['as' => 'pedidos.cancelar', 'uses' => 'PedidoController@cancelar'])->middleware('can:cancelar,pedido');
});

Route::group(['prefix' => 'marcas'], function () {
    Route::get('', ['as' => 'marcas', 'uses' => 'MarcaController@index'])->middleware('can:visualizar,App\Marca');
    Route::get('novo', ['as' => 'marcas.novo', 'uses' => 'MarcaController@novo'])->middleware('can:salvar,App\Marca');
    Route::post('salvar', ['as' => 'marcas.salvar', 'uses' => 'MarcaController@salvar'])->middleware('can:salvar,App\Marca');
    Route::get('{id}/editar', ['as' => 'marcas.editar', 'uses' => 'MarcaController@editar'])->middleware('can:alterar,App\Marca');
    Route::put('{id}/alterar', ['as' => 'marcas.alterar', 'uses' => 'MarcaController@alterar'])->middleware('can:alterar,App\Marca');
    Route::get('{id}/excluir', ['as' => 'marcas.excluir', 'uses' => 'MarcaController@excluir'])->middleware('can:excluir,App\Marca');
});

Route::group(['prefix' => 'categorias'], function () {
    Route::get('', ['as' => 'categorias', 'uses' => 'CategoriaController@index'])->middleware('can:visualizar,App\Categoria');
    Route::get('novo', ['as' => 'categorias.novo', 'uses' => 'CategoriaController@novo'])->middleware('can:salvar,App\Categoria');
    Route::post('salvar', ['as' => 'categorias.salvar', 'uses' => 'CategoriaController@salvar'])->middleware('can:salvar,App\Categoria');
    Route::get('{id}/editar', ['as' => 'categorias.editar', 'uses' => 'CategoriaController@editar'])->middleware('can:alterar,App\Categoria');
    Route::put('{id}/alterar', ['as' => 'categorias.alterar', 'uses' => 'CategoriaController@alterar'])->middleware('can:alterar,App\Categoria');
    Route::get('{id}/excluir', ['as' => 'categorias.excluir', 'uses' => 'CategoriaController@excluir'])->middleware('can:excluir,App\Categoria');
});

Route::group(['prefix' => 'promocaos'], function () {
    Route::get('', ['as' => 'promocaos', 'uses' => 'PromocaoController@index'])->middleware('can:visualizar,App\Promocao');
    Route::get('novo', ['as' => 'promocaos.novo', 'uses' => 'PromocaoController@novo'])->middleware('can:salvar,App\Promocao');
    Route::post('salvar', ['as' => 'promocaos.salvar', 'uses' => 'PromocaoController@salvar'])->middleware('can:salvar,App\Promocao');
    Route::get('{id}/editar', ['as' => 'promocaos.editar', 'uses' => 'PromocaoController@editar'])->middleware('can:alterar,App\Promocao');
    Route::put('{id}/alterar', ['as' => 'promocaos.alterar', 'uses' => 'PromocaoController@alterar'])->middleware('can:alterar,App\Promocao');
    Route::get('{id}/excluir', ['as' => 'promocaos.excluir', 'uses' => 'PromocaoController@excluir'])->middleware('can:excluir,App\Promocao');
});

Route::group(['prefix' => 'estoques'], function () {
    Route::get('', ['as' => 'estoques', 'uses' => 'EstoqueController@index'])->middleware('can:visualizar,App\Estoque');
    Route::get('novo', ['as' => 'estoques.novo', 'uses' => 'EstoqueController@novo'])->middleware('can:salvar,App\Estoque');
    Route::post('salvar', ['as' => 'estoques.salvar', 'uses' => 'EstoqueController@salvar'])->middleware('can:salvar,App\Estoque');
    Route::get('{id}/excluir', ['as' => 'estoques.excluir', 'uses' => 'EstoqueController@excluir'])->middleware('can:excluir,App\Estoque');
    Route::get('{id}/editar', ['as' => 'estoques.editar', 'uses' => 'EstoqueController@editar'])->middleware('can:alterar,App\Estoque');
    Route::put('{id}/alterar', ['as' => 'estoques.alterar', 'uses' => 'EstoqueController@alterar'])->middleware('can:alterar,App\Estoque');

});
Route::group(['prefix' => 'chats'], function () {
    Route::get('', ['as' => 'chats', 'uses' => 'ChatController@index']);
    Route::get('chat', ['as' => 'chats.chat', 'uses' => 'ChatController@chat']);
    Route::post('salvar', ['as' => 'chats.salvar', 'uses' => 'ChatController@salvar']);
    Route::get('{id}/excluir', ['as' => 'chats.excluir', 'uses' => 'ChatController@excluir']);

    Route::get('listar', ['as' => 'chats.listar', 'uses' => 'ChatController@listar']);
    //Route::put('{id}/alterar', ['as' => 'chats.alterar', 'uses' => 'ChatController@alterar']);

});

Route::group(['prefix' => 'users'], function () {
    Route::get('', ['as' => 'users', 'uses' => 'UserController@index'])->middleware('can:visualizar,App\User');
    Route::get('novo', ['as' => 'users.novo', 'uses' => 'UserController@novo'])->middleware('can:salvar,App\User');
    Route::post('salvar', ['as' => 'users.salvar', 'uses' => 'UserController@salvar'])->middleware('can:salvar,App\User');
    Route::get('{id}/editar', ['as' => 'users.editar', 'uses' => 'UserController@editar'])->middleware('can:alterar,App\User');
    Route::put('{id}/alterar', ['as' => 'users.alterar', 'uses' => 'UserController@alterar'])->middleware('can:alterar,App\User');
    Route::get('{id}/excluir', ['as' => 'users.excluir', 'uses' => 'UserController@excluir'])->middleware('can:excluir,App\User');
});

Auth::routes();
