<?php

namespace App\Http\Controllers;

use App\Pedido;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

    public function aceitar($id)
    {
        $pedido = Pedido::find($id);
        $pse = $this->verificarEstoque($pedido);
        if (!$pse->isEmpty()):
            $mensagem = 'Falta em estoque:\n';
            foreach ($pse as $p):
                $mensagem .= $p->nome_produto.'\n';
            endforeach;
            return $this->mensagem($mensagem, back()->getTargetUrl());
        endif;
        $this->baixarEstoque($pedido);

        return redirect('pedidos');
    }

    private function total(Pedido $pedido)
    {
        $total = 0;
        foreach ($pedido->items as $item):
            $total += $item->elemento->valor * $item->quantidade;
        endforeach;
        return $total;
    }

    private function verificarEstoque(Pedido $pedido)
    {
        $estoques = \App\Estoque::with('produto')->get();
        $pse = collect();
        foreach ($pedido->items as $item):
            if ($item->elemento instanceof \App\Promocao):
                foreach ($item->elemento->produtos as $k => $produto):
                    $estoque = ($estoques->where('fk_id_produto', $produto->id)->first());
                    if ($estoque->quantidade >= $item->quantidade):
                        $estoque->quantidade -= $item->quantidade;
                    else:
                        $pse->push($produto);
                    endif;
                endforeach;
            else:
                $estoque = ($estoques->where('fk_id_produto', $item->elemento->id)->first());
                if ($estoque->quantidade >= $item->quantidade):
                    $estoque->quantidade -= $item->quantidade;
                else:
                    $pse->push($item->elemento);
                endif;
            endif;
        endforeach;
        return $pse;
    }

    private function baixarEstoque(Pedido $pedido){

    }

    private function mensagem($texto, $rota)
    {
        echo "<script>
                alert('$texto');
                window.location='$rota';
                </script>";
    }
}