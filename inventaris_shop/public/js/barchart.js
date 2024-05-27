document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('barangChart').getContext('2d');

    // Mendapatkan data dari elemen HTML
    var labels = JSON.parse(document.getElementById('barangLabels').textContent);
    var data = JSON.parse(document.getElementById('barangData').textContent);

    // Mendefinisikan warna-warna untuk light mode dengan gradasi
    var lightColors = [
        'rgba(255, 99, 132, 0.8)',
        'rgba(54, 162, 235, 0.8)',
        'rgba(75, 192, 192, 0.8)',
        'rgba(255, 206, 86, 0.8)',
        'rgba(153, 102, 255, 0.8)',
        'rgba(255, 159, 64, 0.8)',
        'rgba(201, 203, 207, 0.8)'
    ];

    // Mendefinisikan warna-warna untuk dark mode dengan gradasi
    var darkColors = [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(201, 203, 207, 1)'
    ];

    // Fungsi untuk mendapatkan warna berdasarkan mode
    function getColors() {
        const isDarkMode = localStorage.getItem('theme') === 'dark';
        return isDarkMode ? darkColors : lightColors;
    }

    // Fungsi untuk mendapatkan warna teks dan garis berdasarkan mode
    function getTextColor() {
        return localStorage.getItem('theme') === 'dark' ? 'rgba(255, 255, 255, 0.9)' : 'rgba(0, 0, 0, 0.9)';
    }

    function getGridColor() {
        return localStorage.getItem('theme') === 'dark' ? 'rgba(255, 255, 255, 0.2)' : 'rgba(0, 0, 0, 0.1)';
    }

    // Mendapatkan warna yang akan digunakan
    var colors = getColors();

    // Jika ada lebih banyak data daripada warna, ulangi warna
    var backgroundColors = [];
    for (var i = 0; i < data.length; i++) {
        backgroundColors.push(colors[i % colors.length]);
    }

    // Menambahkan efek gradasi ke setiap batang
    var gradientBackgrounds = [];
    backgroundColors.forEach(function(color, index) {
        var gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, color);
        gradient.addColorStop(1, 'rgba(255, 255, 255, 0.3)');
        gradientBackgrounds.push(gradient);
    });

    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Barang',
                data: data,
                backgroundColor: gradientBackgrounds,
                borderColor: colors,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    ticks: {
                        color: getTextColor()
                    },
                    grid: {
                        color: getGridColor()
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: getTextColor()
                    },
                    grid: {
                        color: getGridColor()
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: getTextColor()
                    }
                }
            }
        }
    });
});
