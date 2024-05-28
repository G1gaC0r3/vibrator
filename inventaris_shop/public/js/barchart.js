document.addEventListener('DOMContentLoaded', function() {
    const currentTheme = localStorage.getItem('theme') || 'light-mode';
    document.body.classList.add(currentTheme);

    let dataMap = {}; // Objek untuk menyimpan jumlah barang berdasarkan jenis
    let labels = []; // Array untuk menyimpan label jenis barang
    let data = []; // Array untuk menyimpan jumlah barang

    // Mengambil data dari elemen HTML dan menggabungkan jumlah barang yang sama
    const rows = document.querySelectorAll('.table-bordered tbody tr');
    rows.forEach(row => {
        const jenisBarang = row.cells[2].textContent;
        const jumlahBarang = parseInt(row.cells[4].textContent);

        if (dataMap[jenisBarang]) {
            dataMap[jenisBarang] += jumlahBarang;
        } else {
            dataMap[jenisBarang] = jumlahBarang;
        }
    });

    // Memasukkan data dari objek ke dalam array labels dan data
    for (const jenisBarang in dataMap) {
        labels.push(jenisBarang);
        data.push(dataMap[jenisBarang]);
    }

    const colorPalette = [
        '#1abc9c', // Teal
        '#e74c3c', // Coral
        '#9b59b6', // Lavender
        '#34495e', // Navy
        '#f1c40f'  // Gold
    ];

    let chart = createChart(labels, data, colorPalette, currentTheme);

    document.getElementById('theme-toggle').addEventListener('click', function() {
        document.body.classList.toggle('light-mode');
        document.body.classList.toggle('dark-mode');

        const newTheme = document.body.classList.contains('dark-mode') ? 'dark-mode' : 'light-mode';
        localStorage.setItem('theme', newTheme);

        updateChartTheme(chart, newTheme);
    });

    function createChart(labels, data, colors, theme) {
        const ctx = document.getElementById('barangChart').getContext('2d');
        return new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Barang',
                    data: data,
                    backgroundColor: colors,
                    borderColor: colors,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: theme === 'dark-mode' ? 'white' : 'black'
                        }
                    },
                    x: {
                        ticks: {
                            color: theme === 'dark-mode' ? 'white' : 'black'
                        }
                    }
                }
            }
        });
    }

    function updateChartTheme(chart, theme) {
        chart.options.scales.y.ticks.color = theme === 'dark-mode' ? 'white' : 'black';
        chart.options.scales.x.ticks.color = theme === 'dark-mode' ? 'white' : 'black';
        chart.update();
    }
});
