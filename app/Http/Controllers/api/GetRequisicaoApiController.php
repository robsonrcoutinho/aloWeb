<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produto;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Categoria;
use App\Promocao;

class GetRequisicaoApiController extends Controller
{

    public function getProdutosMarcas(Request $request)
    {

        $produtos = Produto::with('marca')->get();
        return response()->json(['produtos' => $produtos]);

    }

    public function getPromocoes()
    {
        return response()->json(Promocao::with('Produtos')->get());
    }


    public function getCategorias()
    {

        return response()->json(Categoria::all()->pluck('nome_categoria','id'));

    }





}
