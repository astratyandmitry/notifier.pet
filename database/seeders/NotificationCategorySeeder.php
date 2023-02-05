<?php

namespace Database\Seeders;

use App\Models\NotificationCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationCategorySeeder extends Seeder
{
    use WithoutModelEvents;

    protected array $data = [
        [
            'title' => 'Системные',
        ],
        [
            'title' => 'Маркетинговые',
        ],
        [
            'title' => 'Прочее',
        ],
    ];

    public function run(): void
    {
        collect($this->data)->each(function (array $data): void {
            NotificationCategory::query()->create($data);
        });
    }
}
