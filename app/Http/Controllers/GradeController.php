<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['student', 'course'])
            ->latest()
            ->paginate(10);

        return view('grades.index', compact('grades'));
    }

    public function create()
    {
        $students = Student::all();
        $courses = Course::all();

        return view('grades.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'studentid' => 'required|exists:students,studentid',
            'courseid' => 'required|exists:courses,id',
            'exam_date' => 'required|date',
            'grade' => 'required|numeric|min:0|max:100'
        ]);

        Grade::create($validated);

        return redirect()->route('grades.index')->with('success', 'Grade added successfully.');
    }

    public function edit($id)
    {
        $grade = Grade::findOrFail($id);
        $students = Student::all();
        $courses = Course::all();

        return view('grades.edit', compact('grade', 'students', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'studentid' => 'required|exists:students,studentid',
            'courseid' => 'required|exists:courses,id',
            'exam_date' => 'required|date',
            'grade' => 'required|numeric|min:0|max:100'
        ]);

        $grade = Grade::findOrFail($id);
        $grade->update($validated);

        return redirect()->route('grades.index')->with('success', 'Grade updated successfully.');
    }

    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);
        $grade->delete();

        return redirect()->route('grades.index')->with('success', 'Grade deleted successfully.');
    }
}
