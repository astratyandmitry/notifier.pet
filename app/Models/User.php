<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $email
 * @property string $password
 *
 * @property \App\Models\UserNotificationSetting|\Illuminate\Database\Eloquent\Collection $notificationSettings
 */
class User extends Model
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['email', 'password',];

    protected $hidden = ['password'];

    public static function boot(): void
    {
        parent::boot();

        static::created(function (User $model): void {
            NotificationCategory::query()->get()->map(function (NotificationCategory $category) use ($model): void {
                $model->notificationSettings()->create([
                    'category_id' => $category->id,
                ]);
            });
        });
    }

    public function notificationSettings(): HasMany
    {
        return $this->hasMany(UserNotificationSetting::class);
    }
}
