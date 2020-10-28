<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
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

    public function getToUserAttribute()
    {
        return $this->seller_user_id !== auth()->user()->id ? $this->sellerUser : $this->buyerUser;
    }
}
