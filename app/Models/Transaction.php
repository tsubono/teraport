<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    const UPDATED_AT = null;
    const STATUS_COMPLETE = 1;
    const STATUS_CANCEL_REQUEST = 2;
    const STATUS_CANCEL = 3;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sale(): HasOne
    {
        return $this->hasOne(TransactionSale::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function review(): HasOne
    {
        return $this->hasOne(TransactionReview::class);
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
        if ($this->status == self::STATUS_COMPLETE) {
            return '解決済み';
        }
        if ($this->status == self::STATUS_CANCEL_REQUEST) {
            return 'キャンセル承諾待ち';
        }
        if ($this->status == self::STATUS_CANCEL) {
            return 'キャンセル';
        }
        return '相談中';
    }

    /**
     * @return Model|HasOne|object|null
     */
    public function getMyReviewAttribute()
    {
        return $this->review()->where('from_user_id', auth()->user()->id)->first();
    }

    /**
     * @return Model|HasOne|object|null
     */
    public function getReceiveReviewAttribute()
    {
        return $this->review()->where('to_user_id', auth()->user()->id)->first();
    }
}
