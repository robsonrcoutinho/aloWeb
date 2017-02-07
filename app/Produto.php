<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';
    protected $fillable = ['nome_produto', 'valor'];


    //Produto tem uma categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class,'fk_id_categoria');
    }

    //Produto por ter varias marcas
    public function marca()
    {
        return $this->hasMany(Marca::class);
    }
}
