<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Perbaikan path untuk CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Website Inventaris</title>
</head>
<body>

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
                <img src="" alt="" id="navbar-profile-picture">
            </a>
            
        </nav>
        <!-- End of Navbar -->

        <!-- CRUD Display -->
        <div class="profile-updates" style="background-color: var(--light); margin-top: 30px; margin-bottom: 20px; padding: 30px; border-radius: 30px; display: flex; justify-content: center; max-width: 960px; margin-left: auto; margin-right: auto; gap: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <h2 style="color: var(--primary); font-weight: bold; margin-bottom: 15px; text-align: center;">Recent Profile Updates</h2>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="padding: 12px; text-align: left; border-bottom: 1px solid var(--light-grey); color: var(--dark-grey); font-size: 16px;">Nama</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 1px solid var(--light-grey); color: var(--dark-grey); font-size: 16px;">Email</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 1px solid var(--light-grey); color: var(--dark-grey); font-size: 16px;">Nomor HP</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 1px solid var(--light-grey); color: var(--dark-grey); font-size: 16px;">Tanggal Lahir</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 1px solid var(--light-grey); color: var(--dark-grey); font-size: 16px;">Foto Profil</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 12px; text-align: left; border-bottom: 1px solid var(--light-grey); color: var(--medium-grey); font-size: 14px;">Contoh Nama</td>
                        <td style="padding: 12px; text-align: left; border-bottom: 1px solid var(--light-grey); color: var(--medium-grey); font-size: 14px;">contoh@email.com</td>
                        <td style="padding: 12px; text-align: left; border-bottom: 1px solid var(--light-grey); color: var(--medium-grey); font-size: 14px;">08123456789</td>
                        <td style="padding: 12px; text-align: left; border-bottom: 1px solid var(--light-grey); color: var(--medium-grey); font-size: 14px;">01-01-1990</td>
                        <td style="padding: 12px; text-align: left; border-bottom: 1px solid var(--light-grey); color: var(--medium-grey); font-size: 14px;"><img src="" alt="Profile Picture" style="width: 50px; height: 50px; border-radius: 50%; display: block; margin: auto;"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End CRUD Display -->

        <!-- Form Update Profil -->
        <div class="update-profile">
            <div class="form-and-preview" style="display: flex; justify-content: space-between;">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="phone">Nomor HP:</label>
                            <input type="text" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Tanggal Lahir:</label>
                            <input type="date" id="birthdate" name="birthdate" required>
                        </div>
                        <label for="profile_picture">Foto Profil:</label>
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                    </div>
                    <div class="image-preview" id="imagePreview">
                        <img src="" alt="Image Preview" class="image-preview__image" style="display: none;">
                        <span class="image-preview__default-text">Preview Foto Profil</span>
                    </div>
                    <button type="submit" class="btn-update">
                        Update Profile
                    </button>
                </form>
            </div>
        </div>
        <!-- End Form Update Profil -->

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    </body>
    </html>
