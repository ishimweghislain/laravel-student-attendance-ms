@extends('layouts.app')

@section('title', 'Add Student')

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
            <h2>Add New Student</h2>
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

        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">First Name</label>
                <input type="text" name="fname" class="form-input" value="{{ old('fname') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Last Name</label>
                <input type="text" name="lname" class="form-input" value="{{ old('lname') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-input" required>
                    <option value="">Select Gender</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dateofb" class="form-input" value="{{ old('dateofb') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Contact Number</label>
                <input type="text" name="contactnumber" class="form-input" value="{{ old('contactnumber') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-input" rows="3" required>{{ old('address') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Enrollment Date</label>
                <input type="date" name="enrollmentdate" class="form-input" value="{{ old('enrollmentdate') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Class</label>
                <input type="text" name="class" class="form-input" value="{{ old('class') }}" required>
            </div>

            <div class="button-group">
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Add Student</button>
            </div>
        </form>
    </div>
</div>
@endsection