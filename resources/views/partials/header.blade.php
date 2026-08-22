<header>
    <nav>
        <a href="/">Home</a>
        @auth
            <a href="{{ route('dashboard') }}">Dashboard</a>
        @else
            <a href="{{ route('login') }}">Login</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth
    </nav>
    <hr>
</header>
