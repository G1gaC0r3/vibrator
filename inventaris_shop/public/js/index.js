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

const menuBar = document.querySelector('.content nav .bx.bx-menu');
const sideBar = document.querySelector('.sidebar');

menuBar.addEventListener('click', () => {
    sideBar.classList.toggle('close');
});

const searchBtn = document.querySelector('.content nav form .form-input button');
const searchBtnIcon = document.querySelector('.content nav form .form-input button .bx');
const searchForm = document.querySelector('.content nav form');

searchBtn.addEventListener('click', function (e) {
    if (window.innerWidth < 576) {
        e.preventDefault;
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
    const currentPath = window.location.pathname;
    const menuItems = document.querySelectorAll('.side-menu li a');

    // Hapus kelas 'active' dari semua elemen <li>
    menuItems.forEach(item => {
        item.parentElement.classList.remove('active');
    });

    // Tetapkan kelas 'active' hanya ke item menu yang sesuai dengan path URL saat ini
    menuItems.forEach(item => {
        if (item.getAttribute('href') === currentPath) {
            item.parentElement.classList.add('active');
        }
    });
});


