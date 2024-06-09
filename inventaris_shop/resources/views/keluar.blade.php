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
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(10px);
}

.custom-modal-dialog {
    position: relative;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    width: 90%;
    max-width: 600px;
    background-color: #fff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.custom-modal-content {
    padding: 20px;
}

.custom-modal-header {
    padding: 10px 20px;
    border-bottom: 2px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.custom-modal-title {
    margin: 0;
    font-size: 24px;
    color: #333;
}

.btn-close-custom {
    cursor: pointer;
    background-color: #f44336;
    color: white;
    border: none;
    padding: 10px 16px;
    border-radius: 5px;
    font-size: 16px;
    margin-bottom: 10px;
}

.btn-primary-custom {
    background-color: #2196f3;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    display: block;
    width: 100%;
    margin-top: 20px;
    margin-bottom: 10px;
}

.form-group {
    margin-bottom: 7px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #666;
}

.form-group input[type="text"],
.form-group input[type="number"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

.button {
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    color: white;
    font-size: 14px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    transition: background-color 0.3s ease;
    margin-bottom: 10px;
}

.update-button {
    background-color: #4CAF50;
}

.update-button:hover {
    background-color: #45a049;
}

.delete-button {
    background-color: #f44336;
}

.delete-button:hover {
    background-color: #da190b;
}

.use-button {
    background-color: #2196F3;
}

.use-button:hover {
    background-color: #0b7dda;
}

#updateModal .form-group {
    margin-bottom: 5px;
}

#updateModal .form-group label {
    margin-bottom: 2px;
}

