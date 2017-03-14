<?php

namespace App\Http\Controllers;

use App\Produto;
use App\Promocao;
use App\Http\Requests\PromocaoRequest;

class PromocaoController extends Controller
{
    public function index()
    {
        $promocaos = Promocao::orderBy('titulo')->with('produtos')
            ->paginate(config('constantes.paginacao'));
        return view('promocao.index', compact('promocaos'));
    }

    public function novo()
    {
        $produtos = Produto::orderBy('nome_produto')->get();
        return view('promocao.novo', compact('produtos'));
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
        $produtos = Produto::orderBy('nome_produto')->get();
        return view('promocao.editar', compact('promocao', 'produtos'));
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
        $promocao->produtos()->detach();
        $promocao->delete();
        return redirect('promocaos');
    }
}
