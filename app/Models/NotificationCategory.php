<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property string $title
 * @property \App\Models\Notification[]|\Illuminate\Database\Eloquent\Collection $notifications
 */
class NotificationCategory extends Model
{
    protected $fillable = ['title'];

    public static function boot(): void
    {
        parent::boot();

        // todo: move to EventServiceProvider

        static::created(function (NotificationCategory $model): void {
            User::query()->get()->map(function(User $user) use ($model): void {
                $user->notificationSettings()->create([
                    'category_id' => $model->id,
                    'allowed' => true,
                ]);
            });
        });

        static::deleting(function (NotificationCategory $model): void {
            $model->notifications()->delete();
        });
    }

    public function notifications(): HasManyThrough
    {
        return $this->hasManyThrough(Notification::class, NotificationAggregate::class);
    }
}
