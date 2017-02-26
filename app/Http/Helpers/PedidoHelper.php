<?php
/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 22/02/2017
 * Time: 09:41
 */

namespace App\Http\Helpers;

use App\Pedido;

/**Classe auxiliar para operações relacionadas a pedidos
 * Class PedidoHelper
 * @package App\Http\Helpers
 */
class PedidoHelper
{
    /**Método que cálcula o valor total do pedido
     * @param Pedido $pedido
     * @return float valor total do pedido
     */
    public static function total(Pedido $pedido)
    {
        $total = 0.00;                                              //inicia a variável para acumular valor do pedido
        foreach ($pedido->items as $item):                          //Percorre os itens do pedido
            $total += $item->elemento->valor * $item->quantidade;   //cálcula o valor de cada item e soma ao total
        endforeach;
        return $total;                                              //Retorna o total
    }

    /**Método que verifica se estoque de produtos para pedido
     * @param Pedido $pedido
     * @return static relação de produtos com estoque insuficiente
     */
    public static function verificarEstoque(Pedido $pedido)
    {
        $estoques = \App\Estoque::with('produto')->get();           //Busta estoque de produtos
        $pse = collect();                                           //Cria coleção para armazenar produtos com estoque insuficiente
        foreach ($pedido->items as $item):                          //Percorre itens do pedido
            if ($item->elemento instanceof \App\Promocao):          //Se elemento for promoção
                foreach ($item->elemento->produtos as $produto):    //Percorre produtos
                    //Busca estoque de produto
                    $estoque = $estoques->where('fk_id_produto', $produto->id)->first();
                    if ($estoque->quantidade >= $item->quantidade): //Se quantidade em estoque for maior ou igual a quantidade do item
                        $estoque->quantidade -= $item->quantidade;  //Decrementa a quantidade do item da quantidade do estoque
                    else:                                           //Se quantidade em estoque for insuficiente
                        $pse->push($produto);                       //Guarda produto na coleção
                    endif;
                endforeach;
            else:                                                   //Se elemento não for promoção (produto)
                //Busca estoque do produto
                $estoque = $estoques->where('fk_id_produto', $item->elemento->id)->first();
                if ($estoque->quantidade >= $item->quantidade):     //Se quantidade em estoque for maior ou igual a quantidade do item
                    $estoque->quantidade -= $item->quantidade;      //Decrementa a quantidade do item da quantidade do estoque
                else:                                               //Se quantidade em estoque for insuficiente
                    $pse->push($item->elemento);                    //Guarda produto na coleção
                endif;
            endif;
        endforeach;
        return $pse->unique('nome_produto');                        //Retorna coleção de produtos remoção repetições
    }

    /**Método que realiza baixa de estoque de produtos com base no pedido passado
     * @param Pedido $pedido
     */
    public static function baixarEstoque(Pedido $pedido)
    {
        $estoques = \App\Estoque::with('produto')->get();       //Busta estoque de produtos
        foreach ($pedido->items as $item):                      //Percorre itens do pedido
            if ($item->elemento instanceof \App\Promocao):      //Se elemento for promoção
                foreach ($item->elemento->produtos as $produto)://Percorre produtos
                    //Busca estoque de produto
                    $estoque = $estoques->where('fk_id_produto', $produto->id)->first();
                    $estoque->quantidade -= $item->quantidade;  //Decrementa a quantidade do item da quantidade do estoque
                    $estoque->save();                           //Salva alteração de estoque
                endforeach;
            else:
                //Busca estoque de produto
                $estoque = $estoques->where('fk_id_produto', $item->elemento->id)->first();
                $estoque->quantidade -= $item->quantidade;      //Decrementa a quantidade do item da quantidade do estoque
                $estoque->save();                               //Salva alteração de estoque
            endif;
        endforeach;
    }

    /** Método que realiza restabelecimento de produtos no estoque com base no pedido passado
     * @param Pedido $pedido
     */
    public static function restabelecerEstoque(Pedido $pedido)
    {
        $estoques = \App\Estoque::with('produto')->get();       //Busta estoque de produtos
        foreach ($pedido->items as $item):                      //Percorre itens do pedido
            if ($item->elemento instanceof \App\Promocao):      //Se elemento for promoção
                foreach ($item->elemento->produtos as $produto)://Percorre produtos
                    //Busca estoque de produto
                    $estoque = $estoques->where('fk_id_produto', $produto->id)->first();
                    $estoque->quantidade += $item->quantidade;  //Incrementa a quantidade do item da quantidade do estoque
                    $estoque->save();                           //Salva alteração de estoque
                endforeach;
            else:
                //Busca estoque de produto
                $estoque = $estoques->where('fk_id_produto', $item->elemento->id)->first();
                $estoque->quantidade += $item->quantidade;      //Incrementa a quantidade do item da quantidade do estoque
                $estoque->save();                               //Salva alteração de estoque
            endif;
        endforeach;
    }
    /**Método que exibe mensagem e redireciona página
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