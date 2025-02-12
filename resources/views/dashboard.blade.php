@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<style>
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        margin-top: 1rem;
        color: #2c3e50;
    }
    .activities-card {
        background: white;
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .activities-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }
    .activities-table th,
    .activities-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }
    .activities-table th {
        background-color: #f8f9fa;
    }
</style>

<div class="dashboard-grid">
    <div class="stat-card">
        <h3>Total Students</h3>
        <p class="stat-number">{{ App\Models\Student::count() }}</p>
    </div>

    <div class="stat-card">
        <h3>Total Courses</h3>
        <p class="stat-number">{{ App\Models\Course::count() }}</p>
    </div>

    <div class="stat-card">
        <h3>Today's Attendance</h3>
        <p class="stat-number">
            {{ App\Models\Attendance::whereDate('created_at', now()->toDateString())->count() }}
        </p>
    </div>
</div>

<div class="activities-card">
    <h2>Recent Activities</h2>
    <table class="activities-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Student</th>
                <th>Course</th>
                <th>Type</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach(App\Models\Attendance::with(['student', 'course'])->latest()->take(5)->get() as $attendance)
            <tr>
                <td>{{ $attendance->created_at->format('Y-m-d') }}</td>
                <td>{{ $attendance->student->fname }} {{ $attendance->student->lname }}</td>
                <td>{{ $attendance->course->name }}</td>
                <td>Attendance</td>
                <td>{{ $attendance->attendance_status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection