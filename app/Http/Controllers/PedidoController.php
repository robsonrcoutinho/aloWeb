<?php

namespace App\Http\Controllers;

use App\Http\Helpers\PedidoHelper;
use App\Pedido;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::user()->cant('aceitar', $pedido)):
            abort(403);
        endif;
        $pse = PedidoHelper::verificarEstoque($pedido);                                 //Verifica estoque
        if (!$pse->isEmpty()):                                                          //Se falta produto em estoque
            $mensagem = 'Falta em estoque:\n' . $pse->implode('nome_produto', '\n');    //Criar mensagem com relação de itens faltantes
            PedidoHelper::mensagem($mensagem, back()->getTargetUrl());                  //Exibe mensagem e redireciona para página anterior
            return;
        endif;
        PedidoHelper::baixarEstoque($pedido);                                           //Dá baixa no estoque
        $pedido->status = 'separado';                                                   //Altera o status do pedido para separado
        $pedido->save();                                                                //Salva alteração em pedido
        PedidoHelper::mensagem('Pedido aceito com sucesso.', route('pedidos'));         //Exibe mensagem de sucesso e redireciona para página de pedidos
        return;
    }

    /** Método que altera status do pedido para despachado
     * @param $id int identificador do pedido
     */
    public function despachar($id)
    {
        $pedido = Pedido::find($id);                    //Busca pedido pelo id
        if (Auth::user()->can('despachar', $pedido)):   //Verifica se usuário pode realizar a operação
            $pedido->update(['status' => 'despachado']);//Altera status para despachado
            PedidoHelper::mensagem(
                'Status do pedido foi alterado para despachado',
                route('pedidos'));                      //Exibe mensagem e redireciona para página de pedidos
        else:
            PedidoHelper::mensagem(
                'Não foi possível alterar o status do pedido.',
                back()->getTargetUrl());                //Exibe mensagem e redireciona para página anterior
        endif;
    }

    /** Método que cancela pedido
     * @param $id int identificador do pedido
     */
    public function cancelar($id)
    {
        $pedido = Pedido::find($id);                            //Busca pedido pelo id
        if ($pedido->status == 'cancelado'):                    //Se pedido já  estiver cancelado
            PedidoHelper::mensagem(
                'Pedido já está cancelado.',
                back()->getTargetUrl());                        //Envia mensagem informando que já está cancelado e retorna a página de exibição
            return;
        elseif ($pedido->status == 'despachado'):               //Se pedido já foi despachado
            PedidoHelper::mensagem(
                'Pedido não pode ser cancelado.',               //Envia mensagem informando que pedido não pode ser cancelado e retorna a página de exibição
                back()->getTargetUrl());
            return;
        elseif (Auth::user()->cant('cancelar', $pedido)):       //Se usuário não pode realizar operação
            abort(403);                                         //Aborta
        elseif ($pedido->status != 'pendente'):                 //Se status do pedido for diferente de pendente
            PedidoHelper::restabelecerEstoque($pedido);         //Restabelece estoque com produtos do pedido
        endif;
        $pedido->status = 'cancelado';                          //Altera status do pedido para cancelado
        $pedido->save();                                        //Salva alteração em pedido

        PedidoHelper::mensagem(
            'Pedido cancelado com sucesso',
            route('pedidos'));                                  //Envia mensagem de que cancelamento foi feito e retorna a tela que lista pedidos
        return;
    }
}