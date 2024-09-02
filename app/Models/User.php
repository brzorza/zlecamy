<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Language;
use App\Enums\UserTypeEnum;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'type',
    ];

    protected $casts = [
        'type' => UserTypeEnum::class,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isUser(){
        return $this->type === UserTypeEnum::USER;
    }
    public function isSeller(){
        return $this->type === UserTypeEnum::SELLER;
    }
    public function offers(): HasMany{
        return $this->hasMany(Offer::class);
    }
    public function userLanguages(){
        return $this->hasMany(UserLanguage::class);
    }
    public function chatsAsSeller(){
        return $this->hasMany(Chat::class, 'seller_id');
    }

    public function chatsAsClient(){
        return $this->hasMany(Chat::class, 'client_id');
    }
}
