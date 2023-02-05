<?php

namespace App\Models;

/**
 * @property integer $notification_id
 * @property integer $category_id
 */
class PivotNotificationCategory extends Model
{
    protected $guarded = [];

    public $timestamps = false;
}
