<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DepartmentForm; // This model contains your citations

class AdminAuthController extends Controller
{
    /**
     * Show admin login form
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Handle admin login
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt login using the 'admin' guard
        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            // Successful login → redirect to /citations
            return redirect()->route('citations.index');
        }

        // Failed login → redirect back with error
        return back()->withErrors([
            'email' => 'Invalid login credentials.'
        ])->withInput($request->only('email'));
    }

    /**
     * Show admin dashboard (if needed)
     *
     * Note: You can remove this method if you directly use CitationsController@index
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Gather statistics for dashboard
        $departmentsCount = DepartmentForm::distinct('department')->count('department');
        $citationsCount = DepartmentForm::count();
        $citations = DepartmentForm::latest()->paginate(10); // Paginate for the view

        return view('citations', compact(
            'departmentsCount',
            'citationsCount',
            'citations'
        ));
    }

    /**
     * Logout admin
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
