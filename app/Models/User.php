<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    /**
     * @return HasMany
     */
    public function sellerTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'seller_user_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function buyerTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'buyer_user_id', 'id');
    }

    /**
     * アイコン画像
     *
     * @return string
     */
    public function getDisplayIconImagePathAttribute(): string
    {
        return $this->icon_image_path ?? asset('img/default-icon.png');
    }

    /**
     * 出品中のサービス
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPublicServicesAttribute(): Collection
    {
        return $this->services()->where('is_public', true)->get();
    }
}
