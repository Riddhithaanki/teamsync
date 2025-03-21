<?php

use App\Http\Controllers\HRController;
use App\Http\Controllers\TechLeadController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendencesController;
use App\Http\Controllers\TaskManagmentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ScreenshotController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\model\Task;
use Illuminate\Mail\SentMessage;

// Landing Page
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Protected Routes (Requires Authentication)
//Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Role-Based Routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    });

    Route::middleware(['role:hr'])->group(function () {
        Route::get('/hr', [HRController::class, 'dashboard'])->name('hr.dashboard');
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
    //Route::post('employes/edit', [EmployeeController::class,'edit'])->name('employees.edit');


    // Task Managment
    Route::post('task/save', [TaskManagmentController::class, 'save'])->name('taskmanagment.save');
    Route::post('task/update', [TaskManagmentController::class, 'update'])->name('taskmanagment.updateData');
    Route::get('task/create', [TaskManagmentController::class, 'create'])->name('taskmanagment.create');
    Route::get('task/edit/{id}', [TaskManagmentController::class, 'edit'])->name('taskmanagment.edit');
    Route::get('task',[TaskManagmentController::class, 'index'])->name('taskmanagment.index');
    Route::get('task/delete',[TaskManagmentController::class,'destroy'])->name('taskmanagment.delete');
    Route::get('task/view/{id}', [TaskManagmentController::class,'view'])->name('taskmanagment.view');
    Route::get('task/assignuser/{id}', [TaskManagmentController::class,'assignuser'])->name('taskmanagment.assignuser');
    Route::post('task/assignuser', [TaskManagmentController::class,'assignuserview'])->name('taskmanagment.assignuserview');
    
    Route::get('task/createtask/{id}', [TaskManagmentController::class,'createtask'])->name('taskmanagment.createtask');
    Route::post('task/savetask', [TaskManagmentController::class,'savetask'])->name('taskmanagment.savetask');
    Route::get('task/showtask/{id}', [TaskManagmentController::class,'showtask'])->name('taskmanagment.showtask');
    
    Route::post('task/viewtask', [TaskManagmentController::class,'viewtask'])->name('taskmanagment.viewtask');
    Route::get('task/edittask{id}', [TaskManagmentController::class,'edittask'])->name('taskmanagment.edittask');
    Route::post('task/edittask', [TaskManagmentController::class,'updateTask'])->name('taskmanagment.updateTask');
    Route::post('task/deletetask', [TaskManagmentController::class,'deletetask'])->name('taskmanagment.deletetask');

    //attendence managment
    Route::get('attendences',[AttendencesController::class,'index'])->name('attendences.index');
    Route::post('attendences/save',[AttendencesController::class,'save'])->name('attendences.save');
    Route::get('attendences/create',[AttendencesController::class,'create'])->name('attendences.create');
    Route::get('attendences/edit/{id}',[AttendencesController::class,'edit'])->name('attendences.edit');
    Route::post('attendence/update',[AttendencesController::class,'update'])->name('attendences.update');
    Route::get('attendences/delete/{id}',[AttendencesController::class,'delete'])->name('attendences.delete');

    //chat managment
    Route::get('/chat',[ChatController::class,'index'])->name('chat.index');
    Route::get('chats',[ChatController::class,'chats'])->name('chats');
    Route::get('showchat/{id}',[ChatController::class,'showchat'])->name('showchat.index');
    Route::post('send/{id}',[ChatController::class,'send'])->name('chat.send');
    
   // group chat managment
    Route::middleware(['auth'])->group(function () {
    Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create');
    Route::post('/groups', [GroupController::class, 'store'])->name('groups.store');
    Route::get('groupschat/{id}',[GroupController::class,'groupschat'])->name('groups.groupchat');
    Route::post('sendgroupchat/{id}',[GroupController::class,'send'])->name('groups.sendchats');
    Route::delete('deletegroups/{id}',[GroupController::class,'delete'])->name('groups.delete');

    //screenshot 
    Route::get('/process', [ScreenshotController::class, 'store'])->name('process.store');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
