<?php

namespace App\Models;

use Illuminate\Support\Str;
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

    public function client(){
        return $this->belongsTo(User::class);
    }
    public function seller(){
        return $this->belongsTo(User::class);
    }
}
