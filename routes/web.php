<?php

Route::get('/', function () {
    return view('main');
})->name('main')->middleware('auth');

Route::get('home', function () {
    return redirect('main')->middleware('auth');
});

/*Autenticação*/
Route::get('logout', ['as'=>'logout','uses'=>'Auth\LoginController@logout']);

Route::get('login', function(){
    return view('auth.login');
});

Route::post('auth',['as'=>'auth', 'uses'=>'Auth\LoginController@login']);
/*####*/


Route::group(['prefix' => 'produtos'], function(){
    Route::get('',['as'=>'produtos','uses'=>'ProdutoController@index'])->middleware('auth');
    Route::get('novo',['as'=>'produtos.novo', 'uses'=>'ProdutoController@novo'])->middleware('auth');
    Route::post('salvar',['as'=>'produtos.salvar', 'uses' => 'ProdutoController@salvar'])->middleware('auth');
    Route::get('{id}/excluir', ['as' => 'produtos.excluir', 'uses' => 'ProdutoController@excluir'])->middleware('auth');
    Route::get('{id}/editar',['as' => 'produtos.editar', 'uses' => 'ProdutoController@editar'])->middleware('auth');
    Route::put('{id}/alterar', ['as' => 'produtos.alterar', 'uses' => 'ProdutoController@alterar'])->middleware('auth');

});

Route::group(['prefix' => 'pedidos'], function(){
    Route::get('',['as'=>'pedidos','uses'=>'PedidoController@index'])->middleware('auth');
    Route::get('{id}/detalhar',['as'=>'pedidos.detalhar','uses'=>'PedidoController@detalhar']);
    Route::get('{id}/aceitar',['as'=>'pedidos.aceitar','uses'=>'PedidoController@aceitar']);
});

Route::group(['prefix' => 'marcas'], function(){
    Route::get('',['as'=>'marcas','uses'=>'MarcaController@index'])->middleware('auth');
    Route::get('novo',['as'=>'marcas.novo','uses'=>'MarcaController@novo'])->middleware('auth');
    Route::post('salvar',['as'=>'marcas.salvar','uses'=>'MarcaController@salvar'])->middleware('auth');
    Route::get('{id}/editar',['as' => 'marcas.editar', 'uses' => 'MarcaController@editar'])->middleware('auth');
    Route::put('{id}/alterar', ['as' => 'marcas.alterar', 'uses' => 'MarcaController@alterar'])->middleware('auth');
    Route::get('{id}/excluir', ['as' => 'marcas.excluir', 'uses' => 'MarcaController@excluir'])->middleware('auth');
});

Route::group(['prefix' => 'categorias'], function(){
    Route::get('',['as'=>'categorias','uses'=>'CategoriaController@index'])->middleware('auth');
    Route::get('novo',['as'=>'categorias.novo','uses'=>'CategoriaController@novo'])->middleware('auth');
    Route::post('salvar',['as'=>'categorias.salvar','uses'=>'CategoriaController@salvar'])->middleware('auth');
    Route::get('{id}/editar',['as' => 'categorias.editar', 'uses' => 'CategoriaController@editar'])->middleware('auth');
    Route::put('{id}/alterar', ['as' => 'categorias.alterar', 'uses' => 'CategoriaController@alterar'])->middleware('auth');
    Route::get('{id}/excluir', ['as' => 'categorias.excluir', 'uses' => 'CategoriaController@excluir'])->middleware('auth');
});

Route::group(['prefix' => 'promocaos'], function(){
    Route::get('',['as'=>'promocaos','uses'=>'PromocaoController@index'])->middleware('auth');
    Route::get('novo',['as'=>'promocaos.novo', 'uses'=>'PromocaoController@novo'])->middleware('auth');
    Route::post('salvar',['as'=>'promocaos.salvar', 'uses' => 'PromocaoController@salvar'])->middleware('auth');
    Route::get('{id}/excluir', ['as' => 'promocaos.excluir', 'uses' => 'PromocaoController@excluir'])->middleware('auth');
    Route::get('{id}/editar',['as' => 'promocaos.editar', 'uses' => 'PromocaoController@editar'])->middleware('auth');
    Route::put('{id}/alterar', ['as' => 'promocaos.alterar', 'uses' => 'PromocaoController@alterar'])->middleware('auth');

});

Route::group(['prefix' => 'estoques'], function(){
    Route::get('',['as'=>'estoques','uses'=>'EstoqueController@index'])->middleware('auth');
    Route::get('novo',['as'=>'estoques.novo', 'uses'=>'EstoqueController@novo'])->middleware('auth');
    Route::post('salvar',['as'=>'estoques.salvar', 'uses' => 'EstoqueController@salvar'])->middleware('auth');
    Route::get('{id}/excluir', ['as' => 'estoques.excluir', 'uses' => 'EstoqueController@excluir'])->middleware('auth');
    Route::get('{id}/editar',['as' => 'estoques.editar', 'uses' => 'EstoqueController@editar'])->middleware('auth');
    Route::put('{id}/alterar', ['as' => 'estoques.alterar', 'uses' => 'EstoqueController@alterar'])->middleware('auth');

});

Route::group(['prefix' => 'users'], function(){
    Route::get('',['as'=>'users','uses'=>'UserController@index'])->middleware('auth');
    Route::get('novo',['as'=>'users.novo', 'uses'=>'UserController@novo'])->middleware('auth');
    Route::post('salvar',['as'=>'users.salvar', 'uses' => 'UserController@salvar'])->middleware('auth');
    Route::get('{id}/excluir', ['as' => 'users.excluir', 'uses' => 'UserController@excluir'])->middleware('auth');
    Route::get('{id}/editar',['as' => 'users.editar', 'uses' => 'UserController@editar'])->middleware('auth');
    Route::put('{id}/alterar', ['as' => 'users.alterar', 'uses' => 'UserController@alterar'])->middleware('auth');
});

Auth::routes();
