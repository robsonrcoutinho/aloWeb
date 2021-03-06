<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriaRequest;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::OrderBy('nome_categoria')
            ->paginate(config('constantes.paginacao'));
        return view('categoria.index', compact('categorias'));
    }

    public function novo()
    {
        return view('categoria.novo');
    }

    public function salvar(CategoriaRequest $request)
    {
        Categoria::create($request->all());
        return redirect()->route('categorias');
    }

    public function editar($id)
    {
        $categoria = Categoria::find($id);
        return view('categoria.editar', compact('categoria'));
    }

    public function alterar(Request $request, $id)
    {
        Categoria::find($id)->update($request->all());
        return redirect('categorias');
    }
    public function excluir($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();
        return redirect('categorias');
    }
}
