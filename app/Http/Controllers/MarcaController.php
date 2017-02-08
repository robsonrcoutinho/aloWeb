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
        return redirect('marcas');
    }

    public function editar($id)
    {
        $marca = Marca::find($id);
        return view('marca.editar',compact('marca'));
    }

    public function excluir()
    {
        return 'excluir';
    }
}
