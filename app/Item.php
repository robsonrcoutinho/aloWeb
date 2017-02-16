<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['elemento_id', 'elemento_type', 'quantidade', 'pedido_id'];

    public function elemento()
    {
        return $this->morphTo();
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
