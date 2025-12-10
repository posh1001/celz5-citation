<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update the Super Admin
        Admin::updateOrCreate(
            ['email' => 'Superadmin@citation.com'], // search by email
            [
                'name' => 'Super Admin',
                'password' => Hash::make('SuperAdmin2025'), // hashed password
            ]
        );
    }
}
