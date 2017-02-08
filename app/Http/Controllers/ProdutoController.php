<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Produto;
use App\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProdutoController extends Controller
{
    public function index(Produto $produto)
    {
        $produtos = $produto->all();
        return view('produto.index', compact('produtos'));
    }

    public function novo()
    {
        $categorias = Categoria::all()->pluck('nome_categoria', 'id');
        $marcas = Marca::all()->pluck('marca', 'id');
        return view('produto.novo', ['categorias'=>$categorias, 'marcas'=>$marcas]);
    }

    public function salvar(Request $request)
    {

        $produto = Produto::create($request->all());
        $produto->categoria = $request->get('categoria');
        $produto->marca=$request->get('marca');
        $produto->save();

        /*$produto->categoria=sync($request->get('categoria')); //($categoria);
        $produto->marca=sync($request->get('marca')); //($categoria);*/

        return redirect('produtos');
    }

    public function editar($id)
    {
        $produto = Produto::find($id);
        return view('produto.editar', compact('produto'));
    }

    public function excluir($id)
    {
        $produto = Produto::find($id);
        $produto->delete();
        return redirect('produtos');
    }
}
