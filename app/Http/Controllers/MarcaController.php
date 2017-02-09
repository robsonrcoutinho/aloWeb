<?php

namespace App\Http\Controllers;

use App\Marca;
use Illuminate\Http\Request;
use App\Http\Requests\MarcaRequest;
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

    public function salvar(MarcaRequest $request)
    {
        Marca::create($request->all());
        return redirect()->route('marcas');
    }

    public function editar($id)
    {
        $marca = Marca::find($id);
        return view('marca.editar',compact('marca'));
    }
    public function alterar(Request $request, $id)
    {
        Marca::find($id)->update($request->all());
        return redirect()->route('marcas');
    }

    public function excluir($id)
    {
        $marca = Marca::find($id);
        $marca->delete();
        return redirect('marcas');
    }
}
