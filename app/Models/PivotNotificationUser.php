<?php

namespace App\Models;

/**
 * @property integer $notification_id
 * @property integer $user_id
 */
class PivotNotificationUser extends Model
{
    protected $guarded = [];

    public $timestamps = false;
}
