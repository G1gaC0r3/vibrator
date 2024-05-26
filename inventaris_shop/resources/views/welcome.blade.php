<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/welcome.css')}}">
    </head>
    <body>
        <div class="banner">
        <div class="content">
            <h1>Welcome to Ineventory</h1>
            <p>Inventory Management System</p>
            @if (Route::has('login'))
                <div>
                    @auth
                        <a href="{{ url('dashboard') }}" class="btn"><span class="span"></span>Dashboard</a>
                                       @else
                        <a href="{{ route('login') }}" class="btn"><span class="span"></span>Log in</a>
                                               @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn"><span class="span"></span>Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
    </body>
</html>
