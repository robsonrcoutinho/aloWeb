<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = "usuarios";
    protected $fillable = [ 'razao_social','nome_fantasia','rua','telefone','cidade','uf','cnpj_cpf'];


    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
