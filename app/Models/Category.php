<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * App\Models\Category
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Banner[] $banners
 * @property-read int|null $banners_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category noAdmin()
 * @method static \Illuminate\Database\Eloquent\Builder|Category noPatient()
 */
class Category extends Model
{
    use HasFactory;

    const ADMINISTRATOR_CATEGORY_TITLE = 'administrator';
    const PATIENT_CATEGORY_TITLE = 'patient';

    public static function scopeNoAdmin($query)
    {
        return $query->where('title', '!=', self::ADMINISTRATOR_CATEGORY_TITLE);
    }

    public static function scopeNoPatient($query)
    {
        return $query->where('title', '!=', self::PATIENT_CATEGORY_TITLE);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function banners(): HasMany
    {
        return $this->hasMany(Banner::class);
    }
}
