document.addEventListener('DOMContentLoaded', function() {
    const currentTheme = localStorage.getItem('theme') || 'light-mode';
    document.body.classList.add(currentTheme);

    let dataMap = {}; // Objek untuk menyimpan jumlah barang berdasarkan jenis
    let labels = []; // Array untuk menyimpan label jenis barang
    let data = []; // Array untuk menyimpan jumlah barang

    // Mengambil data HTML dan menggabungkan jumlah barang yang sama
    const rows = document.querySelectorAll('.table-bordered tbody tr');
    rows.forEach(row => {
        const namaBarang = row.cells[2].textContent; // Assuming Nama_Barang is in the third cell

        if (dataMap[namaBarang]) {
            dataMap[namaBarang] += 1; // Increment count of Nama_Barang
        } else {
            dataMap[namaBarang] = 1; // Initialize count of Nama_Barang
        }
    });

<<<<<<< HEAD
    
    for (const jenisBarang in dataMap) {
        labels.push(jenisBarang);
        data.push(dataMap[jenisBarang]);
=======
    // Memasukkan data dari objek ke dalam array labels dan data
    for (const namaBarang in dataMap) {
        labels.push(namaBarang);
        data.push(dataMap[namaBarang]);
>>>>>>> 9c87319995054b5d92be8c41735f55c139c8ae3c
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
<<<<<<< HEAD
                plugins: {
                    legend: {
                        labels: {
                            color: 'darkgray' 
                        }
                    }
                },
=======
                maintainAspectRatio: false,
>>>>>>> 9c87319995054b5d92be8c41735f55c139c8ae3c
                scales: {
                    y: {
                        beginAtZero: true,
                        max: maxDataValue + 10, // Set max value slightly higher than the max data value for better visualization
                        ticks: {
<<<<<<< HEAD
                            color: 'darkgray' 
=======
                            color: theme === 'dark-mode' ? 'black' : 'white'
>>>>>>> 9c87319995054b5d92be8c41735f55c139c8ae3c
                        }
                    },
                    x: {
                        ticks: {
<<<<<<< HEAD
                            color: 'darkgray' 
=======
                            color: theme === 'dark-mode' ? 'black' : 'white'
>>>>>>> 9c87319995054b5d92be8c41735f55c139c8ae3c
                        }
                    }
                }
            }
        });
    }

<<<<<<< HEAD
    function updateChartTheme(chart) {
=======
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
>>>>>>> 9c87319995054b5d92be8c41735f55c139c8ae3c
        chart.update();
    }
});
