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
        return response()->json(['produtos'=>$produtos]);

    }

    public function getPromocoes()
    {

     /*   try {
            $token = JWTAuth::parseToken();
            if (! $token->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        //$user = JWTAuth::parseToken()->authenticate();
        //$user = User::find(1);

       // $token = JWTAuth::fromUser($user);
        //dd($token); */
        return response()->json(Promocao::with('Produtos')->get());
    }


    public function getCategorias()
    {
        return response()->json(Categoria::all());

    }





}
