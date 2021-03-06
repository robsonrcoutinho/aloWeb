<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";
    protected $fillable = [
        'name', 'email', 'password', 'razao_social','nome_fantasia','role','rua','telefone','cidade','uf','cnpj_cpf'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'fk_id_user');
    }
    public function chats()
    {
        return $this->hasMany(Chat::class, 'fk_id_user');
    }
}
