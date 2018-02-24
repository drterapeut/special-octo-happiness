<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ChatMessage extends Model
{
    protected $table = 'chat_messages';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
