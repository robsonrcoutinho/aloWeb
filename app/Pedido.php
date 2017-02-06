<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = "pedidos";

    // Talvez nem seja necess�rio
    protected $fillable = ['data_pedido'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
