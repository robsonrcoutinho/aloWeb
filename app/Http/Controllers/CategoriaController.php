<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('categoria.index', compact('categorias'));
    }

    public function novo()
    {
        return view('categoria.novo');
    }

    public function salvar(Request $request)
    {
        Categoria::create($request->all());
        return redirect()->route('categorias');
    }

    public function editar()
    {
        return 'editar';
    }

    public function excluir()
    {
        return 'excluir';
    }
}
