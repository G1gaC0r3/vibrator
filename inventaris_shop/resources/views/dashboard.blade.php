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
            <form action="#"></form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            @foreach($users as $user)
            <li>
                <img src="{{ asset($user->profile_picture) }}" alt="" id="profile_picture">
            </li>
        @endforeach
        </nav>
        <!-- End of Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Stok Barang</h1>
                </div>
            </div>

            <!-- Bar Chart -->
            <div class="chart-container" style="position: relative; height:40vh; width:80vw">
                <canvas id="barangChart"></canvas>
                <!-- Elemen tersembunyi untuk menyimpan data -->
                <div id="barangLabels" style="display: none;">{!! json_encode($barangs->pluck('jenis_barang')) !!}</div>
                <div id="barangData" style="display: none;">{!! json_encode($barangs->pluck('jumlah_barang')) !!}</div>
            </div>
            <!-- End of Bar Chart -->

            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Daftar Barang</h3>
                        <div class="search-box">
                            <input type="text" id="search-input" placeholder="Cari...">
                            <i class='bx bx-search' id="search-icon"></i>
                        </div>
                        <div class="sortir">
                            <i class='bx bx-filter' id="sort-icon"></i>
                        </div>
                    </div>
                    <table class="table table-bordered" border="1" id="barang-table">
                        <thead>
                            <tr>
                                <th>ID Barang</th>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barangs as $barang)
                                <tr>
                                    <td>{{ $barang->id_barang }}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->jenis_barang }}</td>
                                    <td>{{ $barang->jumlah_barang }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Sertakan Chart.js dan file chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{asset('js/index.js')}}"></script>
    <script src="{{ asset('js/barchart.js') }}"></script>
    <script src="{{asset('js/searchDsc.js')}}"></script>
</body>

</html>
