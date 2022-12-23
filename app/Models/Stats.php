<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * App\Models\Stats
 *
 * @property int $id
 * @property string $date
 * @property int $banner_id
 * @property int $total_views
 * @property int $total_clicks
 * @property mixed $params
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Stats newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stats newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stats query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stats whereBannerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stats whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stats whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stats whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stats whereParams($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stats whereTotalClicks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stats whereTotalViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stats whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Banner $banner
 */
class Stats extends Model
{
    use HasFactory;

    const ACTION_SHOW = 'show';
    const ACTION_CLICK = 'click';

    const ACTIONS = [self::ACTION_SHOW, self::ACTION_CLICK];

    public function banner(): BelongsTo
    {
        return $this->belongsTo(Banner::class);
    }
}
