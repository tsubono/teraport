<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DirectMessageFile extends Model
{
    const UPDATED_AT = null;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function directMessage(): BelongsTo
    {
        return $this->belongsTo(DirectMessage::class);
    }
}
