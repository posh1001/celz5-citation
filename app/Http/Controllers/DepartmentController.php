<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all(); // Fetch all departments from DB
        return view('departments.index', compact('departments'));
    }
}

