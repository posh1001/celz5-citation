<?php

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            'Cell Ministry',
            'Zonal Operations',
            'Church Admin / Pioneering & Visitation',
            'Rhapsody of Realities',
            'Healing School',
            'Finance',
            'TV Production',
            'Ministry Material',
            'Foundation School & First Timer Ministries',
            'LoveWorld Music Department',
            'Global Mission Mandate / HR / Admin Department',
            'Children and Women Ministries',
            'LLM, LXP, Ministry Prog. Bibles Partnership Dept',
            'LW USA, LTM / Radio Brands, Inner City Missions',
            'Follow Up Department'
        ];

        foreach($departments as $name) {
            Department::create(['name' => $name]);
        }
    }
}
