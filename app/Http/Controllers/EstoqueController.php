<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estoque;

class EstoqueController extends Controller
{
       public function index()
    {
        $estoques = Estoque::all();
        return view('estoque.index', compact('estoques'));
    }

    public function novo()
    {
        return view('estoque.novo');
    }

    public function salvar(Request $request)
    {
        Estoque::create($request->all());
        return redirect()->route('estoques');
    }

    public function editar($id)
    {
        $estoque = Estoque::find($id);
        return view('estoque.editar', compact('estoque'));
    }

    public function alterar(Request $request, $id)
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
