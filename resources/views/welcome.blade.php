<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<style>
    body{
        
        min-height: 100vh; 
        margin: 0;
        background-image:
        linear-gradient(to right, #ffffff 0%, #ffffffa9 35%, rgba(255, 255, 255, 0) 70%),
        url("{{ asset('images/background.jpg') }}");
        
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    }
    h1{
        font-family: Verdana;
        font-size: 80px;
        padding: 0px 80px;
        color: #07182f;
    }
    p{
      font-family: Arial;
      
      font-size: 16px;
      padding: 0px 85px;
      color: #0e0d47; 
      margin: 0px; 
    }
</style>
<body>
    @include('partials.header')
    <h1>Seamless User<br>Management</h1>
    <p>A tool that helps you handle user management smoothly,
    giving you full control over your everyday accounts.</p>
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
