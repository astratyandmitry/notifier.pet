<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $notification_id
 * @property integer $count_views
 */
class NotificationAggregate extends Model
{
    protected $casts = [
        'count_views' => 'integer',
    ];
}
