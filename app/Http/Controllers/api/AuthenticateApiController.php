<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;

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


    public function resetEmail(Request $request)
    {

        $response = Password::sendResetLink($request->only('email'), function(Message $message){
            $message->subject($this->getEmailSubject());

        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return response()->json(['status'=> 'sucesso'],500);

            case Password::INVALID_USER:
                return response()->json(['status'=> 'falha',401]);
        }
    }

    protected function getEmailSubject()
    {
        return isset($this->subject) ? $this->subject : 'S.C. Atacado';
    }


}
