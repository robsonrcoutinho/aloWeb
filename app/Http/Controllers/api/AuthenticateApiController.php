<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use App\User;

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
                return response()->json(['status'=> 'sucesso']);

            case Password::INVALID_USER:
                return response()->json(['status'=> 'falha']);
        }
    }

    protected function getEmailSubject()
    {
        return isset($this->subject) ? $this->subject : 'S.C. Atacado';
    }


    protected function create(Request $request)
    {
        if($request != null){
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'razao_social' => $request['razao_social'],
                'nome_fantasia' => $request['nome_fantasia'],
                'rua' => $request['rua'],
                'cidade' => $request['cidade'],
                'uf' => $request['uf'],
                'cnpj_cpf' => $request['cnpj_cpf'],
                'telefone' => $request['telefone'],
                'role' => 'cliente',
            ]);
            return response()->json(['user'=> 'create_sucess']);

        }else{
            return response()->json(['user'=> 'create_fail']);
        }
    }


}
