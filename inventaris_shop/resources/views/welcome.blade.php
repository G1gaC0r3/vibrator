<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
    </head>
    <body class="antialiased">
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

        <!-- Optionally add some JavaScript for additional animations or interactivity -->
        <script>
            // Example of adding a simple animation on page load
            document.addEventListener('DOMContentLoaded', function() {
                const buttons = document.querySelectorAll('.btn');
                buttons.forEach((button, index) => {
                    button.style.animation = `fadeIn 0.5s ${index * 0.3}s forwards`;
                });
            });
        </script>
    </body>
</html>
