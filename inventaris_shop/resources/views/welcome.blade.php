<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Add some basic styles for the page -->
        <style>
            body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('{{ asset('images/banner-bg.png') }}') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            }

            .welcome-container {
            text-align: center;
            animation: fadeIn 2s;
            color: #fff;
            }

            .welcome-container h1 {
                font-size: 48px;
                margin-bottom: 20px;
            }

            .welcome-container .text-box {
                margin-top: 20px;
            }

            .welcome-container .text-box input {
                padding: 10px;
                font-size: 16px;
                border-radius: 5px;
                border: 1px solid #ccc;
            }

            .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            color: #fff;
            text-decoration: none;
            border-radius: 50px;
            transition: background 0.3s, transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            }

            .btn:hover {
            background: linear-gradient(45deg, #ff4b2b, #ff416c);
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }
        </style>
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
