<!DOCTYPE html>
<html>


<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title>Dashboard - QYEA Store</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body class="fixed-sidebar full-height-layout skin-2 ">

    <?php

    include('inc/db_conn.php');

    $query = "SELECT * FROM financial_journal ORDER BY fj_id DESC LIMIT 1";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $cashbal = $row['cash_balance'];
    } else {
        $cashbal = "0";
    }

    $query1 = "SELECT 
    SUM(CASE WHEN type = 'INFLOW' THEN total ELSE 0 END) - 
    SUM(CASE WHEN type = 'OUTFLOW' THEN total ELSE 0 END) AS total_income
FROM cashflow;
";

    $result1 = mysqli_query($link, $query1);

    if (mysqli_num_rows($result1) > 0) {  // Fixed typo here
        $row1 = mysqli_fetch_assoc($result1);
        $totalincome = $row1['total_income'];  // Changed 'cash_balance' to 'total_income'
    } else {
        $totalincome = "0";
    }

    $query2 = "SELECT *, COUNT(DISTINCT order_id) as count FROM orders WHERE order_status = 'Pending'";
    $result2 = mysqli_query($link, $query2);
    if (mysqli_num_rows($result2) > 0) {
        $row2 = mysqli_fetch_assoc($result2);
        $orders = $row2['count'];
    } else {
        $orders = "0";
    }

    $query3 = "SELECT *, COUNT(DISTINCT user_id) as count FROM users";
    $result3 = mysqli_query($link, $query3);
    if (mysqli_num_rows($result3) > 0) {
        $row3 = mysqli_fetch_assoc($result3);
        $users = $row3['count'];
    } else {
        $users = "0";
    }




    ?>

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
                    <h2>Dashboard</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard">QYEA</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Dashboard</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                        <!-- <a href="" class="btn btn-primary">This is action area</a> -->
                    </div>
                </div>
            </div>

            <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == "Administrator") || $_SESSION['role'] == "Staff"): ?>
                <div class="wrapper wrapper-content">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <div class="ibox-tools">
                                        <!-- <span class="label label-primary float-right">Monthly</span> -->
                                    </div>
                                    <h5><strong>Low Stocks</strong></h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">
                                        <?php include("inc/fetch_low_stocks.php"); ?>
                                        <?php if (!empty($count)): ?>
                                            <strong><?php echo $count; ?></strong>
                                        <?php endif; ?>
                                    </h1>
                                    <small>Amount</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <div class="ibox-tools">
                                        <!-- <span class="label label-primary float-right">Monthly</span> -->
                                    </div>
                                    <h5><strong>Pending Order</strong></h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">
                                        <?php include("inc/fetch_pending_order_count.php"); ?>
                                        <?php if (!empty($pendingOrderCount)): ?>
                                            <strong><?php echo $pendingOrderCount; ?></strong>
                                        <?php else: ?>
                                            <strong>0</strong>
                                        <?php endif; ?>
                                    </h1>
                                    <small>Amount</small>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-lg-3">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <div class="ibox-tools">
                                        <span class="label label-success float-right">Annualy</span>
                                    </div>
                                    <h5><strong>Income</strong></h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">
                                        <strong>₱ <?php echo number_format($totalincome, 2); ?></strong>
                                    </h1>
                                    <small>Total income</small>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-lg-3">
                            <div class="ibox ">
                                <div class="ibox-title">

                                    <h5><strong>Orders</strong></h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">
                                        <strong><?php echo $orders; ?></strong>
                                    </h1>
                                    <small>On process orders</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5><strong>Users</strong></h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">
                                        <strong><?php echo $users; ?></strong>
                                    </h1>
                                    <small>Active Users</small>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Income</h5>

                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-lg-12" style="height: 180px;">
                                            <canvas id="lineChart"></canvas>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            <?php endif; ?>





        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="assets/js/inspinia.js"></script>
    <script src="assets/js/plugins/pace/pace.min.js"></script>
    <script src="assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/js/plugins/easypiechart/jquery.easypiechart.js"></script>
    <script src="assets/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <script src="assets/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="assets/js/demo/sparkline-demo.js"></script>
    <script src="https://kit.fontawesome.com/5a839d378a.js" crossorigin="anonymous"></script>



    <!-- Peity -->
    <script src="assets/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="assets/js/demo/peity-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
        // Parse data from PHP into JavaScript
        var chartData = <?php echo $chart_data_json; ?>;
        var chartYears = <?php echo $chart_years_json; ?>;
        var chartMin = <?php echo $chartmin; ?>;
        var chartMax = <?php echo $chartmax; ?>;

        // Create the line chart
        var ctx = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: []
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        min: chartMin,
                        max: chartMax,
                    }
                }
            }
        });

        // Add data to the line chart
        for (var year in chartData) {
            lineChart.data.datasets.push({
                label: year,
                data: chartData[year],
                fill: false,
                borderColor: getRandomColor(), // You can define this function to get different colors for each line
                tension: 0.4
            });
        }

        // Update the chart
        lineChart.update();

        // Function to generate random colors
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>


</body>

</html>