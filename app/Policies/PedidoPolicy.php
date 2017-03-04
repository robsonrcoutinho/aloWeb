<?php

namespace App\Policies;

use App\Pedido;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PedidoPolicy
{
    use HandlesAuthorization;

    public function visualizar(User $user)
    {
        return $user->role == 'admin' || $user->role == 'usuario';
    }
    public function detalhar(User $user)
    {
        return $user->role == 'admin';
    }
    public function aceitar(User $user, Pedido $pedido)
    {
        return $user->role == 'admin' && $pedido->status=='pendente';
    }
    public function despachar(User $user, Pedido $pedido)
    {
        return $user->role == 'admin' && $pedido->status == 'separado';
    }
    public function cancelar(User $user, Pedido $pedido)
    {
        return $user->role == 'admin'&& $pedido->status!='despachado'&& $pedido->status!='cancelado';
    }
}
