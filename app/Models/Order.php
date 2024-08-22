<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'id',
        'chat_id',
        'seller_id',
        'client_id',
        'description',
        'price',
        'order_ready_in',
        'available_until',
        'status',
        'deadline',
    ];

    protected $casts = [
        'price_type' => OrderStatusEnum::class,
    ];
}
