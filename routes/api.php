<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
        $api->post('login', 'App\Http\Controllers\api\AuthenticateApiController@authenticate');
        $api->post('logout', 'App\Http\Controllers\api\AuthenticateApiController@logout');
        $api->post('resetEmail','App\Http\Controllers\api\AuthenticateApiController@resetEmail');
        $api->post('createUser','App\Http\Controllers\api\AuthenticateApiController@create');
        $api->get('getProdutosMarcas','App\Http\Controllers\api\GetRequisicaoApiController@getProdutosMarcas');
        $api->get('getCategorias','App\Http\Controllers\api\GetRequisicaoApiController@getCategorias');
        $api->get('getPromocoes','App\Http\Controllers\api\GetRequisicaoApiController@getPromocoes');
});
