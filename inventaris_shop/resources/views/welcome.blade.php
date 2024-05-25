<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .centered {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .btn {
                padding: 10px 20px;
                margin: 0 10px;
                background-color: #007BFF;
                color: white;
                text-decoration: none;
                border-radius: 5px;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="centered bg-gray-100 dark:bg-gray-900">
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
