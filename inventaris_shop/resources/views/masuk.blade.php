<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Website Inventaris</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
            <div class="logo"><span>Inventaris</span></div>
        <ul class="side-menu">
            <li><a href="stok.blade.php"><i class='bx bxs-dashboard'></i>Stok Barang</a></li>
            <li><a href="masuk.blade.php"><i class='bx bx-arrow-to-left'></i>Barang Masuk</a></li>
            <li ><a href="#"><i class='bx bx-arrow-to-right'></i>Barang Keluar</a></li>
            <li><a href="#"><i class='bx bx-group'></i>Users</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
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
                <img src="profiel.png" alt="">
            </a>
        </nav>

        <!-- End of Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Barang Masuk</h1>
                    <!-- <ul class="breadcrumb">
                        <li><a href="#">
                                Analytics
                            </a></li>
                        /
                        <li><a href="#" class="active">Shop</a></li>
                    </ul> -->
                </div>
            </div>

            <!-- Insights -->
            <ul class="insights">
                <li>
                    <i class='bx bx-arrow-to-right' style="color: rgb(24, 141, 180);"></i>
                    <span class="info">
                        <h3>
                            41
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
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" id="openModalButton">
                        Tambah Barang
                      </button>
                    <table>
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Gambar</th>
                                <th>Deskripsi</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>231</td>
                                <td>Iphone</td>
                                <td></td>
                                <td>Kurang Bagus</td>
                                <td>53</td>
                            </tr>
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
            <form action="" method="post">
              <div class="modal-body">
                <input type="text" name="kodebarang" placeholder="Kode Barang" class="form-control" required>
                <br>
                <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
                <br>
                <input type="file" name="kodebarang" placeholder="Gambar" class="form-control" required>
                <br>
                <input type="text" name="deskripsi" placeholder="Deskripsi" class="form-control" required>
                <br>
                <input type="text" name="harga" placeholder="Harga" class="form-control" required>
                <br>
                <input type="number" name="jumlah" placeholder="Jumlah" class="form-control" required>
                <br>
                <button type="submit" class="btn btn-primary" name="addnewbarang">Tambah</button>
              </div>
            </form>
    
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-close" id="closeModalButton">Close</button>
            </div>
    
          </div>
        </div>
      </div>
    
    <script src="index.js"></script>
</body>

</html>