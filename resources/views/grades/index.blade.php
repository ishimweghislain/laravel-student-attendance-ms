@extends('layouts.app')

@section('title', 'Grades')

@section('content')
<style>
    .container {
        width: 90%;
        margin: 20px auto;
        padding: 20px;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .btn {
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        color: white;
    }
    .btn-add {
        background-color: #28a745;
    }
    .btn-edit {
        background-color: #007bff;
    }
    .btn-delete {
        background-color: #dc3545;
    }
    .table-container {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f8f9fa;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    .success-message {
        background-color: #d4edda;
        color: #155724;
        padding: 12px;
        margin-bottom: 20px;
        border-radius: 4px;
    }
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
</style>

<div class="container">
    <div class="header">
        <h1>Grade Records</h1>
        <a href="{{ route('grades.create') }}" class="btn btn-add">Add New Grade</a>
    </div>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Course</th>
                    <th>Exam Date</th>
                    <th>Grade</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grades as $grade)
                <tr>
                    <td>{{ $grade->student->fname }} {{ $grade->student->lname }}</td>
                    <td>{{ $grade->course->name }}</td>
                    <td>{{ $grade->exam_date }}</td>
                    <td>{{ $grade->grade }}%</td>
                    <td class="action-buttons">
                        <a href="{{ route('grades.edit', $grade->gradeid) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('grades.destroy', $grade->gradeid) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this grade?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $grades->links() }}
        </div>
    </div>
</div>
@endsection