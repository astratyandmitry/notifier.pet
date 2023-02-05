<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    protected array $data = [
        [
            'email' => 'admin@notifier.pet',
            'password' => 'admin',
        ],
        [
            'email' => 'astratyandmitry@gmail.com',
            'password' => 'dmitry',
        ],
    ];

    public function run(): void
    {
        collect($this->data)->each(function (array $data): void {
            $data['password'] = bcrypt($data['password']);

            Admin::query()->create($data);
        });
    }
}
