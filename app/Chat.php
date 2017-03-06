<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public function usuario()
    {
        return $this->belongsTo(User::class, 'fk_id_user');
    }
}
