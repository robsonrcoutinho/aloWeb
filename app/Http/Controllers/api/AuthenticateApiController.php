<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticateApiController extends Controller
{

    public function authenticate(Request $request)
    {
        // Pegar credenciais do pedido
        $credentials = $request->only('email', 'password');
        try {
            // Tentar verificar as credenciais e criar um token para o usuário
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // Algo deu errado enquanto tenta codificar o token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        // Tudo certo. assim retornar o token
        return response()->json(compact('token'));
    }

    public function logout(Request $request)
    {
        $this->validate($request, ['token' => 'required']);
        JWTAuth::invalidate($request->input('token'));
        return response()->json(['token_invalidado' => 'token_delete_successo'], 500);
    }

}
