<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = "pedidos";

    protected $fillable = ['data_pedido', 'fk_id_user'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'fk_id_user');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
