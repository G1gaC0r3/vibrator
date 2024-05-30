<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
            </div>
        </form>
        <input type="checkbox" id="theme-toggle" hidden>
        <label for="theme-toggle" class="theme-toggle"></label>
    </nav>      
    <div class="saved-profile">
        <div class="form-and-preview" style="display: flex; justify-content: space-between; flex-direction:column">
            <div style="display: flex; justify-content:center">
                <h3>Data User</h3>
            </div>
            <table class="table-saved">
                <thead>
                    <tr>
                        <th class="table-header"><strong>Nama</strong></th>
                        <th class="table-header"><strong>Email</strong></th>
                        <th class="table-header"><strong>Role</strong></th>
                        <th class="table-header"><strong>Aksi</strong></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                @if(auth()->user()->role == 'admin')
                                    <p>Admin detected</p> <!-- Debugging output -->
                                    <form method="POST" action="{{ route('deleteUser', $user->id) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                    <form method="POST" action="{{ route('setRole', $user->id) }}" style="display:inline;">
                                        @csrf
                                        <div class="select-container">
                                            <select name="role" onchange="this.form.submit()">
                                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                        </div>
                                    </form>
                                @else
                                    <p>Bukan Admin</p> <!-- Debugging output -->
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/index.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const themeToggle = document.getElementById('theme-toggle');
        const tableHeaders = document.querySelectorAll('.table-header');
        const updateTheme = () => {
            const isDarkMode = themeToggle.checked;
            tableHeaders.forEach(header => {
                header.style.color = isDarkMode ? '#ffffff' : '#696969';
            });
        };
        themeToggle.addEventListener('change', updateTheme);
        updateTheme();
    });
</script>
</body>
</html>
