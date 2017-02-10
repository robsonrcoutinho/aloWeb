<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promocao extends Model
{
    protected $fillable = ['titulo', 'valor'];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'produto_promocao','fk_id_promocao', 'fk_id_produto');
    }
}
