<!DOCTYPE html>
<html>

<head>
    <title>Product Earnings Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<?php include("data.php"); ?>

<body>
    <!-- Year Filter -->
    <label for="yearFilter">Select Year:</label>
    <select id="yearFilter">
        <option value="2023" <?php if ($year == 2023) echo 'selected'; ?>>2023</option>
        <option value="2024" <?php if ($year == 2024) echo 'selected'; ?>>2024</option>
        <option value="2025" <?php if ($year == 2025) echo 'selected'; ?>>2025</option>
        <!-- Add more years as needed -->
    </select>

    <canvas id="myChart"></canvas>
    <script>
        const jsonData = <?php echo $json_data; ?>; // Get the JSON data from PHP

        const ctx = document.getElementById('myChart').getContext('2d');

        // Process the data for Chart.js (similar to the Python example)
        const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const datasets = [];

        jsonData.forEach(item => {
            const year = item.year;
            const productName = item.description;
            const earnings = [item.january, item.february, item.march, item.april, item.may, item.june, item.july, item.august, item.september, item.october, item.november, item.december];

            datasets.push({
                label: `${productName} - ${year}`,
                data: earnings,
                borderColor: getRandomColor(), // Function to create random colors
                borderWidth: 1,
                fill: false // Set to true for filled lines
            });
        });

        const myChart = new Chart(ctx, {
            type: 'line', // Line chart
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true, // Make the chart responsive
                scales: {
                    y: {
                        beginAtZero: true, // Start y-axis at 0
                        title: {
                            display: true,
                            text: 'Earnings'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Monthly Earnings'
                    }
                }
            }
        });

        function getRandomColor() {  // Helper function for random colors
            const r = Math.floor(Math.random() * 256);
            const g = Math.floor(Math.random() * 256);
            const b = Math.floor(Math.random() * 256);
            return `rgba(${r}, ${g}, ${b}, 1)`;
        }

        // Event listener for year filter change
        document.getElementById('yearFilter').addEventListener('change', function() {
            const selectedYear = this.value;
            window.location.href = `?year=${selectedYear}`; // Reload the page with the selected year as a query parameter
        });
    </script>

</body>

</html>
