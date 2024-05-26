<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./style.css">
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

        <main>
            <div class="profile-container">
                <div class="profile-left">
                    <img src="/images/profile-picture.jpg" alt="Profile Picture" class="profile-img">
                </div>
                <div class="profile-right">
                    <h2>John Doe</h2>
                    <p class="user-detail"><strong>Username:</strong> johndoe</p>
                    <p class="user-detail"><strong>Email:</strong> john@example.com</p>
                    <p class="user-detail"><strong>Full Name:</strong> John Doe</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal" id="openEditProfileModalButton">
                        Edit Profile
                    </button>
                </div>
            </div>
        </main>
    </div>

    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal body -->
                <form id="editProfileForm">
                    <div class="modal-body">
                        <input type="text" name="fullname" placeholder="Full Name" class="form-control" required>
                        <br>
                        <input type="text" name="username" placeholder="Username" class="form-control" required>
                        <br>
                        <input type="email" name="email" placeholder="Email" class="form-control" required>
                        <br>
                        <button type="submit" class="btn btn-primary" name="editprofile">Save Changes</button>
                    </div>
                </form>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="index.js"></script>

    </body>
    </html>