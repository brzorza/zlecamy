<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ChatText extends Model
{
    protected $table = 'chat_texts';

    protected $fillable = [
        'chat_id',
        'text',
        'sender_id',
    ];

    public function chat(){
        return $this->belongsTo(Chat::class, 'chat_id');
        // jak cos sie zjebalo z wiadomosciami to przez to ze było tu has many
    }
}
