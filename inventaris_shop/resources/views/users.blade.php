<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Website Inventaris</title>
    <style>
.content nav{
    height: 56px;
    background: var(--light);
    padding: 0 24px 0 0;
    display: flex;
    align-items: center;
    grid-gap: 24px;
    position: sticky;
    top: 0;
    left: 0;
    z-index: 1000;
}

.content nav::before{
    content: "";
    position: absolute;
    width: 40px;
    height: 40px;
    bottom: -40px;
    left: 0;
    border-radius: 50%;
    box-shadow: -20px -20px 0 var(--light);
}


.saved-profile {
    background-color: #ffffff;
    padding: 15px;
    margin-top: 40px;
    margin-left: 20px;
    margin-right: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-and-preview {
    margin-bottom: 20px;
}

.table-saved {
    width: 100%;
    border-collapse: collapse;
}

.table-header {
    font-weight: bold;
    padding: 10px;
    background-color: #f0f0f0;
}

.table-saved td {
    padding: 10px;
}

.btn-container {
    padding: 5px 10px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-danger {
    background-color: #dc3545;
    color: #fff;
}

.select-container {
    position: relative;
}

select {
    padding: 5px 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 3px;
    cursor: pointer;
}
p {
    margin: 0;
}

.divider-row td {
    padding: 0;
}

.divider-row hr {
    margin: 0;
    border: none;
    border-top: 1px solid #ccc;
}
.userrole {
    text-align: center; 
}

.action-cell {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}
    </style>
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
        <div class="form-and-preview">
                <h3>Data User</h3>
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
                    @foreach($users as $index => $user)
                        <tr>
                            <td class="userrole">{{ $user->name }}</td>
                            <td class="userrole">{{ $user->email }}</td>
                            <td class="userrole">{{ $user->role }}</td>
                            <td class="action-cell">
                                @if(auth()->user()->role == 'admin')
                                    <p>Admin detected</p> <!-- Debugging output -->
                                    <form method="POST" action="{{ route('deleteUser', $user->id) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-container btn-danger">Hapus</button>
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
                        @if($index < count($users) - 1) <!-- Add a divider if it's not the last user -->
                        <tr class="divider-row">
                            <td colspan="4"><hr></td>
                        </tr>
                        @endif
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
