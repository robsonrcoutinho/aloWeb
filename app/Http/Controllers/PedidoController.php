<?php

namespace App\Http\Controllers;

use App\Http\Helpers\PedidoHelper;
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

    /** Método que encaminha para página de exibição de detalhes de pedido
     * @param $id int identificador do pedido
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detalhar($id)
    {
        $pedido = Pedido::find($id);                                        //Busca pedido pelo id
        $total = number_format(PedidoHelper::total($pedido), 2, ',', '.');  //Solicita cálculo do total do pedido
        return view('pedido.detalhar', compact('pedido', 'total'));         //Encaminha para view de detalhamento
    }

    /**Método que realiza aceite de pedido do cliente
     * @param $id int identificador do pedido
     */
    public function aceitar($id)
    {
        $pedido = Pedido::find($id);                                                    //Busca pedido pelo id
        $pse = PedidoHelper::verificarEstoque($pedido);                                 //Verifica estoque
        if (!$pse->isEmpty()):                                                          //Se falta produto em estoque
            $mensagem = 'Falta em estoque:\n' . $pse->implode('nome_produto', '\n');    //Criar mensagem com relação de itens faltantes
            PedidoHelper::mensagem($mensagem, back()->getTargetUrl());                  //Exibe mensagem e redireciona para página anterior
        endif;
        PedidoHelper::baixarEstoque($pedido);                                           //Dá baixa no estoque
        $pedido->status = 'separado';                                                     //Altera o status do pedido para separado
        $pedido->save();                                                                //Salva alteração em pedido
        PedidoHelper::mensagem('Pedido aceito com sucesso.', route('pedidos'));         //Exibe mensagem de sucesso e redireciona para página de pedidos
    }

    public function alterarStatus($id, $status)
    {
        Pedido::find($id)->update(['status' => $status]);                                 //Busca pedido pelo id e altera status
        //Exibe mensagem de alteração de status e redireciona para página de pedidos
        PedidoHelper::mensagem('Status do pedido foi alterado para:\n' . $status, route('pedidos'));
    }

    public function cancelar($id)
    {
        $pedido = Pedido::find($id);                                                    //Busca pedido pelo id
        if($pedido->status!='pendente'):
            //Reabastecer estoque com produtos separados
        endif;
    }
}