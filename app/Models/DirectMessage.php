<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DirectMessage extends Model
{
    const UPDATED_AT = null;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(DirectMessageRoom::class, 'direct_message_room_id');
    }

    /**
     * @return HasMany
     */
    public function files(): HasMany
    {
        return $this->hasMany(DirectMessageFile::class);
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

    /**
     * 相手のUser情報を取得する
     *
     * @return User
     */
    public function getToUserAttribute()
    {
        return $this->seller_user_id !== auth()->user()->id ? $this->sellerUser : $this->buyerUser;
    }
}
