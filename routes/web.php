<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\DashboardController;


Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
   
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    
    Route::resource('students', StudentController::class);


    Route::resource('courses', CourseController::class);

    
    Route::resource('attendance', AttendanceController::class);
    Route::get('/attendance-report/daily', [AttendanceController::class, 'dailyReport'])
        ->name('attendance.daily-report');

    
    Route::resource('grades', GradeController::class);
});