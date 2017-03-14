<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Http\Requests\ChatRequest;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        if (Auth::user()->cant('visualizar', Chat::class)):     //Se usuário não puder acessar visualização
            return redirect()->route('chats.chat');             //Redireciona para chat
        endif;
        $chats = Chat::paginate(config('constantes.paginacao'));//Busca todos os chats
        return view('chat.index', compact('chats'));            //Passa view index
    }

    public function salvar(ChatRequest $request)
    {
        $chat = new Chat();                     //Cria um novo objeto Chat
        $chat->mensagem = $request->mensagem;   //Passa mensagem
        $chat->fk_id_user = Auth::user()->id;   //Pega id do usuário logado
        $chat->save();                          //Salva chat
    }

    public function inserir(ChatRequest $request)
    {
        $this->salvar($request);                //Salva chat
        return redirect()->route('chats.chat'); //Redireciona para rota chats
    }

    public function excluir($id)
    {
        Chat::find($id)->delete();  //Busca e apaga chat pelo id
        return redirect('chats');   //redireciona para rota de chats
    }

    public function chat()
    {
        $chats = Chat::with('usuario')->orderBy('id', 'desc')->get();   //Busca todos os chats com usuario em ordem inversa pelo id
        return view('chat.chat', compact('chats'));                     //Passar para view de chats
    }

    public function listar()
    {
        return response()->json(Chat::lista()); //Busca e retorna lista de chats em formato json
    }
}