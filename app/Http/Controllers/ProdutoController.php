<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Produto;
use App\Marca;
use App\Http\Requests\ProdutoRequest;

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

    public function salvar(ProdutoRequest $request)
    {
        //Produto::create($request->all());

        $produto = new Produto($request->all());
        $nome_produto = $produto->nome_produto;
        $imagem = $request->file('imagem');

        $nome_produto.= '.' . $imagem->getClientOriginalExtension();
        $diretorio = 'public/' . 'produtos';
        $imagem->move($diretorio, $nome_produto);
        $produto->imagem= $diretorio . '/' . $nome_produto;
        $produto->save();

        return redirect('produtos');
    }

    public function editar($id)
    {
        $produto = Produto::find($id);
        $categorias = Categoria::all()->pluck('nome_categoria', 'id');
        $marcas = Marca::all()->pluck('marca', 'id');
        return view('produto.editar', compact('produto', 'categorias', 'marcas'));
    }

    public function alterar(ProdutoRequest $request, $id)
    {
        Produto::find($id)->update($request->all());
        return redirect('produtos');
    }
    public function excluir($id)
    {
        $produto = Produto::find($id);
        $produto->delete();
        return redirect('produtos');
    }
}
