<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use App\Models\Attendance;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch recent attendance records with related student and course data
        $recentAttendance = Attendance::with(['student', 'course'])->latest()->take(5)->get();
        
        
        $totalStudents = Student::count();
        $totalCourses = Course::count();
        $todayAttendance = Attendance::whereDate('attendance_date', today())->count();
    

        return view('dashboard', compact('recentAttendance', 'totalStudents', 'totalCourses', 'todayAttendance'));
    }
    
}
