<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Chat extends Model
{
    protected $table = 'chats';

    protected $fillable = [
        'title',
        'seller_id',
        'client_id',
        'offer_id',
        'id',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    protected static function boot(){
        parent::boot();

        // Automatically generate a UUID for the ID when creating a new record
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function chatTexts(){
        return $this->hasMany(ChatText::class, 'chat_id');
    }
}
