<!-- resources/views/admin/login.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }
        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h4 {
            margin-bottom: 20px;
            color: #333;
        }
        .login-form {
            display: flex;
            flex-direction: column;
        }
        .login-form input[type="text"],
        .login-form input[type="password"] {
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: calc(100% - 22px);
            margin-bottom: 15px;
        }
        .login-form input[type="text"]:focus,
        .login-form input[type="password"]:focus {
            box-shadow: 0 0 5px rgba(110, 142, 251, 0.2);
            border-color: #000000;
        }
        .error {
            color: #e80000 !important;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        .btn {
            padding: 10px 15px;
            background-color: #232323;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #545454;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h4>ADMIN LOGIN</h4>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="login-form" method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <div>
            <label for="email"></label>
            <input type="text" name="email" id="email" placeholder="Correo electrónico" value="{{ old('email') }}">
            @error('email')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="password"></label>
            <input type="password" name="password" id="password" placeholder="Contraseña">
            @error('password')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn">LOGIN</button>
    </form>
</div>
</body>
</html>
