<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <h1>Barang Masuk</h1>
                    
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
                    <button type="button" class="btn btn-primary1" data-bs-toggle="modal" data-bs-target="#myModal" id="openModalButton">
                      </button>
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
                                        <a href="#" onclick="toggleForm({{ $barang->id }})">
                                            <i class="fa-solid fa-pencil" style="color: blue"></i>
                                        </a>
                                        <form id="editForm{{ $barang->id }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="id_barang">ID Barang:</label>
                                                <input type="text" id="id_barang" name="id_barang" value="{{ $barang->id_barang }}" class="form-control" readonly>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label for="nama_barang">Nama Barang:</label>
                                                <input type="text" id="nama_barang" name="nama_barang" value="{{ $barang->nama_barang }}" class="form-control">
                                            </div>
                                        
                                            <div class="form-group">
                                                <label for="jenis_barang">Jenis Barang:</label>
                                                <select id="jenis_barang" name="jenis_barang" class="form-control">
                                                    <option value="Pack" @if($barang->jenis_barang == 'Pack') selected @endif>Pack</option>
                                                    <option value="Botol" @if($barang->jenis_barang == 'Botol') selected @endif>Botol</option>
                                                    <option value="Kaleng" @if($barang->jenis_barang == 'Kaleng') selected @endif>Kaleng</option>
                                                    <option value="Pcs" @if($barang->jenis_barang == 'Pcs') selected @endif>Pcs</option>
                                                    <option value="Box" @if($barang->jenis_barang == 'Box') selected @endif>Box</option>
                                                    <option value="Unit" @if($barang->jenis_barang == 'Unit') selected @endif>Unit</option>
                                                </select>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label for="jumlah_barang">Jumlah Barang:</label>
                                                <input type="number" id="jumlah_barang" name="jumlah_barang" value="{{ $barang->jumlah_barang }}" class="form-control">
                                            </div>
                                        
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <a href="#" <i class="fa-solid fa-eraser" style="color: red"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </main>

    </div>
    <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Tambahkan Barang</h4>
              <!-- <button type="button" class="btn-close" id="closeModalButton">&times;</button> -->
            </div>
    
            <!-- Modal body -->
            <form action="{{ route('masuk') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" name="nama_barang" placeholder="Nama Barang" class="form-control" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="jenis_barang">Jenis Barang</label>
                    <select name="jenis_barang" class="form-control" required>
                        <option value="" disabled selected>Pilih Jenis Barang</option>
                        <option value="Pack">Pack</option>
                        <option value="Botol">Botol</option>
                        <option value="Kaleng">Kaleng</option>
                        <option value="Saset">Saset</option>
                    </select>
                </div>
              
                <div class="form-group">
                    <label for="jumlah_barang">Jumlah Barang</label>
                    <input type="number" name="jumlah_barang" placeholder="Jumlah Barang" class="form-control" required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
            
    
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-close" id="closeModalButton">Close</button>
            </div>
    
          </div>
        </div>
      </div>
    
      <script src="{{asset('js/index.js')}}"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script src="{{ asset('js/barchart.js') }}"></script>
      <script src="{{asset('js/searchDsc.js')}}"></script>
</body>

</html>