<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Enums\OrderStatusEnum;
use App\Enums\ChatTextTypeEnum;
use Illuminate\Database\Eloquent\Model;

class ChatText extends Model
{
    protected $table = 'chat_texts';

    protected $fillable = [
        'chat_id',
        'value',
        'sender_id',
    ];

    protected $casts = [
        'type' => ChatTextTypeEnum::class,
    ];

    public function chat(){
        return $this->belongsTo(Chat::class, 'chat_id');
        // jak cos sie zjebalo z wiadomosciami to przez to ze było tu has many
    }
}
