document.addEventListener('DOMContentLoaded', function() {
    let barangData = {}; // Objek untuk menyimpan data barang

    // Mengambil data dari tabel
    const tableRows = document.querySelectorAll('#barang-table tbody tr');
    tableRows.forEach(row => {
        const jenisBarang = row.cells[2].textContent.trim(); // Kolom 3 berisi jenis barang
        const jumlahBarang = parseInt(row.cells[3].textContent.trim()); // Kolom 4 berisi jumlah barang
        if (!barangData[jenisBarang]) {
            barangData[jenisBarang] = jumlahBarang; // Jika jenis barang belum ada, tambahkan dengan jumlah yang ada
        } else {
            barangData[jenisBarang] += jumlahBarang; // Jika jenis barang sudah ada, tambahkan jumlahnya
        }
    });

    // Menggunakan palet warna yang berbeda untuk setiap batang chart
    const colors = ['#4CAF50', '#2196F3', '#FFC107', '#FF5722', '#9C27B0', '#E91E63', '#795548', '#607D8B'];

    // Menggambar barchart
    const ctx = document.getElementById('barangChart').getContext('2d');
    const barangChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Object.keys(barangData),
            datasets: [{
                label: 'Jumlah Barang',
                data: Object.values(barangData),
                backgroundColor: colors.slice(0, Object.keys(barangData).length), // Gunakan warna dari palet untuk setiap batang
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                }
            },
        }
    });
});