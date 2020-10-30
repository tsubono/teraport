<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    const UPDATED_AT = null;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function service(): HasOne
    {
        return $this->hasOne(Service::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sellerUser(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'seller_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function buyerUser(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'buyer_user_id');
    }

    /**
     * 相手のUser情報を取得する
     *
     * @return User
     */
    public function getToUserAttribute()
    {
        return $this->seller_user_id !== auth()->user()->id ? $this->sellerUser : $this->buyerUser;
    }

    /**
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(TransactionMessage::class);
    }

    /**
     * ステータステキスト
     *
     * @return string
     */
    public function getStatusTextAttribute(): string
    {
        if ($this->status == 1) {
            return '解決済み';
        }
        return '相談中';
    }
}
