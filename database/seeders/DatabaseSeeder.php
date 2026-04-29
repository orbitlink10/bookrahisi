<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@bookrahisi.test'],
            [
                'name' => 'Book Rahisi Owner',
                'phone_number' => '+254700000010',
                'password' => 'password',
                'is_admin' => true,
                'account_status' => 'active',
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test Customer',
                'phone_number' => '+254700000011',
                'password' => 'password',
                'is_admin' => false,
                'account_status' => 'active',
            ]
        );
    }
}
