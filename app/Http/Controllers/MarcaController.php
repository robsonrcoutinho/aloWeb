<?php

namespace App\Http\Controllers;

use App\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::all();
        return view('marca.index', compact('marcas'));
    }

    public function novo()
    {
        return view('marca.novo');
    }

    public function salvar(Request $request)
    {
        Marca::create($request->all());
        return redirect()->route('marcas');
    }

    public function editar($id)
    {
        $marca = Marca::find($id);
        return view('marcas.editar',compact('marca'));
    }
    public function alterar(Request $request, $id)
    {
        Marca::find($id)->update($request->all());
        return redirect()->route('marcas');
    }
    public function excluir()
    {
        return 'excluir';
    }
}
