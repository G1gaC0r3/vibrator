<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .custom-modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .custom-modal-dialog {
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            background-color: white;
        }

        .custom-modal-header, .custom-modal-footer {
            padding: 10px;
            border-bottom: 1px solid #e5e5e5;
        }

        .custom-modal-footer {
            border-top: none;
        }

        .custom-modal-title {
            margin: 0;
        }

        .btn-close-custom {
            cursor: pointer;
            background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
        }

        .btn-primary-custom {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
    </style>
    <title>Website Inventaris</title>
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
                <img src="{{ asset($profilePicture) }}" alt="" id="navbar-profile-picture">
            </a>
        </nav>
        <!-- End of Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Barang Keluar</h1>
                </div>
            </div>

            <!-- Insights -->
            <ul class="insights">
                <li>
                    <i class='bx bx-arrow-to-right' style="color: rgb(24, 141, 180);"></i>
                    <span class="info">
                        <h3>{{ $totalJumlah }}</h3>
                        <p>Total Barang Masuk</p>
                    </span>
                </li>
                <li>
                    <i class='bx bx-arrow-to-left' style="color: rgb(207, 164, 10);"></i>
                    <span class="info">
                        <h3>20</h3>
                        <p>Total Barang Keluar</p>
                    </span>
                </li>
            </ul>
            <!-- End of Insights -->

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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barangs as $barang)
                            <tr>
                                <td>{{ $barang->id_barang }}</td>
                                <td>{{ $barang->nama_barang }}</td>
                                <td>{{ $barang->jenis_barang }}</td>
                                <td>{{ $barang->jumlah_barang }}</td>
                                <td>
                                    <form method="POST" action="keluar/{{ $barang->id_barang }}">
                                        <button type="button" class="openCustomModalButton"><i class="fa-solid fa-pencil" color="red" value='Update'></i></button>
                                    </form>
                                    <form method="POST" action="keluar/{{ $barang->id_barang }}">
                                        @csrf
                                        @method('DELETE')
                                        <button><a><i class="fa-solid fa-eraser" color="red" value='Delete'></i></a></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Custom Modal -->
    <div class="custom-modal" id="customModal">
        <div class="custom-modal-dialog">
            <div class="custom-modal-content">
                <div class="custom-modal-header">
                    <h4 class="custom-modal-title">Tambahkan Barang</h4>
                </div>
                <form action="keluar/{{ $barang->id_barang }}" method="PUT" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" name="nama_barang" placeholder="Nama Barang" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="jenis_barang">Jenis Barang</label>
                        <input type="text" name="jenis_barang" id="jenis_barang" class="form-control" placeholder="Jenis Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_barang">Jumlah Barang</label>
                        <input type="number" name="jumlah_barang" placeholder="Jumlah Barang" class="form-control" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary-custom">Edit</button>
                </form>
                <div class="custom-modal-footer">
                    <button type="button" class="btn-close-custom" id="closeCustomModalButton">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to handle custom modal display
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById("customModal");
            var openModalButtons = document.querySelectorAll(".openCustomModalButton");
            var closeModalButton = document.getElementById("closeCustomModalButton");

            openModalButtons.forEach(function(button) {
                button.onclick = function() {
                    modal.style.display = "block";
                }
            });

            closeModalButton.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{asset('js/index.js')}}"></script>
    <script src="{{ asset('js/barchart.js') }}"></script>
    <script src="{{asset('js/searchDsc.js')}}"></script>
</body>

</html>
