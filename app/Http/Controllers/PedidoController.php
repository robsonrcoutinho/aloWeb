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

    /** M�todo que encaminha para p�gina de exibi��o de detalhes de pedido
     * @param $id int identificador do pedido
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detalhar($id)
    {
        $pedido = Pedido::find($id);                                        //Busca pedido pelo id
        $total = number_format(PedidoHelper::total($pedido), 2, ',', '.');  //Solicita c�lculo do total do pedido
        return view('pedido.detalhar', compact('pedido', 'total'));         //Encaminha para view de detalhamento
    }

    /**M�todo que realiza aceite de pedido do cliente
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
            $mensagem = 'Falta em estoque:\n' . $pse->implode('nome_produto', '\n');    //Criar mensagem com rela��o de itens faltantes
            PedidoHelper::mensagem($mensagem, back()->getTargetUrl());                  //Exibe mensagem e redireciona para p�gina anterior
            return;
        endif;
        PedidoHelper::baixarEstoque($pedido);                                           //D� baixa no estoque
        $pedido->status = 'separado';                                                   //Altera o status do pedido para separado
        $pedido->save();                                                                //Salva altera��o em pedido
        PedidoHelper::mensagem('Pedido aceito com sucesso.', route('pedidos'));         //Exibe mensagem de sucesso e redireciona para p�gina de pedidos
        return;
    }

    /** M�todo que altera status do pedido para despachado
     * @param $id int identificador do pedido
     */
    public function despachar($id)
    {
        $pedido = Pedido::find($id);                    //Busca pedido pelo id
        if (Auth::user()->can('despachar', $pedido)):   //Verifica se usu�rio pode realizar a opera��o
            $pedido->update(['status' => 'despachado']);//Altera status para despachado
            PedidoHelper::mensagem(
                'Status do pedido foi alterado para despachado',
                route('pedidos'));                      //Exibe mensagem e redireciona para p�gina de pedidos
        else:
            PedidoHelper::mensagem(
                'N�o foi poss�vel alterar o status do pedido.',
                back()->getTargetUrl());                //Exibe mensagem e redireciona para p�gina anterior
        endif;
    }

    /** M�todo que cancela pedido
     * @param $id int identificador do pedido
     */
    public function cancelar($id)
    {
        $pedido = Pedido::find($id);                            //Busca pedido pelo id
        if ($pedido->status == 'cancelado'):                    //Se pedido j�  estiver cancelado
            PedidoHelper::mensagem(
                'Pedido j� est� cancelado.',
                back()->getTargetUrl());                        //Envia mensagem informando que j� est� cancelado e retorna a p�gina de exibi��o
            return;
        elseif ($pedido->status == 'despachado'):               //Se pedido j� foi despachado
            PedidoHelper::mensagem(
                'Pedido n�o pode ser cancelado.',               //Envia mensagem informando que pedido n�o pode ser cancelado e retorna a p�gina de exibi��o
                back()->getTargetUrl());
            return;
        elseif (Auth::user()->cant('cancelar', $pedido)):       //Se usu�rio n�o pode realizar opera��o
            abort(403);                                         //Aborta
        elseif ($pedido->status != 'pendente'):                 //Se status do pedido for diferente de pendente
            PedidoHelper::restabelecerEstoque($pedido);         //Restabelece estoque com produtos do pedido
        endif;
        $pedido->status = 'cancelado';                          //Altera status do pedido para cancelado
        $pedido->save();                                        //Salva altera��o em pedido

        PedidoHelper::mensagem(
            'Pedido cancelado com sucesso',
            route('pedidos'));                                  //Envia mensagem de que cancelamento foi feito e retorna a tela que lista pedidos
        return;
    }
}