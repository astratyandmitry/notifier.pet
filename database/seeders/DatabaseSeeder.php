<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\NotificationCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            NotificationCategorySeeder::class,
        ]);

        $this->call(UserSeeder::class);

        Notification::factory(20)->create();

        Notification::query()->get()->map(function (Notification $notification): void {
            $notification->categoriesSync(
                NotificationCategory::query()->inRandomOrder()->limit(rand(1, 3))->pluck('id')
            );
        });
    }
}
