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
        $recentGrades = Attendance::with(['student', 'course'])->latest()->take(5)->get();
        
        // Fetch the total counts for students, courses, and today's attendance
        $totalStudents = Student::count();
        $totalCourses = Course::count();
        $todayAttendance = Attendance::whereDate('attendance_date', today())->count();
    
        // Pass all the data to the view
        return view('dashboard', compact('recentGrades', 'totalStudents', 'totalCourses', 'todayAttendance'));
    }
    
}
