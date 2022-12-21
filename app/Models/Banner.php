<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Banner
 *
 * @property int $id
 * @property string $url
 * @property string $file_path
 * @property string $file_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Banner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereUrl($value)
 * @mixin \Eloquent
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereName($value)
 * @property string $original_name
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereOriginalName($value)
 * @property-read mixed $storage_path
 * @property int|null $category_id
 * @property-read \App\Models\Category|null $category
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereCategoryId($value)
 * @property string $html
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereHtml($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner forUser()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner ofCategory($category_id)
 */
class Banner extends Model
{
    use HasFactory;

    const IMAGE_FILE_TYPE = 'image';
    const VIDEO_FILE_TYPE = 'video';

    const BANNER_MEDIA_STORAGE_PATH = 'banners/media/';

    const FILE_TYPES = [
        self::IMAGE_FILE_TYPE => self::IMAGE_FILE_TYPE,
        self::VIDEO_FILE_TYPE => self::VIDEO_FILE_TYPE,
    ];

    public function getStoragePathAttribute(): string
    {
        return 'storage/' . self::BANNER_MEDIA_STORAGE_PATH . $this->file_path;
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeForUser($query)
    {
        return $query->where('category_id', request()->user()?->category_id);
    }

    public function scopeOfCategory($query, $category_id)
    {
        return $query->where('category_id', $category_id);
    }
}
