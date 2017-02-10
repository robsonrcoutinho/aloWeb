<?php

namespace App\Http\Controllers;

use App\Promocao;
use App\Http\Requests\PromocaoRequest;
use Illuminate\Http\Request;

class PromocaoController extends Controller
{
    public function index()
    {
        $promocaos = Promocao::with('produtos');
        return view('promocao.index', compact('promocaos'));
    }

    public function novo()
    {
        return view('promocao.novo');
    }

    public function salvar(PromocaoRequest $request)
    {
        $promocao = Promocao::create($request->all());
        $promocao->produtos()->attach($request->produtos);
        return redirect()->route('promocaos');
    }

    public function editar($id)
    {
        $promocao = Promocao::find($id);
        return view('promocao.editar',compact('promocao'));
    }
    public function alterar(PromocaoRequest $request, $id)
    {
        $promocao = Promocao::find($id);
        $promocao->update($request->all());
        $promocao->produtos()->sync($request->produtos);
        return redirect()->route('promocaos');
    }

    public function excluir($id)
    {
        $promocao = Promocao::find($id);
        //$promocao->produtos()->detach();
        $promocao->delete();
        return redirect('promocaos');
    }
}
