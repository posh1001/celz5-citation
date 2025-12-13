<?php

namespace App\Http\Controllers;

use App\Models\GroupCitation;
use Illuminate\Http\Request;

class GroupCitationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'phone'         => 'required|string|max:20',
            'kingschat'     => 'nullable|string|max:255',
            'unit'          => 'nullable|string|max:255',
            'designation'   => 'nullable|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'title'         => 'required|string|max:255',
            'period_from'   => 'nullable|date',
            'period_to'     => 'nullable|date',
            'description'   => 'nullable|string|max:1500',
        ]);

        GroupCitation::create($request->all());

        return redirect()->back()->with('success', 'Citation submitted successfully!');
    }
}
