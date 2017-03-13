<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo(User::class, 'fk_id_user');
    }

    public function scopeLista($query)
    {
        return $query->join('users','chats.fk_id_user','=','users.id')
            ->select('chats.*','users.name')->get();
    }
}
