<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MarcaPolicy
{
    use HandlesAuthorization;

    public function visualizar(User $user)
{
    return $user->role == 'admin' || $user->role == 'usuario';
}

    public function salvar(User $user)
    {
        return $user->role == 'admin';
    }

    public function alterar(User $user)
    {
        return $user->role == 'admin';
    }

    public function excluir(User $user)
    {
        return $user->role == 'admin';
    }
}
