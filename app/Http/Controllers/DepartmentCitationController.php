<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\DepartmentCitation;
use Illuminate\Http\Request;

class DepartmentCitationController extends Controller
{
public function create($id)
{
    $department = Department::findOrFail($id); // $id must exist in DB
    return view('group-form-page', compact('department'));
}



    public function store(Request $request)
    {
        // dd($request->department_id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'kingschat' => 'required|string|max:100',
            'unit' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'group' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'period_from' => 'required|date',
            'period_to' => 'required|date|after_or_equal:period_from',
            'description' => 'required|string|max:150',
        ]);

        DepartmentCitation::create($request->all());

        return redirect()->back()->with('success', 'Citation submitted successfully!');
    }
}
