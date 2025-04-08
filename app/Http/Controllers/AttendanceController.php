<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Course;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with(['student', 'course'])
            ->latest()
            ->paginate(10);
        return view('attendance.index', compact('attendances'));
    }

    public function create()
    {
        $students = Student::all();
        $courses = Course::all();
        return view('attendance.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'studentid' => 'required|exists:students,studentid',
            'courseid' => 'required|exists:courses,id',
            'attendance_date' => 'required|date',
            'attendance_status' => 'required|in:Present,Absent,Late'
        ]);

        Attendance::create($validated);
        return redirect()->route('attendance.index')
            ->with('success', 'Attendance recorded successfully.');
    }

    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $students = Student::all();
        $courses = Course::all();
        return view('attendance.edit', compact('attendance', 'students', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'studentid' => 'required|exists:students,studentid',
            'courseid' => 'required|exists:courses,id',
            'attendance_date' => 'required|date',
            'attendance_status' => 'required|in:Present,Absent,Late'
        ]);

        $attendance = Attendance::findOrFail($id);
        $attendance->update($validated);

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance updated successfully.');
    }

    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance deleted successfully.');
    }
}