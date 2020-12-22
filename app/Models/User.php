<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;
use App\Notifications\ResetPasswordJP as ResetPasswordNotificationJP;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use Notifiable;

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
     * @return HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(TransactionReview::class, 'to_user_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function requests(): HasMany
    {
        return $this->hasMany(SaleRequest::class);
    }

    /**
     * アイコン画像
     *
     * @return string
     */
    public function getDisplayIconImagePathAttribute(): string
    {
        return $this->icon_image_path ?? secure_asset('img/default-icon.png');
    }

    /**
     * 提供中のサービス
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPublicServicesAttribute(): Collection
    {
        return $this->services()->where('is_public', true)->get();
    }

    /**
     * 最近利用したサービス
     *
     * @return Collection
     */
    public function getCurrentBuyTransactionsAttribute(): Collection
    {
        return $this->buyerTransactions()->take(3)->get();
    }

    /**
     * 最近利用されたサービス
     *
     * @return Collection
     */
    public function getCurrentSaleTransactionsAttribute(): Collection
    {
        return $this->sellerTransactions()->take(3)->get();
    }

    /**
     * パスワードリセットメールを日本語化
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotificationJP($token));
    }

    /**
     * 最近の評価
     *
     * @return Collection
     */
    public function getCurrentReviewsAttribute(): Collection
    {
        return $this->reviews()->take(3)->get();
    }

    /**
     * 評価点数を算出する
     */
    public function getRatePointAttribute()
    {
        $reviews = $this->reviews()->select(DB::raw('count(*) as rate_count, rate'))->groupBy('rate')->get();
        $totalRate = $totalCount = 0;
        foreach ($reviews as $review) {
            $totalRate += $review->rate * $review->rate_count;
            $totalCount += $review->rate_count;
        }

        if ($totalRate === 0 && $totalCount === 0) {
            return '-';
        }

        return round($totalRate / $totalCount, 1);
    }
}
