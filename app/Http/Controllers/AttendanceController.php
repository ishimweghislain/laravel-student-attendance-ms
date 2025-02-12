<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

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
        return redirect()->route('attendance.index')->with('success', 'Attendance recorded successfully.');
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

        return redirect()->route('attendance.index')->with('success', 'Attendance updated successfully.');
    }

    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return redirect()->route('attendance.index')->with('success', 'Attendance deleted successfully.');
    }

    public function dailyReport(Request $request)
    {
        $date = $request->input('date', now()->toDateString());
        $attendances = Attendance::with(['student', 'course'])
            ->whereDate('attendance_date', $date)
            ->get();

        return view('attendance.daily-report', compact('attendances', 'date'));
    }
}
