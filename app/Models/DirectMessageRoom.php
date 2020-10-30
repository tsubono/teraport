<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DirectMessageRoom extends Model
{
    const UPDATED_AT = null;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(DirectMessage::class);
    }

    /**
     * @return BelongsTo
     */
    public function user1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_1_id');
    }

    /**
     * @return BelongsTo
     */
    public function user2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_2_id');
    }

    /**
     * 相手のUser情報を取得する
     *
     * @return User
     */
    public function getToUserAttribute(): User
    {
        return $this->user_1_id !== auth()->user()->id ? $this->user1 : $this->user2;
    }

    /**
     * 相手のUser情報を取得する
     *
     * @return DirectMessage|object|null
     */
    public function getFirstMessageAttribute()
    {
        return $this->messages()->orderBy('created_at', 'desc')->first();
    }
}
