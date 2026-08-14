<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        if (! $email || ! $password) {
            $this->command?->warn('Skipping admin user creation: set ADMIN_EMAIL / ADMIN_PASSWORD in .env');

            return;
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Admin',
                'password' => $password,
                'role' => 'admin',
                'is_active' => true,
            ]
        );
    }
}
