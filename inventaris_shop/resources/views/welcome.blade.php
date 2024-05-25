<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
        <style>
            body, html {
                height: 100%;
                margin: 0;
                font-family: 'Orbitron', sans-serif;
                background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);
            }
            .bg {
                background-image: url('https://source.unsplash.com/1600x900/?futuristic,technology');
                height: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                filter: brightness(80%);
            }
            .centered {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
                color: #ffffff;
            }
            .btn {
                padding: 12px 24px;
                margin: 10px;
                background-color: #1e90ff;
                color: white;
                text-decoration: none;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                transition: background-color 0.3s, transform 0.3s;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            }
            .btn:hover {
                background-color: #4682b4;
                transform: scale(1.05);
            }
            .title {
                font-size: 60px;
                font-weight: 700;
                text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            }
            .subtitle {
                font-size: 24px;
                margin-top: 10px;
                opacity: 0.9;
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
