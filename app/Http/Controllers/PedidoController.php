<?php

namespace App\Http\Controllers;

use App\Pedido;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with('usuario')->get();
        return view('pedido.index', compact('pedidos'));
    }

    public function novo()
    {
        return 'novo';
    }

    public function salvar()
    {
        return 'salvar';
    }

    public function editar()
    {
        return 'editar';
    }

    public function excluir()
    {
        return 'excluir';
    }

    public function detalhar($id)
    {
        $pedido = Pedido::find($id);
        $total = number_format($this->total($pedido), 2, ',', '.');
        return view('pedido.detalhar', compact('pedido', 'total'));
    }

    private function total(Pedido $pedido)
    {
        $total = 0;
        foreach ($pedido->items as $item):
            $total += $item->elemento->valor * $item->quantidade;
        endforeach;
        return $total;
    }
}