<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // database/seeders/DepartmentsTableSeeder.php
public function run()
{
    \App\Models\Department::create(['name' => 'HR']);
    \App\Models\Department::create(['name' => 'Finance']);
}

}
