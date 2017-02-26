<?php
/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 22/02/2017
 * Time: 09:41
 */

namespace App\Http\Helpers;

use App\Pedido;

/**Classe auxiliar para opera��es relacionadas a pedidos
 * Class PedidoHelper
 * @package App\Http\Helpers
 */
class PedidoHelper
{
    /**M�todo que c�lcula o valor total do pedido
     * @param Pedido $pedido
     * @return float valor total do pedido
     */
    public static function total(Pedido $pedido)
    {
        $total = 0.00;                                              //inicia a vari�vel para acumular valor do pedido
        foreach ($pedido->items as $item):                          //Percorre os itens do pedido
            $total += $item->elemento->valor * $item->quantidade;   //c�lcula o valor de cada item e soma ao total
        endforeach;
        return $total;                                              //Retorna o total
    }

    /**M�todo que verifica se estoque de produtos para pedido
     * @param Pedido $pedido
     * @return static rela��o de produtos com estoque insuficiente
     */
    public static function verificarEstoque(Pedido $pedido)
    {
        $estoques = \App\Estoque::with('produto')->get();           //Busta estoque de produtos
        $pse = collect();                                           //Cria cole��o para armazenar produtos com estoque insuficiente
        foreach ($pedido->items as $item):                          //Percorre itens do pedido
            if ($item->elemento instanceof \App\Promocao):          //Se elemento for promo��o
                foreach ($item->elemento->produtos as $produto):    //Percorre produtos
                    //Busca estoque de produto
                    $estoque = $estoques->where('fk_id_produto', $produto->id)->first();
                    if ($estoque->quantidade >= $item->quantidade): //Se quantidade em estoque for maior ou igual a quantidade do item
                        $estoque->quantidade -= $item->quantidade;  //Decrementa a quantidade do item da quantidade do estoque
                    else:                                           //Se quantidade em estoque for insuficiente
                        $pse->push($produto);                       //Guarda produto na cole��o
                    endif;
                endforeach;
            else:                                                   //Se elemento n�o for promo��o (produto)
                //Busca estoque do produto
                $estoque = $estoques->where('fk_id_produto', $item->elemento->id)->first();
                if ($estoque->quantidade >= $item->quantidade):     //Se quantidade em estoque for maior ou igual a quantidade do item
                    $estoque->quantidade -= $item->quantidade;      //Decrementa a quantidade do item da quantidade do estoque
                else:                                               //Se quantidade em estoque for insuficiente
                    $pse->push($item->elemento);                    //Guarda produto na cole��o
                endif;
            endif;
        endforeach;
        return $pse->unique('nome_produto');                        //Retorna cole��o de produtos remo��o repeti��es
    }

    /**M�todo que realiza baixa de estoque de produtos com base no pedido passado
     * @param Pedido $pedido
     */
    public static function baixarEstoque(Pedido $pedido)
    {
        $estoques = \App\Estoque::with('produto')->get();       //Busta estoque de produtos
        foreach ($pedido->items as $item):                      //Percorre itens do pedido
            if ($item->elemento instanceof \App\Promocao):      //Se elemento for promo��o
                foreach ($item->elemento->produtos as $produto)://Percorre produtos
                    //Busca estoque de produto
                    $estoque = $estoques->where('fk_id_produto', $produto->id)->first();
                    $estoque->quantidade -= $item->quantidade;  //Decrementa a quantidade do item da quantidade do estoque
                    $estoque->save();                           //Salva altera��o de estoque
                endforeach;
            else:
                //Busca estoque de produto
                $estoque = $estoques->where('fk_id_produto', $item->elemento->id)->first();
                $estoque->quantidade -= $item->quantidade;      //Decrementa a quantidade do item da quantidade do estoque
                $estoque->save();                               //Salva altera��o de estoque
            endif;
        endforeach;
    }

    /** M�todo que realiza restabelecimento de produtos no estoque com base no pedido passado
     * @param Pedido $pedido
     */
    public static function restabelecerEstoque(Pedido $pedido)
    {
        $estoques = \App\Estoque::with('produto')->get();       //Busta estoque de produtos
        foreach ($pedido->items as $item):                      //Percorre itens do pedido
            if ($item->elemento instanceof \App\Promocao):      //Se elemento for promo��o
                foreach ($item->elemento->produtos as $produto)://Percorre produtos
                    //Busca estoque de produto
                    $estoque = $estoques->where('fk_id_produto', $produto->id)->first();
                    $estoque->quantidade += $item->quantidade;  //Incrementa a quantidade do item da quantidade do estoque
                    $estoque->save();                           //Salva altera��o de estoque
                endforeach;
            else:
                //Busca estoque de produto
                $estoque = $estoques->where('fk_id_produto', $item->elemento->id)->first();
                $estoque->quantidade += $item->quantidade;      //Incrementa a quantidade do item da quantidade do estoque
                $estoque->save();                               //Salva altera��o de estoque
            endif;
        endforeach;
    }
    /**M�todo que exibe mensagem e redireciona p�gina
     * @param $texto string texto a ser exibido na mensagem
     * @param $rota string caminho para redirecionamento
     */
    public static function mensagem($texto, $rota)
    {
        //Apresenta mensagem passada e redireciona para rota fornecida
        echo "<script>
                alert('$texto');
                window.location='$rota';
                </script>";
    }
}