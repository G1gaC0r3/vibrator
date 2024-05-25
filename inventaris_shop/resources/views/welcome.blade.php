<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <style>
            body, html {
                height: 100%;
                margin: 0;
                font-family: 'Roboto', sans-serif;
            }
            .bg {
                background-image: url('https://source.unsplash.com/1600x900/?nature,water');
                height: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
            .centered {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
            }
            .btn {
                padding: 12px 24px;
                margin: 10px;
                background-color: #007BFF;
                color: white;
                text-decoration: none;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                transition: background-color 0.3s;
            }
            .btn:hover {
                background-color: #0056b3;
            }
            .title {
                color: white;
                font-size: 48px;
                font-weight: 700;
            }
            .subtitle {
                color: white;
                font-size: 24px;
                margin-top: 10px;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="bg">
            <div class="centered">
                <h1 class="title">Selamat Datang di Website Kami</h1>
                <p class="subtitle">Platform terbaik untuk kebutuhan Anda</p>
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
        </div>
    </body>
</html>
