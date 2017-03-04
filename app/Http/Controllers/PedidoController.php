<?php

namespace App\Http\Controllers;

use App\Http\Helpers\PedidoHelper;
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
        $pse = PedidoHelper::verificarEstoque($pedido);                                 //Verifica estoque
        if (!$pse->isEmpty()):                                                          //Se falta produto em estoque
            $mensagem = 'Falta em estoque:\n' . $pse->implode('nome_produto', '\n');    //Criar mensagem com rela��o de itens faltantes
            PedidoHelper::mensagem($mensagem, back()->getTargetUrl());                  //Exibe mensagem e redireciona para p�gina anterior
        endif;
        PedidoHelper::baixarEstoque($pedido);                                           //D� baixa no estoque
        $pedido->status = 'separado';                                                     //Altera o status do pedido para separado
        $pedido->save();                                                                //Salva altera��o em pedido
        PedidoHelper::mensagem('Pedido aceito com sucesso.', route('pedidos'));         //Exibe mensagem de sucesso e redireciona para p�gina de pedidos
    }

    /** M�todo que altera status do pedido para despachado
     * @param $id int identificador do pedido
     */
    public function despachar($id)
    {
        PedidoHelper::alterarStatus($id, 'despachado'); //solicita altera��o de status
    }

    /** M�todo que cancela pedido
     * @param $id int identificador do pedido
     */
    public function cancelar($id)
    {
        $pedido = Pedido::find($id);                            //Busca pedido pelo id
        if ($pedido->status == 'cancelado'):                    //Se pedido j�  estiver cancelado
            //Envia mensagem informando que j� est� cancelado e retorna a p�gina de exibi��o
            PedidoHelper::mensagem('Pedido j\u00e1 est\u00e1 cancelado.', back()->getTargetUrl());
            return;
        elseif ($pedido->status == 'despachado'):               //Se pedido j� foi despachado
            //Envia mensagem informando que pedido n�o pode ser cancelado e retorna a p�gina de exibi��o
            PedidoHelper::mensagem('Pedido n\u00e3o pode ser cancelado.', back()->getTargetUrl());
            return;
        elseif ($pedido->status != 'pendente'):                 //Se status do pedido for diferente de pendente
            PedidoHelper::restabelecerEstoque($pedido);         //Restabelece estoque com produtos do pedido
        endif;
        $pedido->status = 'cancelado';                          //Altera status do pedido para cancelado
        $pedido->save();                                        //Salva altera��o em pedido
        //Envia mensagem de que cancelamento foi feito e retorna a tela que lista pedidos
        PedidoHelper::mensagem('Pedido cancelado com sucesso', route('pedidos'));
    }
}