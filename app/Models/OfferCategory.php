<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferCategory extends Model
{
    use HasFactory;
    protected $table = 'offerCategory';

    public function offers()
    {
        return $this->hasMany(Offer::class, 'category_id');
    }
}
