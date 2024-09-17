<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'id',
        'user_id',
        'message',
        'link',
        'read',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
