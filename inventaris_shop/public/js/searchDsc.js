document.addEventListener('DOMContentLoaded', function() {
    const searchIcon = document.getElementById('search-icon');
    const searchInput = document.getElementById('search-input');
    const sortIcon = document.getElementById('sort-icon');
    const table = document.getElementById('barang-table');

    // Cek apakah elemen-elemen ini ada di halaman
    if (table && searchIcon && searchInput && sortIcon) {
        const rows = Array.from(table.querySelectorAll('tbody tr'));

        // Fungsi untuk melakukan pencarian
        function search(term) {
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                let found = false;
                cells.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(term.toLowerCase())) {
                        found = true;
                    }
                });
                row.style.display = found ? '' : 'none';
            });
        }

        // Menangani event pencarian
        searchIcon.addEventListener('click', function() {
            search(searchInput.value);
        });

        searchInput.addEventListener('input', function() {
            search(this.value);
        });

        // Fungsi untuk melakukan pengurutan
        let sortOrder = 0; // 0 = original, 1 = ascending, 2 = descending
        const originalOrder = rows.map(row => row.innerHTML);

        function getSortIndex() {
            // Mengambil indeks kolom jumlah barang berdasarkan jumlah kolom
            const headers = table.querySelectorAll('thead th');
            for (let i = 0; i < headers.length; i++) {
                if (headers[i].textContent.toLowerCase().includes('jumlah')) {
                    return i;
                }
            }
            return -1; // Jika tidak ditemukan
        }

        function sortTable(order) {
            const tbody = table.querySelector('tbody');
            let sortedRows = [];
            const sortIndex = getSortIndex();

            if (sortIndex === -1) {
                console.error("Kolom jumlah tidak ditemukan.");
                return;
            }

            if (order === 0) {
                // Kembalikan ke urutan asli
                tbody.innerHTML = '';
                originalOrder.forEach(html => {
                    const row = document.createElement('tr');
                    row.innerHTML = html;
                    tbody.appendChild(row);
                });
                return;
            }

            sortedRows = rows.slice().sort((a, b) => {
                const aVal = parseInt(a.cells[sortIndex].textContent);
                const bVal = parseInt(b.cells[sortIndex].textContent);
                return order === 1 ? aVal - bVal : bVal - aVal;
            });

            // Hapus semua baris lama
            tbody.innerHTML = '';

            // Tambahkan baris yang sudah diurutkan
            sortedRows.forEach(row => {
                tbody.appendChild(row);
            });
        }

        // Menangani event pengurutan
        sortIcon.addEventListener('click', function() {
            sortOrder = (sortOrder + 1) % 3; // 0 -> 1 -> 2 -> 0
            sortTable(sortOrder);
        });
    }
});
