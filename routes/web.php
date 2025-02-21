<?php


use App\Http\Controllers\HRController;
use App\Http\Controllers\TechLeadController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\MeetingController;
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
     //Attendence file route
     Route::get('/dashboard1', function () {
        return view('tasks.dashboard');
    })->name('dashboard1');

    //Attendence file route
    Route::get('/attendence', function () {
        return view('tasks.attendence');
    })->name('attendence');
    Route::post('/attendance/mark', [AttendenceController::class, 'markAttendance'])->name('attendance.mark');

    //message file route
    Route::get('/message', function () {
        return view('tasks.message');
    })->name('message');

    //metting file route
    Route::get('/meeting', function () {
        return view('tasks.meeting');
    })->name('meeting');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
