<?php

Route::get('/', function () {
    return view('main');
});

Route::group(['prefix' => 'produtos'], function(){
    Route::get('',['as'=>'produtos','uses'=>'ProdutoController@index']);
    Route::get('novo',['as'=>'produtos.novo', 'uses'=>'ProdutoController@novo']);
    Route::post('salvar',['as'=>'produtos.salvar', 'uses' => 'ProdutoController@salvar']);
    Route::get('{id}/excluir', ['as' => 'produtos.excluir', 'uses' => 'ProdutoController@excluir']);
    Route::get('{id}/editar',['as' => 'produtos.editar', 'uses' => 'ProdutoController@editar']);
    Route::put('{id}/alterar', ['as' => 'produtos.alterar', 'uses' => 'ProdutoController@alterar']);

});

Route::group(['prefix' => 'pedidos'], function(){
    Route::get('',['as'=>'pedidos','uses'=>'PedidoController@index']);


});

Route::group(['prefix' => 'marcas'], function(){
    Route::get('',['as'=>'marcas','uses'=>'MarcaController@index']);
    Route::get('novo',['as'=>'marcas.novo','uses'=>'MarcaController@novo']);
    Route::post('salvar',['as'=>'marcas.salvar','uses'=>'MarcaController@salvar']);
    Route::get('{id}/editar',['as' => 'marcas.editar', 'uses' => 'MarcaController@editar']);
    Route::put('{id}/alterar', ['as' => 'marcas.alterar', 'uses' => 'MarcaController@alterar']);
    Route::get('{id}/excluir', ['as' => 'marcas.excluir', 'uses' => 'MarcaController@excluir']);
});

Route::group(['prefix' => 'categorias'], function(){
    Route::get('',['as'=>'categorias','uses'=>'CategoriaController@index']);
    Route::get('novo',['as'=>'categorias.novo','uses'=>'CategoriaController@novo']);
    Route::post('salvar',['as'=>'categorias.salvar','uses'=>'CategoriaController@salvar']);
    Route::get('{id}/editar',['as' => 'categorias.editar', 'uses' => 'CategoriaController@editar']);
    Route::put('{id}/alterar', ['as' => 'categoria.alterar', 'uses' => 'CategoriaController@alterar']);
    Route::get('{id}/excluir', ['as' => 'categorias.excluir', 'uses' => 'CategoriaController@excluir']);
});