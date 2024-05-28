document.addEventListener('DOMContentLoaded', function() {
    const currentTheme = localStorage.getItem('theme') || 'light-mode';
    document.body.classList.add(currentTheme);

    let dataMap = {}; // Objek untuk menyimpan jumlah barang berdasarkan jenis
    let labels = []; // Array untuk menyimpan label jenis barang
    let data = []; // Array untuk menyimpan jumlah barang

    // Mengambil data dari elemen HTML dan menggabungkan jumlah barang yang sama
    const rows = document.querySelectorAll('.table-bordered tbody tr');
    rows.forEach(row => {
        const namaBarang = row.cells[2].textContent; // Assuming Nama_Barang is in the third cell

        if (dataMap[namaBarang]) {
            dataMap[namaBarang] += 1; // Increment count of Nama_Barang
        } else {
            dataMap[namaBarang] = 1; // Initialize count of Nama_Barang
        }
    });

    // Memasukkan data dari objek ke dalam array labels dan data
    for (const namaBarang in dataMap) {
        labels.push(namaBarang);
        data.push(dataMap[namaBarang]);
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
        const maxDataValue = Math.max(...data); // Calculate the maximum value in the data array

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
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: maxDataValue + 10, // Set max value slightly higher than the max data value for better visualization
                        ticks: {
                            color: theme === 'dark-mode' ? 'black' : 'white'
                        }
                    },
                    x: {
                        ticks: {
                            color: theme === 'dark-mode' ? 'black' : 'white'
                        }
                    }
                }
            }
        });
    }

    function updateChartTheme(chart, theme) {
        const textColor = theme === 'dark-mode' ? 'black' : 'white';
        const gridColor = theme === 'dark-mode' ? 'rgba(0, 0, 0, 0.1)' : 'rgba(255, 255, 255, 0.1)';

        // Update ticks
        chart.options.scales.y.ticks.color = textColor;
        chart.options.scales.x.ticks.color = textColor;

        // Update grid lines
        chart.options.scales.y.grid.color = gridColor;
        chart.options.scales.x.grid.color = gridColor;

        // Optionally update legend and title if they exist
        if (chart.options.plugins.legend) {
            chart.options.plugins.legend.labels.color = textColor;
        }
        if (chart.options.plugins.title) {
            chart.options.plugins.title.color = textColor;
        }

        // Update the chart to apply the new theme settings
        chart.update();
    }
});
