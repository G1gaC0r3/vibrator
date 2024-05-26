<!DOCTYPE html>
<html>
<head>
    <title>Dashboard and Masuk</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Masuk</h1>
        @include('masuk', ['barangs' => $barangs])
        
        <h1>Dashboard</h1>
        @include('dashboard', ['barangs' => $barangs])
    </div>
</body>
</html>
