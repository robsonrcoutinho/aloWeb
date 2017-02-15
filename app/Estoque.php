<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    public $table = 'estoques';
    protected $fillable = ['fk_id_produto', 'quantidade'];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'fk_id_produto');
    }

}
    

