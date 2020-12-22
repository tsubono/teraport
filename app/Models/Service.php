<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
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
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * アイキャッチ画像
     *
     * @return string
     */
    public function getEyeCatchImagePathAttribute(): string
    {
        return !empty($this->images[0]) ? $this->images[0]->image_path : secure_asset('img/default-image.png');
    }

    /**
     * サブ画像1
     *
     * @return string
     */
    public function getSubImagePath1Attribute(): string
    {
        return !empty($this->images[1]) ? $this->images[1]->image_path : secure_asset('img/default-image.png');
    }

    /**
     * サブ画像2
     *
     * @return string
     */
    public function getSubImagePath2Attribute(): string
    {
        return !empty($this->images[2]) ? $this->images[2]->image_path : secure_asset('img/default-image.png');
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
