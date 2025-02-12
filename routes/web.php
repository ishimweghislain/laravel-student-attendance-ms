<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\DashboardController;

// Authentication Routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Students Routes
    Route::resource('students', StudentController::class);

    // Courses Routes
    Route::resource('courses', CourseController::class);

    // Attendance Routes
    Route::resource('attendance', AttendanceController::class);
    Route::get('/attendance-report/daily', [AttendanceController::class, 'dailyReport'])
        ->name('attendance.daily-report');

    // Grades Routes
    Route::resource('grades', GradeController::class);
});