#updateModal .form-group input[type="text"],
#updateModal .form-group input[type="number"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
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
            <img src="{{ asset('images/LOGO POLNES.png') }}" alt="Profil" style="height: 30px; width: 30px; border-radius: 50%;">
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
                        <p>Total Jumlah Seluruh</p>
                    </span>
                </li>
                <li>
                    <i class='bx bx-arrow-to-left' style="color: rgb(207, 164, 10);"></i>
                    <span class="info">
                        <h3>{{ $totalBarang }}</h3>
                        <p>Total Barang</p>
                    </span>
                </li>
                <li>
                    <i class='bx bx-arrow-from-bottom' style="color: rgb(32, 164, 61);"></i>
                    <span class="info">
                        <h3>{{ $totalTerpakai }}</h3>
                        <p>Terpakai</p>
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
                                <th>Terpakai</th>
                                <th>Tersisa</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($barangs as $barang)
                            <tr>
                                <td>{{ $barang->kode_barang ?? 'ID tidak tersedia' }}</td>
                                <td>{{ $barang->nama_barang ?? 'Nama tidak tersedia' }}</td>
                                <td>{{ $barang->jenis_barang ?? 'Jenis tidak tersedia' }}</td>
                                <td>{{ $barang->jumlah_barang ?? 'Jumlah tidak tersedia' }}</td>
                                <td>{{ $barang->terpakai ?? 'Jumlah tidak tersedia' }}</td>
                                <td>{{ $barang->tersisa ?? 'Jumlah tidak tersedia' }}</td>
                                <td style="display: flex; flex-direction:column;">
                                    <form method="POST" action="keluar/{{ $barang->id_barang ?? '#' }}" style="display: inline;" class="form">
                                        <button type="button" class="button update-button openCustomModalButton" 
                                                data-id="{{ $barang->id_barang }}"
                                                data-nama="{{ $barang->nama_barang }}"
                                                data-jenis="{{ $barang->jenis_barang }}"
                                                data-jumlah="{{ $barang->jumlah_barang }}">
                                            <i class="fa-solid fa-pencil"></i> Update
                                        </button>
                                    </form>
                                    
                                    <form method="POST" action="keluar/{{ $barang->id_barang ?? '#' }}" style="display: inline;" class="form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button delete-button">
                                            <i class="fa-solid fa-eraser"></i> Delete
                                        </button>
                                    </form>
                                    <form method="POST" action="keluaredit/{{ $barang->id_barang ?? '#' }}" style="display: inline;" class="form">
                                        <button type="button" class="button use-button openUseItemModalButton" data-id="{{ $barang->id_barang ?? '' }}" data-quantity="{{ $barang->jumlah_barang ?? '' }}">
                                            <i class="fa-solid fa-hand"></i> Gunakan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">Tidak ada data barang.</td>
                            </tr>
                            @endforelse
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
                    <h4 class="custom-modal-title">Edit Barang</h4>
                    <button type="button" class="btn-close-custom" id="closeCustomModalButton">&times;</button>
                </div>
                <form id="editForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Tambahkan input tersembunyi untuk menyimpan ID unik -->
                    <input type="hidden" name="barang_id" id="edit_barang_id">
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" name="nama_barang" id="edit_nama_barang" placeholder="Nama Barang" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_barang">Jenis Barang</label>
                        <input type="text" name="jenis_barang" id="edit_jenis_barang" class="form-control" placeholder="Jenis Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_barang">Jumlah Barang</label>
                        <input type="number" name="jumlah_barang" id="edit_jumlah_barang" placeholder="Jumlah Barang" class="form-control" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary-custom">Edit</button>
                </form>
            </div>
        </div>
    </div>

    <div id="useItemModal" class="custom-modal">
        <div class="custom-modal-dialog">
            <div class="custom-modal-content">
                <div class="custom-modal-header">
                    <h4 class="custom-modal-title">Gunakan Barang</h4>
                    <button type="button" class="btn-close-custom" id="closeUseItemModalButton">&times;</button>
                </div>
                <form id="terpakaiForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="terpakai">Terpakai:</label>
                        <input id="use_terpakai" type="number" class="form-control @error('terpakai') is-invalid @enderror" name="terpakai" value="">
                        @error('terpakai')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary-custom">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    var customModal = document.getElementById("customModal");
    var useItemModal = document.getElementById("useItemModal");
    var openCustomModalButtons = document.querySelectorAll(".openCustomModalButton");
    var openUseItemModalButtons = document.querySelectorAll(".openUseItemModalButton");
    var closeCustomModalButton = document.getElementById("closeCustomModalButton");
    var closeUseItemModalButton = document.getElementById("closeUseItemModalButton");
    
    openCustomModalButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            var barangId = button.getAttribute("data-id");
            var namaBarang = button.getAttribute("data-nama");
            var jenisBarang = button.getAttribute("data-jenis");
            var jumlahBarang = button.getAttribute("data-jumlah");
            
            // Set the values in the form
            document.getElementById("edit_barang_id").value = barangId;
            document.getElementById("edit_nama_barang").value = namaBarang;
            document.getElementById("edit_jenis_barang").value = jenisBarang;
            document.getElementById("edit_jumlah_barang").value = jumlahBarang;
            
            // Set the form action
            document.getElementById("editForm").action = "keluar/" + barangId;
            
            // Show the modal
            customModal.style.display = "block";
            event.stopPropagation();
        });
    });

    openUseItemModalButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            var barangId = button.getAttribute("data-id");
            var terpakai = button.getAttribute("data-quantity");
            
            // Set the values in the form
            document.getElementById("use_terpakai").value = terpakai;
            
            // Set the form action
            document.getElementById("terpakaiForm").action = "keluaredit/" + barangId;
            
            // Show the modal
            useItemModal.style.display = "block";
            event.stopPropagation();
        });
    });

    closeCustomModalButton.addEventListener('click', function() {
        customModal.style.display = "none";
    });

    closeUseItemModalButton.addEventListener('click', function() {
        useItemModal.style.display = "none";
    });

    window.addEventListener('click', function(event) {
        if (event.target == customModal) {
            customModal.style.display = "none";
        }
        if (event.target == useItemModal) {
            useItemModal.style.display = "none";
        }
    });
});
</script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{asset('js/index.js')}}"></script>
    <script src="{{ asset('js/barchart.js') }}"></script>
    <script src="{{asset('js/searchDsc.js')}}"></script>
</body>

</html>
