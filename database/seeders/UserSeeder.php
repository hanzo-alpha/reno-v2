<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->create([
                'email' => config('app.default_user.email'),
                'username' => config('app.default_user.username'),
                'password' => Hash::make(config('app.default_user.password')),
                'name' => config('app.default_user.name'),
            ]);
    }
}
