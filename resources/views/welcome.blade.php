<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body style="font-family: sans-serif; text-align: center; margin-top: 100px; background-color: #f3f4f6;">
    @include('partials.header')
    <h1 style="color: #1f2937;">S&R User Management System Prelim!!!</h1>
    <p style="color: #4b5563;">A Tool to fix your user management need for everyday use case.</p>
    <div>
        @auth
            <a href="{{ route('dashboard') }}">Dashboard</a>
        @else
            <a href="{{ route('login') }}">Login</a></br>
            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth

    </div>
</body>

</html>
