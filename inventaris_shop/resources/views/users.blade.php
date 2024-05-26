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
            <div class="logout-container">
                <a href="logout.php" class="logout-link">
                    <i class='bx bx-log-out-circle'></i>
                    <span class="logout-text">Logout</span>
                </a>
            </div>
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
                <img src="/images/logo.png" alt="">
            </a>
        </nav>
        <!-- End of Navbar -->

        <!-- Form Update Profil -->
        <div class="update-profile">
            <div class="form-and-preview" style="display: flex; justify-content: space-between;">
                <form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="profile_picture">Foto Profil:</label>
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                    </div>
                    <button type="submit" class="btn-update">Update Profil</button>
                </form>
                <div class="image-preview" id="imagePreview">
                    <img src="" alt="Image Preview" class="image-preview__image">
                    <span class="image-preview__default-text">Preview Foto Profil</span>
                </div>
            </div>
        </div>
        <!-- End Form Update Profil -->

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <script>
        const profilePictureInput = document.getElementById('profile_picture');
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewImage = document.querySelector('.image-preview__image');
        const imagePreviewDefaultText = document.querySelector('.image-preview__default-text');

        profilePictureInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                imagePreviewDefaultText.style.display = 'none';
                imagePreviewImage.style.display = 'block';

                reader.addEventListener('load', function() {
                    imagePreviewImage.setAttribute('src', this.result);
                });

                reader.readAsDataURL(file);
            } else {
                imagePreviewDefaultText.style.display = null;
                imagePreviewImage.style.display = null;
                imagePreviewImage.setAttribute('src', '');
            }
        });
    </script>

    </body>
    </html>