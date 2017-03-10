<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Response;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::all();
        return view('chat.index', compact('chats'));
    }

    public function salvar(Request $request)
    {
        $chat = new Chat();
        $chat->mensagem = $request->mensagem;
        $chat->fk_id_user = Auth::user()->id;
        $chat->save();
        //return redirect(chats.chat);
    }


    public function excluir($id)
    {
        Chat::find($id)->delete();
        return redirect('chats');
    }

    public function chat()
    {
        $chats = Chat::all()->reverse();
        return view('chat.chat', compact('chats'));
    }

    public function listar()
    {
        //$chats = Chat::all()->reverse();
        //return Response::json(Chat::all()->reverse());

        return response()->json(Chat::with('usuario')->get());
        //return Chat::all()->reverse();
        //return response(Chat::all()->reverse());
        //return response()->json($chats);
    }

}
