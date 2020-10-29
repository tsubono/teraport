<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TransactionReview extends Model
{
    const UPDATED_AT = null;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fromUser(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'from_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function toUser(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'to_user_id');
    }
}
