<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Saint Kizito TSS</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .school-name {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 2rem;
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #2c3e50;
        }

        input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        input:focus {
            outline: none;
            border-color: #3498db;
        }

        .btn-register {
            width: 100%;
            padding: 0.75rem;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-register:hover {
            background: #2980b9;
        }

        .error {
            color: #e74c3c;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .alert-error {
            background-color: #ffebee;
            color: #e74c3c;
            padding: 0.75rem;
            border-radius: 5px;
            margin-bottom: 1.5rem;
            border-left: 4px solid #e74c3c;
        }

        .login-link {
            text-align: center;
            margin-top: 1rem;
            color: #3498db;
            text-decoration: none;
        }

        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1 class="school-name">Saint Kizito TSS</h1>
        
        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif
        
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('register.submit') }}">
            @csrf
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required>
                @error('username')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
                @error('password_confirmation')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn-register" style="margin-top:20px">Register</button>
            <a href="{{ route('login') }}" class="login-link">Already have an account? Login here</a>
        </form>
    </div>
</body>
</html>