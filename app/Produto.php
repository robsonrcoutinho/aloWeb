<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';
    protected $fillable = ['nome_produto', 'valor', 'fk_id_categoria', 'fk_id_marca', 'imagem'];


    //Produto tem uma categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'fk_id_categoria');
    }

    //Produto tem uma marcas
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'fk_id_marca');
    }

    public function estoque()
    {
        return $this->hasOne(Estoque::class);
    }
    public function items()
    {
        return $this->morphMany(Item::class, 'elemento');
    }
}
