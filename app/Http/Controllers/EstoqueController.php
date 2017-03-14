<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstoqueRequest;
use App\Produto;
use App\Estoque;

class EstoqueController extends Controller
{
    public function index()
    {
        $estoques = Estoque::paginate(config('constantes.paginacao'));
        return view('estoque.index', compact('estoques'));
    }

    public function novo()
    {
        $produtos = Produto::orderBy('nome_produto')
            ->pluck('nome_produto', 'id');
        return view('estoque.novo', compact('produtos'));
    }

    public function salvar(EstoqueRequest $request)
    {
        $this->validate($request,
            ['fk_id_produto' => 'unique:estoques'],
            ['unique' => ':attribute existente no estoque'],
            ['fk_id_produto' => 'Produto']);
        Estoque::create($request->all());
        return redirect()->route('estoques');
    }

    public function editar($id)
    {
        $estoque = Estoque::find($id);
        return view('estoque.editar', compact('estoque'));
    }

    public function alterar(EstoqueRequest $request, $id)
    {
        Estoque::find($id)->update($request->all());
        return redirect('estoques');
    }

    public function excluir($id)
    {
        $estoque = Estoque::find($id);
        $estoque->delete();
        return redirect('estoques');
    }
}
