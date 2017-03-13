<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChatPolicy
{
    use HandlesAuthorization;

    public function visualizar(User $user)
    {
        return $user->role == 'admin' || $user->role == 'usuario';
    }

    public function salvar(User $user)
    {
        return $user->role == 'admin' || $user->role == 'usuario'|| $user->role == 'cliente';
    }

    public function excluir(User $user)
    {
        return $user->role == 'admin';
    }
}
