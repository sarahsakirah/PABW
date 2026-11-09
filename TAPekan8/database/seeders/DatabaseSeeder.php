<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\UserRole;
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
        User::firstOrCreate(['email' => 'admin@example.com'], [
            'name' => 'Administrator',
            'role' => UserRole::Admin,
            'password' => 'password',
        ]);
        User::firstOrCreate(['email' => 'user@example.com'], [
            'name' => 'User Biasa',
            'role' => UserRole::User,
            'password' => 'password',
        ]);

        $this->call(\Modules\Buku\Database\Seeders\BukuDatabaseSeeder::class);
    }
}
