<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Website Inventaris</title>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isDarkMode = localStorage.getItem('theme') === 'dark';
            if (isDarkMode) {
                document.body.classList.add('dark-mode');
            }
        });
    </script>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
            <div class="logo">Inv<span class="logo1">entaris</span></div>
        <ul class="side-menu">
             <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class='bx bxs-dashboard'></i>Stok Barang</a>
                </li>
                <li class="{{ request()->routeIs('masuk') ? 'active' : '' }}">
                    <a href="{{ route('masuk') }}"><i class='bx bx-arrow-to-left'></i>Input Barang</a>
                </li>
                <li class="{{ request()->routeIs('keluar') ? 'active' : '' }}">
                    <a href="{{ route('keluar') }}"><i class='bx bx-arrow-to-right'></i>Edit Barang</a>
                </li>
                <li class="{{ request()->routeIs('users') ? 'active' : '' }}">
                    <a href="{{ route('users') }}"><i class='bx bx-group'></i>Users</a>
                </li>
        </ul>        
        <ul class="side-menu">
            <li>
                <div class="logout-container">
                    <form id="logout-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-link">
                            <i class='bx bx-log-out-circle'></i>
                            <span class="logout-text">Logout</span>
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="profile">
                <img src="{{ asset('images/profile.png') }}" alt="">
            </a>
        </nav>

        <!-- End of Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Stok Barang</h1>    
                </div>
            </div>

            <!-- Insights -->
            <ul class="insights">
                <li>
                    <i class='bx bx-arrow-to-right' style="color: rgb(24, 141, 180);"></i>
                    <span class="info">
                        <h3>
                            {{ $totalJumlah }}
                        </h3>
                        <p>Total Barang Masuk</p>
                    </span>
                </li>
                <li><i class='bx bx-arrow-to-left' style="color: rgb(207, 164, 10);"></i>
                    <span class="info">
                        <h3>
                            20
                        </h3>
                        <p>Total Barang Keluar</p>
                    </span>
                </li>
            </ul>
            <!-- resources/views/barang/edit.blade.php -->

<form action="" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <input type="text" name="nama_barang" placeholder="Nama Barang" value="{{ $barang->nama_barang }}" class="form-control" required>
        <br>
        <select name="jenis_barang" class="form-control" required>
            <option value="Pack" {{ $barang->jenis_barang == 'Pack' ? 'selected' : '' }}>Pack</option>
            <option value="Botol" {{ $barang->jenis_barang == 'Botol' ? 'selected' : '' }}>Botol</option>
            <option value="Kaleng" {{ $barang->jenis_barang == 'Kaleng' ? 'selected' : '' }}>Kaleng</option>
            <option value="Saset" {{ $barang->jenis_barang == 'Saset' ? 'selected' : '' }}>Saset</option>
        </select>
        <br>
        <input type="number" name="jumlah_barang" placeholder="Jumlah Barang" value="{{ $barang->jumlah_barang }}" class="form-control" required>
        <br>
        <!-- Add more fields as needed -->
        <button type="submit" class="btn btn-primary">Update Barang</button>
    </div>
</form>

    
    <script src="{{ asset('js/index.js') }}"></script>
</body>

</html>
