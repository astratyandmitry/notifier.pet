<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * @property integer $id
 * @property string $uuid
 * @property string $title
 * @property string $body
 *
 * @property \App\Models\NotificationAggregate $aggregate
 * @property \App\Models\NotificationCategory[]|\Illuminate\Database\Eloquent\Collection $categories
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
    }

    public function aggregate(): HasOne
    {
        return $this->hasOne(NotificationAggregate::class);
    }

    public function categories(): HasManyThrough
    {
        return $this->hasManyThrough(NotificationCategory::class, PivotNotificationCategory::class);
    }

    public function categoriesSync(Collection $categoriesId): void
    {
        if (! $this->wasRecentlyCreated) {
            PivotNotificationCategory::query()->where('notification_id', $this->id)->delete();
        }

        $categoriesId->map(function (int $categoryId): void {
            PivotNotificationCategory::query()->create([
                'notification_id' => $this->id,
                'category_id' => $categoryId,
            ]);
        });
    }
}
