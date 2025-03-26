<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
            'dateofb' => 'required|date|before_or_equal:'.Carbon::now()->subYears(12)->format('Y-m-d'),
            'contactnumber' => 'required|numeric|digits_between:10,15',
            'email' => 'required|email|unique:students',
            'address' => 'required|string',
            'enrollmentdate' => 'required|date|before_or_equal:today',
            'class' => 'required|string|max:100' 
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
            'dateofb' => 'required|date|before_or_equal:'.Carbon::now()->subYears(12)->format('Y-m-d'),
            'contactnumber' => 'required|numeric|digits_between:10,15',
            'email' => 'required|email|unique:students,email,'.$student->studentid.',studentid',
            'address' => 'required|string',
            'enrollmentdate' => 'required|date|before_or_equal:today',
            'class' => 'required|string|max:100' // New class field validation
        ]);
        
        $student->update($validated);
        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }
    
    public function destroy(Student $student)
    {
        try {
            DB::table('grades')->where('studentid', $student->studentid)->delete();
            DB::table('attendance')->where('studentid', $student->studentid)->delete();
            $student->delete();
            return redirect()->route('students.index')->with('success', 'Student deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('students.index')->with('error', 'Failed to delete student: ' . $e->getMessage());
        }
    }
}