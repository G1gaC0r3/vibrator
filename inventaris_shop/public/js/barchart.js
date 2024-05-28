document.addEventListener('DOMContentLoaded', function() {
    const currentTheme = localStorage.getItem('theme') || 'light-mode';
    document.body.classList.add(currentTheme);

    const labels = JSON.parse(document.getElementById('barangLabels').textContent);
    const data = JSON.parse(document.getElementById('barangData').textContent);

    let chart = createChart();

    document.getElementById('theme-toggle').addEventListener('click', function() {
        document.body.classList.toggle('light-mode');
        document.body.classList.toggle('dark-mode');

        const newTheme = document.body.classList.contains('dark-mode') ? 'dark-mode' : 'light-mode';
        localStorage.setItem('theme', newTheme);

        updateChartTheme(chart, newTheme);
    });

    function createChart() {
        const ctx = document.getElementById('barangChart').getContext('2d');
        return new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Barang',
                    data: data,
                    backgroundColor: getChartColors(currentTheme),
                    borderColor: getChartBorderColors(currentTheme),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: currentTheme === 'dark-mode' ? 'white' : 'black'
                        }
                    },
                    x: {
                        ticks: {
                            color: currentTheme === 'dark-mode' ? 'white' : 'black'
                        }
                    }
                }
            }
        });
    }

    function getChartColors(theme) {
        return theme === 'dark-mode' ? 'rgba(255, 99, 132, 0.8)' : 'rgba(54, 162, 235, 0.8)';
    }

    function getChartBorderColors(theme) {
        return theme === 'dark-mode' ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)';
    }

    function updateChartTheme(chart, theme) {
        chart.data.datasets[0].backgroundColor = getChartColors(theme);
        chart.data.datasets[0].borderColor = getChartBorderColors(theme);
        chart.options.scales.y.ticks.color = theme === 'dark-mode' ? 'white' : 'black';
        chart.options.scales.x.ticks.color = theme === 'dark-mode' ? 'white' : 'black';
        chart.update();
    }
});