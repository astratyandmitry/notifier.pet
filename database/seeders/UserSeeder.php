<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    protected array $data = [
        'first@user.com',
        'second@user.com',
        'third@user.com',
    ];

    public function run(): void
    {
        collect($this->data)->each(function (string $email): void {
            User::query()->create([
                'password' => bcrypt('password'),
                'email' => $email,
            ]);
        });
    }
}
