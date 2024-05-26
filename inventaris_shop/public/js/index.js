const sideLinks = document.querySelectorAll('.sidebar .side-menu li a:not(.logout)');

sideLinks.forEach(item => {
    const li = item.parentElement;
    item.addEventListener('click', () => {
        sideLinks.forEach(i => {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    })
});

document.addEventListener('DOMContentLoaded', (event) => {
    const menuBar = document.querySelector('.content nav .bx.bx-menu');
    const sideBar = document.querySelector('.sidebar');
    const logoutLink = document.querySelector('.logout-text');
    const Logo1 = document.querySelector('.logo1');

    // Check localStorage for sidebar state
    if (localStorage.getItem('sidebarState') === 'close') {
        sideBar.classList.add('close');
        logoutLink.style.display = 'none';
        Logo1.style.display = 'none';
    }

    menuBar.addEventListener('click', () => {
        sideBar.classList.toggle('close');
        logoutLink.style.display = sideBar.classList.contains('close') ? 'none' : 'inline';
        Logo1.style.display = sideBar.classList.contains('close') ? 'none' : 'flex';
        // Save the state in localStorage
        if (sideBar.classList.contains('close')) {
            localStorage.setItem('sidebarState', 'close',);
            localStorage.setItem('logo1State', 'close');
        } else {
            localStorage.removeItem('sidebarState');
            localStorage.removeItem('logo1State', 'close');
        }
    });

    const searchBtn = document.querySelector('.content nav form .form-input button');
    const searchBtnIcon = document.querySelector('.content nav form .form-input button .bx');
    const searchForm = document.querySelector('.content nav form');

    searchBtn.addEventListener('click', function (e) {
        if (window.innerWidth < 576) {
            e.preventDefault();
            searchForm.classList.toggle('show');
            if (searchForm.classList.contains('show')) {
                searchBtnIcon.classList.replace('bx-search', 'bx-x');
            } else {
                searchBtnIcon.classList.replace('bx-x', 'bx-search');
            }
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth < 768) {
            sideBar.classList.add('close');
        } else {
            sideBar.classList.remove('close');
        }
        if (window.innerWidth > 576) {
            searchBtnIcon.classList.replace('bx-x', 'bx-search');
            searchForm.classList.remove('show');
        }
    });
});


// Mengatur tampilan layar

document.addEventListener('DOMContentLoaded', function () {
    const toggler = document.getElementById('theme-toggle');

    // Memuat tema dari localStorage
    function loadTheme() {
        const theme = localStorage.getItem('theme');
        if (theme === 'dark') {
            document.body.classList.add('dark');
            toggler.checked = true;
        } else {
            document.body.classList.add('light');
            toggler.checked = false;
        }
    }

    // Menyimpan preferensi tema ke localStorage
    toggler.addEventListener('change', function () {
        if (this.checked) {
            document.body.classList.add('dark');
            document.body.classList.remove('light');
            localStorage.setItem('theme', 'dark');
        } else {
            document.body.classList.add('light');
            document.body.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
    });

    loadTheme();
});

// Mengatur Modal
var modal = document.getElementById("myModal");

// Periksa apakah elemen modal ada di halaman saat ini
if (modal !== null) {
    // Ambil tombol yang membuka modal
    var openModalButton = document.getElementById("openModalButton");

    // Ambil tombol yang menutup modal
    var closeModalButton = document.getElementById("closeModalButton");
    var closeModalButtonFooter = document.getElementById("closeModalButtonFooter");

    // Ketika tombol "Tambah Barang" diklik, buka modal
    openModalButton.onclick = function() {
      modal.style.display = "flex";
      setTimeout(() => {
        modal.classList.add("show");
      }, 5); // Give a slight delay to trigger the CSS transition
    }

    // Ketika tombol tutup close  diklik, tutup modal
    closeModalButton.onclick = function() {
      modal.classList.remove("show");
      setTimeout(() => {
        modal.style.display = "none";
      }, 500); // Match the transition duration in CSS
    }

    // Ketika pengguna mengklik di luar modal, tutup modal
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.classList.remove("show");
        setTimeout(() => {
          modal.style.display = "none";
        }, 500); // Match the transition duration in CSS
      }
    }
}


document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.querySelector('#theme-toggle');
    const logoSpan = document.querySelector('.sidebar .logo span');

    // Check the current theme on page load
    const isDarkMode = localStorage.getItem('theme') === 'dark';
    themeToggle.checked = isDarkMode;

    if (isDarkMode) {
        document.body.classList.add('dark-mode');
        logoSpan.style.color = 'var(--dark)';
    } else {
        document.body.classList.remove('dark-mode');
        logoSpan.style.color = 'var(--dark)';
    }

    themeToggle.addEventListener('change', function() {
        if (this.checked) {
            // Dark mode
            document.body.classList.add('dark-mode');
            logoSpan.style.color = 'var(--dark)';
            localStorage.setItem('theme', 'dark');
        } else {
            // Light mode
            document.body.classList.remove('dark-mode');
            logoSpan.style.color = 'var(--dark)';
        }
    });

    // Check the current theme on page load and set the color accordingly
    if (themeToggle.checked) {
        document.body.classList.add('dark-mode');
        logoSpan.style.color = 'var(--dark)';
    } else {
        document.body.classList.remove('dark-mode');
        logoSpan.style.color = 'var(--dark)';
    }
});




document.addEventListener('DOMContentLoaded', (event) => {
    const currentRoute = window.location.pathname.split('/').pop(); // Ambil bagian terakhir dari URL
    const menuItems = document.querySelectorAll('.menu-item');

    menuItems.forEach(item => {
        if (item.dataset.route === currentRoute) {
            item.parentElement.classList.add('active');
        }
    });
});

const profilePictureInput = document.getElementById('profile_picture');
const imagePreview = document.getElementById('imagePreview');
const imagePreviewImage = document.querySelector('.image-preview__image');
const imagePreviewDefaultText = document.querySelector('.image-preview__default-text');
const navbarProfilePicture = document.getElementById('navbar-profile-picture');

profilePictureInput.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            const img = new Image();
            img.onload = () => {
                imagePreviewDefaultText.style.display = 'none';
                imagePreviewImage.style.display = 'block';
                imagePreviewImage.setAttribute('src', e.target.result);
                // Menyesuaikan ukuran gambar untuk menjaga aspek rasio tanpa mengubah ukuran border
                let containerWidth = imagePreview.clientWidth;
                let containerHeight = imagePreview.clientHeight;
                let ratio = Math.min(containerWidth / img.width, containerHeight / img.height);
                imagePreviewImage.style.width = img.width * ratio + 'px';
                imagePreviewImage.style.height = img.height * ratio + 'px';
                navbarProfilePicture.setAttribute('src', e.target.result);
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        imagePreviewDefaultText.style.display = 'block';
        imagePreviewImage.style.display = 'none';
        imagePreviewImage.setAttribute('src', '');
        navbarProfilePicture.setAttribute('src', '/images/logo.png'); 
    }
});

