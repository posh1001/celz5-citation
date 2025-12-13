<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentFormController;
use App\Http\Controllers\GroupFormController;
use App\Http\Controllers\CitationsController;
use App\Http\Controllers\AdminAuthController;

// ---------------------------
// Admin Authentication Routes
// ---------------------------
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

// ---------------------------
// Protected Admin Routes
// ---------------------------
Route::middleware('auth:admin')->group(function () {

    // Citations Dashboard
    Route::get('/citations', [CitationsController::class, 'index'])
        ->name('citations.index');

    // ---------------------------
    // Departments Exports
    Route::get('/departments/exportExcel', [CitationsController::class, 'exportExcel'])
        ->name('departments.exportExcel')->defaults('filter', 'departments');
    Route::get('/departments/exportCSV', [CitationsController::class, 'exportCSV'])
        ->name('departments.exportCSV')->defaults('filter', 'departments');
    Route::get('/departments/exportPDF', [CitationsController::class, 'exportPDF'])
        ->name('departments.exportPDF')->defaults('filter', 'departments');
    Route::get('/departments/exportWord', [CitationsController::class, 'exportWord'])
        ->name('departments.exportWord')->defaults('filter', 'departments');

    // Groups Exports
    Route::get('/groups/exportExcel', [CitationsController::class, 'exportExcel'])
        ->name('groups.exportExcel')->defaults('filter', 'groups');
    Route::get('/groups/exportCSV', [CitationsController::class, 'exportCSV'])
        ->name('groups.exportCSV')->defaults('filter', 'groups');
    Route::get('/groups/exportPDF', [CitationsController::class, 'exportPDF'])
        ->name('groups.exportPDF')->defaults('filter', 'groups');
    Route::get('/groups/exportWord', [CitationsController::class, 'exportWord'])
        ->name('groups.exportWord')->defaults('filter', 'groups');

    // Admin Logout
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

// ---------------------------
// Department Form Routes
// ---------------------------
Route::get('/department-form', [DepartmentFormController::class, 'create'])->name('department-form.create');
Route::post('/department-form', [DepartmentFormController::class, 'store'])->name('department-form.store');
Route::get('/department-forms', [DepartmentFormController::class, 'index'])->name('departmentForms.index');

// ---------------------------
// Group Form Routes
// ---------------------------
Route::get('/group-form', [GroupFormController::class, 'create'])->name('group-form.create');
Route::post('/group-form', [GroupFormController::class, 'store'])->name('group-form.store');

// ---------------------------
// Default Routes for Views
// ---------------------------
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dept-form', function () {
    return view('department-form');
});

Route::get('/depts', function () {
    return view('departments');
});

Route::get('/grps', function () {
    return view('groups');
});
