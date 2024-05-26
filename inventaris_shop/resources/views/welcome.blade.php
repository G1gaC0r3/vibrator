<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/welcome.css')}}">
    </head>
    <body>
        <div class="banner"></div>
        <div class="welcome-container">
            <h1>Welcome to Our Website!</h1>
            @if (Route::has('login'))
                <div>
                    @auth
                        <a href="{{ url('dashboard') }}" class="btn">Dashboard</a>
                                       @else
                        <a href="{{ route('login') }}" class="btn">Log in</a>
                                               @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </body>
</html>
