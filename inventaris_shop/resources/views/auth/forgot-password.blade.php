<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link href="{{ asset('css/forgot-password.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="forgot-password-box">
            <h2 class="title">Lupa Password</h2>
            <p class="subtitle">Lupa password Anda? Tidak masalah. Cukup beri tahu kami alamat email Anda, dan kami akan mengirimkan tautan reset password ke email Anda yang memungkinkan Anda memilih yang baru.</p>

            <!-- Session Status -->
            <div class="session-status">
                @if (session('status'))
                    <div class="mb-4 text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
            </div>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input id="email" type="email" class="input-field" name="email" :value="old('email')" required autofocus>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="reset-btn">Kirim Tautan Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
