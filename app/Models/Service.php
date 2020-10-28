<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(ServiceImage::class)->orderBy('sort');
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * アイキャッチ画像
     *
     * @return string
     */
    public function getEyeCatchImagePathAttribute(): string
    {
        return !empty($this->images[0]) ? $this->images[0]->image_path : '/img/default-image.png';
    }

    /**
     * 公開 / 非公開
     *
     * @return string
     */
    public function getIsPublicTextAttribute(): string
    {
        return $this->is_public ? '公開中' : '非公開';
    }
}
