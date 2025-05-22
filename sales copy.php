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

            <?php
            include("inc/db_conn.php");

            $query = "SELECT 
            o.order_date,
            p.product_name, 
            SUM(o.order_amount) AS total_quantity_sold, 
            SUM(o.order_bill_total) AS total_earnings 
            FROM orders o 
            LEFT JOIN products p ON o.product_id = p.product_id 
            WHERE o.order_status = 'Completed' AND o.rejected = 'False' 
            GROUP BY p.product_name, order_date
            ORDER BY p.product_name ASC, o.order_date ASC";

            $result = mysqli_query($link, $query);
            $sales_data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $sales_data[] = $row;
            }
            ?>


            <?php
            $product_sales_data = array();
            foreach ($sales_data as $data) {
                $product_name = $data['product_name'];
                $order_date = $data['order_date'];
                $quantity = $data['total_quantity_sold'];

                if (!isset($product_sales_data[$product_name])) {
                    $product_sales_data[$product_name] = array();
                }
                $product_sales_data[$product_name][$order_date] = $quantity;
            }

            $product_earnings_data = array();
            foreach ($sales_data as $data) {
                $product_name = $data['product_name'];
                $order_date = $data['order_date'];
                $earnings = $data['total_earnings'];

                if (!isset($product_earnings_data[$product_name])) {
                    $product_earnings_data[$product_name] = array();
                }
                $product_earnings_data[$product_name][$order_date] = $earnings;
            }

            $product_earnings_json = json_encode($product_earnings_data);
            $product_sales_json = json_encode($product_sales_data);
            $labels_json = json_encode(array_unique(array_column($sales_data, 'order_date')));
            ?>





            <div class="wrapper wrapper-content">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-sm-6">
                            <h3 class="font-bold text-center">Quantity Data</h3>
                            <canvas id="quantityChart" width="400" height="200"></canvas>
                        </div>
                        <div class="col-sm-6">
                            <h3 class="font-bold text-center">Sales Data</h3>
                            <canvas id="earningsChart" width="400" height="200"></canvas>
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
        document.addEventListener('DOMContentLoaded', function () {
            const productSales = JSON.parse('<?php echo $product_sales_json; ?>');
            const productEarnings = JSON.parse('<?php echo $product_earnings_json; ?>');
            const labels = JSON.parse('<?php echo $labels_json; ?>');

            const datasets = Object.keys(productSales).map(productName => {
                const data = labels.map(date => productSales[productName][date] || 0);

                return {
                    label: productName,
                    data: data,
                    fill: false,
                    borderColor: getRandomColor(),
                    tension: 0.1
                };
            });

            const earningsDatasets = Object.keys(productEarnings).map(productName => {
                const data = labels.map(date => productEarnings[productName][date] || 0);
                return {
                    label: productName,
                    data: data,
                    fill: false,
                    borderColor: getRandomColor(),
                    tension: 0.1
                };
            });

            // Function to generate random colors
            function getRandomColor() {
                const r = Math.floor(Math.random() * 255);
                const g = Math.floor(Math.random() * 255);
                const b = Math.floor(Math.random() * 255);
                return `rgba(${r}, ${g}, ${b}, 1)`;
            }

            // Quantity Sold Chart
            const ctxQuantity = document.getElementById('quantityChart').getContext('2d');
            const quantityChart = new Chart(ctxQuantity, {
                type: 'line',
                data: {
                    labels: labels, // Use dates as x-axis labels
                    datasets: datasets // Add datasets for each product
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Quantity Sold'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Order Date'
                            }
                        }
                    }
                }
            });

            // Earnings Chart
            const ctxEarnings = document.getElementById('earningsChart').getContext('2d');
            new Chart(ctxEarnings, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: earningsDatasets
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Total Earnings'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Order Date'
                            }
                        }
                    }
                }
            });
        });
    </script>






</body>

</html>