<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentFormController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\CitationsController;
use App\Http\Controllers\AdminAuthController;


// Admin login routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

// Protected routes for admin
Route::middleware('auth:admin')->group(function () {
    // Citations dashboard
    Route::get('/citations', [CitationsController::class, 'index'])
        ->name('citations.index');

    // Admin logout
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
        ->name('admin.logout');
});



Route::get('/department-forms', [DepartmentFormController::class, 'index'])->name('departmentForms.index');

Route::middleware('auth:admin')->group(function () {
    Route::get('/citations', [CitationsController::class, 'index'])
        ->name('citations.index');
});

// Export routes use POST because they send filtered JSON data
Route::post('/citations/export/excel', [CitationsController::class, 'exportExcel'])->name('citations.exportExcel');
Route::get('/citations/export/word', [CitationsController::class, 'exportWord'])->name('citations.exportWord');
Route::post('/citations/export/csv', [CitationsController::class, 'exportCSV'])->name('citations.exportCSV');
Route::post('/citations/export/pdf', [CitationsController::class, 'exportPDF'])->name('citations.exportPDF');
Route::get('/department-form/create', [DepartmentFormController::class, 'create'])->name('departmentForm.create');
Route::post('/department-form/store', [DepartmentFormController::class, 'store'])->name('departmentForm.store');
Route::get('/citations/export', [CitationsController::class, 'export'])->name('citations.export');


// DEPARTMENTS
Route::get('/department-form', [DepartmentFormController::class, 'create'])->name('department-form.create');
Route::post('/department-form', [DepartmentFormController::class, 'store'])->name('department-form.store');
Route::post('/groups', [GroupsController::class, 'store'])->name('groups.store');


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dept-form', function () {
    return view('department-form');
});
Route::get('/depts', function () {
    return view('departments');
});
Route::get('/group-form', function () {
    return view('group-form');
});
Route::get('/grps', function () {
    return view('groups');
});

