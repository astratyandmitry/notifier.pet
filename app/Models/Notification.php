<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @property integer $id
 * @property string $uuid
 * @property string $title
 * @property string $body
 *
 * @property \App\Models\NotificationAggregate $aggregate
 * @property \App\Models\NotificationCategory[]|\Illuminate\Database\Eloquent\Collection $categories
 * @property \App\Models\User[]|\Illuminate\Database\Eloquent\Collection $users
 *
 * @method static \Illuminate\Database\Eloquent\Builder unreadByUser(\App\Models\User $user)
 */
class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body'];

    public static function boot(): void
    {
        parent::boot();

        // todo: move to EventServiceProvider

        static::creating(function (Notification $model): void {
            $model->uuid = Str::uuid();
        });

        static::created(function (Notification $model): void {
            $model->aggregate()->create();
        });

        static::deleted(function (Notification $model): void {
            $model->aggregate()->delete();
        });
    }

    public function aggregate(): HasOne
    {
        return $this->hasOne(NotificationAggregate::class);
    }

    public function categories(): HasManyThrough
    {
        return $this->hasManyThrough(NotificationCategory::class, PivotNotificationCategory::class, 'notification_id', 'id', 'id', 'category_id');
    }

    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, PivotNotificationUser::class);
    }

    public function categoriesSync(array $categoriesId): void
    {
        if (! $this->wasRecentlyCreated) {
            PivotNotificationCategory::query()->where('notification_id', $this->id)->delete();
        }

        collect($categoriesId)->map(function (int $categoryId): void {
            PivotNotificationCategory::query()->create([
                'notification_id' => $this->id,
                'category_id' => $categoryId,
            ]);
        });
    }

    public function markAsRead(User $user): void
    {
        DB::transaction(function () use ($user): void {
            $this->users()->create(['user_id' => $user->id]);

            $this->aggregate->increment('count_views');
        });
    }
}
