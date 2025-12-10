<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed admin first
        $this->call(AdminSeeder::class);

        // Seed test user
        $this->call(UserSeeder::class); // optional if you have UserSeeder
    }
}
