<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $user_id
 * @property integer $category_id
 * @property boolean $allowed
 *
 * @property \App\Models\NotificationCategory $category
 */
class UserNotificationSetting extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function category(): BelongsTo
    {
        return $this->belongsTo(NotificationCategory::class);
    }
}
