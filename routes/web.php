<?php


use App\Http\Controllers\HRController;
use App\Http\Controllers\TechLeadController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\TaskManagmentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Landing Page
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Protected Routes (Requires Authentication)
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Role-Based Routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    });

    Route::middleware(['role:hr'])->group(function () {
        Route::get('/hr', [HRController::class, 'index'])->name('hr.dashboard');
    });

    Route::middleware(['role:tech_lead'])->group(function () {
        Route::get('/tech-lead', [TechLeadController::class, 'index'])->name('techlead.dashboard');
    });

    Route::middleware(['role:developer'])->group(function () {
        Route::get('/developer', [DeveloperController::class, 'index'])->name('developer.dashboard');
    });


    // Employee Resource Routes
    Route::resource('/employees', EmployeeController::class);
    Route::post('employess/save', [EmployeeController::class, 'save'])->name('employees.save');
    Route::post('employess/update', [EmployeeController::class, 'update'])->name('employees.updateData');
    
  
    // Task Managment 
    Route::post('task/save', [TaskManagmentController::class, 'save'])->name('taskmanagment.save');
    Route::post('task/update', [TaskManagmentController::class, 'update'])->name('taskmanagment.updateData');
    Route::get('task/create', [TaskManagmentController::class, 'create'])->name('taskmanagment.create');
    Route::post('task/edit', [TaskManagmentController::class, 'edit'])->name('taskmanagment.edit');
    Route::get('task',[TaskManagmentController::class, 'index'])->name('taskmanagment.index');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
