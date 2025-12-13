<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CitationController extends Controller
{
    public function create($department)
    {
        // You can fetch from DB or use hardcoded array
        $departments = [
            1 => 'Cell Ministry',
            2 => 'Zonal Operations',
            3 => 'Church Admin / Pioneering & Visitation',
            4 => 'Rhapsody of Realities',
            5 => 'Healing School',
            6 => 'Finance',
            7 => 'TV Production',
            8 => 'Ministry Material',
            9 => 'Foundation School & First Timer Ministries',
            10 => 'LoveWorld Music Department',
            11 => 'Global Mission Mandate / HR / Admin Department',
            12 => 'Children and Women Ministries',
            13 => 'LLM, LXP, Ministry Prog. Bibles Partnership Dept',
            14 => 'LW USA, LTM / Radio Brands, Inner City Missions',
            15 => 'Follow Up Department',
        ];

        if (!isset($departments[$department])) {
            abort(404);
        }

        $departmentName = $departments[$department];

        return view('department-form', [
            'department' => (object)[
                'id' => $department,
                'name' => $departmentName,
            ]
        ]);
    }
}
