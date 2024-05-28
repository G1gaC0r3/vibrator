document.addEventListener('DOMContentLoaded', function() {
    const currentTheme = localStorage.getItem('theme') || 'light-mode';
    document.body.classList.add(currentTheme);

    let dataMap = {}; // Objek untuk menyimpan jumlah barang berdasarkan jenis
    let labels = []; // Array untuk menyimpan label jenis barang
    let data = []; // Array untuk menyimpan jumlah barang

    // Mengambil data HTML dan menggabungkan jumlah barang yang sama
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

    
    for (const jenisBarang in dataMap) {
        labels.push(jenisBarang);
        data.push(dataMap[jenisBarang]);
    }

    const colorPalette = [
        '#3498db', // Blue
        '#e74c3c', // Red
        '#9b59b6', // Purple
        '#f39c12', // Orange
        '#2ecc71', // Green
        '#e67e22', // Carrot
        '#1abc9c', // Turquoise
        '#34495e', // Navy Blue
        '#f1c40f', // Yellow
        '#e84393'  // Pink
    ];

    let chart = createChart(labels, data, colorPalette);

    document.getElementById('theme-toggle').addEventListener('click', function() {
        document.body.classList.toggle('light-mode');
        document.body.classList.toggle('dark-mode');

        const newTheme = document.body.classList.contains('dark-mode') ? 'dark-mode' : 'light-mode';
        localStorage.setItem('theme', newTheme);

        updateChartTheme(chart);
    });

    function createChart(labels, data, colors) {
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
                plugins: {
                    legend: {
                        labels: {
                            color: 'darkgray' 
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'darkgray' 
                        }
                    },
                    x: {
                        ticks: {
                            color: 'darkgray' 
                        }
                    }
                }
            }
        });
    }

    function updateChartTheme(chart) {
        chart.update();
    }
});
