<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'dateofb' => 'required|date',
            'contactnumber' => 'required|string|max:20',
            'email' => 'required|email|unique:students',
            'address' => 'required|string',
            'enrollmentdate' => 'required|date'
        ]);

        Student::create($validated);
        return redirect()->route('students.index')->with('success', 'Student added successfully');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'dateofb' => 'required|date',
            'contactnumber' => 'required|string|max:20',
            'email' => 'required|email|unique:students,email,'.$student->studentid.',studentid',
            'address' => 'required|string',
            'enrollmentdate' => 'required|date'
        ]);

        $student->update($validated);
        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }
}


