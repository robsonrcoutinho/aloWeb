<?php

Route::get('/', function () {
    return view('main');
});

Route::group(['prefix' => 'produtos'], function(){
    Route::get('',['as'=>'produtos','uses'=>'ProdutoController@index']);
    /*Route:get('novo',['as'=>'produtos.novo', 'uses'=>'ProdutoController@novo']);
    Route::post('salvar',['as'=>'produtos.salvar', 'uses' => 'ProdutoController@salvar']);
    Route::get('{id}/excluir', ['as' => 'produtos.excluir', 'uses' => 'ProdutoController@excluir']);
    Route::get('{id}/editar',['as' => 'produtos.editar', 'uses' => 'ProdutoController@editar']);
    Route::put('{id}/alterar', ['as' => 'produtos.alterar', 'uses' => 'ProdutoController@alterar']);*/

});

Route::group(['prefix' => 'pedidos'], function(){
    Route::get('',['as'=>'pedidos','uses'=>'PedidoController@index']);


});



