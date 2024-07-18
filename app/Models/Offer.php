<?php

namespace App\Models;

use App\Enums\PriceTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'localization',
        'category_id',
        'all_tags',
        'cover',
        'price',
        'price_type',
        'delivery_time',
    ];

    protected $casts = [
        'price_type' => PriceTypeEnum::class,
    ];
    public function category()
    {
        return $this->belongsTo(OfferCategory::class, 'category_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function delete(){
        Storage::delete($this->cover);
        return parent::delete();
    }
}
