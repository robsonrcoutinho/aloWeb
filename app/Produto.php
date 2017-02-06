<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';
    protected $fillable = ['nome_produto', 'valor'];


    //Produto pertence a uma categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    //Produto por ter varias marcas
    public function marcas()
    {
        return $this->hasMany(Marca::class);
    }
}
