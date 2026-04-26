<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin',
            'password' => 'password',
            'role' => 'admin',
        ]);

        User::updateOrCreate([
            'email' => 'user@example.com',
        ], [
            'name' => 'User',
            'password' => 'password',
            'role' => 'user',
        ]);

        $this->call([
            ProductSeeder::class,
        ]);
    }
}
