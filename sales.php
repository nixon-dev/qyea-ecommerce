<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title>Sales - QYEA Store</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body class="fixed-sidebar full-height-layout skin-2">

    <div id="wrapper">

        <?php session_start(); ?>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "Administrator"): ?>
            <?php include("base/sidebar.php"); ?>
        <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] == "Staff"): ?>
            <?php include("base/staff-sidebar.php"); ?>
        <?php else: ?>
            <?php include("base/user-sidebar.php"); ?>
        <?php endif; ?>
        <?php include("inc/dashboard_query.php"); ?>
        <div id="page-wrapper" class="gray-bg">
            <?php include("base/navbar.php"); ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Sales</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard">QYEA</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Sales
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Sales</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                        <!-- <a href="" class="btn btn-primary">This is action area</a> -->
                    </div>
                </div>
            </div>







            <?php include("data.php"); ?>



            <div class="wrapper wrapper-content">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-sm-12">
                            <h3 class="font-bold text-center">Year</h3>
                            <div class="form-group  d-flex justify-content-center">
                                <div class="col-sm-2">
                                    <select class="form-control m-b" id="yearFilter">
                                        <option value="2022" <?php if ($year == 2022)
                                            echo 'selected'; ?>>2022</option>
                                        <option value="2023" <?php if ($year == 2023)
                                            echo 'selected'; ?>>2023</option>
                                        <option value="2024" <?php if ($year == 2024)
                                            echo 'selected'; ?>>2024</option>
                                        <option value="2025" <?php if ($year == 2025)
                                            echo 'selected'; ?>>2025</option>
                                    </select>
                                </div>
                            </div>

                            <canvas id="myChart"></canvas>
                        </div>


                    </div>
                </div>
            </div>



        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="https://kit.fontawesome.com/5a839d378a.js" crossorigin="anonymous"></script>
    <!-- Custom and plugin javascript -->
    <script src="assets/js/inspinia.js"></script>
    <script src="assets/js/plugins/pace/pace.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                borderWidth: 3,
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
        document.getElementById('yearFilter').addEventListener('change', function () {
            const selectedYear = this.value;
            window.location.href = `?year=${selectedYear}`; // Reload the page with the selected year as a query parameter
        });
    </script>






</body>

</html>