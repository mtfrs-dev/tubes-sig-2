<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\LocationObjectSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Test Admin',
            'role' => 'ADMIN',
            'email' => 'test@admin.com',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'role' => 'User',
            'email' => 'test@user.com',
        ]);

        $this->call(LocationObjectSeeder::class);
    }
}
