@extends('layouts.app')

@section('title', 'Edit Attendance')

@section('content')
<style>
    .container {
        width: 80%;
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
    }
    .form-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .card-header {
        border-bottom: 1px solid #ddd;
        margin-bottom: 20px;
        padding-bottom: 10px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .form-input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-bottom: 10px;
    }
    .btn {
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        color: white;
    }
    .btn-primary {
        background-color: #007bff;
    }
    .btn-secondary {
        background-color: #6c757d;
    }
    .button-group {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
    .error-message {
        background-color: #f8d7da;
        color: #721c24;
        padding: 12px;
        margin-bottom: 20px;
        border-radius: 4px;
    }
</style>

<div class="container">
    <div class="form-card">
        <div class="card-header">
            <h2>Edit Attendance</h2>
        </div>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">Student</label>
                <select name="studentid" class="form-input" required>
                    @foreach($students as $student)
                        <option value="{{ $student->studentid }}" 
                                {{ old('studentid', $attendance->studentid) == $student->studentid ? 'selected' : '' }}>
                            {{ $student->fname }} {{ $student->lname }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Course</label>
                <select name="courseid" class="form-input" required>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" 
                                {{ old('courseid', $attendance->courseid) == $course->id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Date</label>
                <input type="date" name="attendance_date" class="form-input" 
                       value="{{ old('attendance_date', $attendance->attendance_date) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="attendance_status" class="form-input" required>
                    <option value="Present" {{ old('attendance_status', $attendance->attendance_status) == 'Present' ? 'selected' : '' }}>Present</option>
                    <option value="Absent" {{ old('attendance_status', $attendance->attendance_status) == 'Absent' ? 'selected' : '' }}>Absent</option>
                    <option value="Late" {{ old('attendance_status', $attendance->attendance_status) == 'Late' ? 'selected' : '' }}>Late</option>
                </select>
            </div>

            <div class="button-group">
                <a href="{{ route('attendance.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Attendance</button>
            </div>
        </form>
    </div>
</div>
@endsection
