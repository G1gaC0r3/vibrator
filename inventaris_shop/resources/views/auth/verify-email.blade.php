<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <link href="{{ asset('css/verification.css') }}" rel="stylesheet">
</head>
<body>
    <div class="verification-box">
        <div class="logo-container">
            <img src="{{ asset('images/LOGO POLNES.png') }}" alt="Logo" class="logo">
        </div>
        <h2>Verifikasi Email</h2>
        <p>Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan kepada Anda? Jika Anda tidak menerima email tersebut, kami dengan senang hati akan mengirimkan yang lain.</p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat registrasi.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="resend-btn">Kirim Ulang Email Verifikasi</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Keluar</button>
        </form>
    </div>
</body>
</html>
