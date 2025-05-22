<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title>Pending Orders - QYEA Store</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.bootstrap5.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body class="fixed-sidebar full-height-layout skin-2">

    <div id="wrapper">
        <?php if (session_status() == PHP_SESSION_NONE) {
            session_start();
        } ?>
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
                    <h2>Pending Orders</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard">QYEA</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Orders
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Pending</strong>
                        </li>
                    </ol>
                </div>
                <!-- <div class="col-sm-8">
                    <div class="title-action">

                        <?php if ($_SESSION['role'] == "Administrator" || $_SESSION['role'] == "Staff"): ?>
                            <a href="add-orders" class="btn btn-primary">Add Order</a>
                        <?php endif; ?>
                    </div>
                </div> -->
            </div>

            <div class="wrapper wrapper-content animated fadeInRight">

                <?php if (!empty($_GET['error'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_GET['error']; ?>
                    </div>
                <?php elseif (!empty($_GET['message'])): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_GET['message']; ?>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>List of Pending Orders</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">

                                <div class="table-responsive">
                                    <table
                                        class="table table-striped table-bordered table-hover nowrap dataTables-orders">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <?php if ($_SESSION['role'] == "Administrator" || $_SESSION['role'] == "Staff"): ?>
                                                    <th>Customer Name</th>
                                                <?php endif; ?>
                                                <th>Product Name</th>
                                                <th>Amount</th>
                                                <th class="text-right">Total Price</th>
                                                <th>Status</th>
                                                <th>Shipping Status</th>
                                                <th class="text-center">Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php include("inc/fetch_pending_orders.php"); ?>
                                            <?php foreach ($orders as $o): ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        $date = new DateTime($o['order_date']);
                                                        echo $date->format('F d, Y');
                                                        ?>
                                                    </td>
                                                    <?php if ($_SESSION['role'] == "Administrator" || $_SESSION['role'] == "Staff"): ?>
                                                        <td><?php echo $o['name']; ?></td>
                                                    <?php endif; ?>
                                                    <td><?php echo $o['product_name']; ?></td>
                                                    <td class="text-center"><?php echo $o['order_amount']; ?></td>
                                                    <td class="text-right">
                                                        ₱<?php echo number_format($o['order_bill_total'], 2); ?></td>
                                                    <td><?php echo $o['order_status']; ?></td>
                                                    <td><?php echo $o['shipping_status']; ?></td>
                                                    <td class="text-center footable-visible footable-last-column">
                                                        <div class="btn-group">
                                                            <a class="btn-warning btn btn-xs"
                                                                href="view-order.php?id=<?php echo $o['order_id']; ?>"><i
                                                                    class="fa-solid fa-eye"></i> </a>&nbsp;
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Date</th>
                                                <?php if ($_SESSION['role'] == "Administrator" || $_SESSION['role'] == "Staff"): ?>
                                                    <th>Customer Name</th>
                                                <?php endif; ?>
                                                <th>Product Name</th>
                                                <th>Amount</th>
                                                <th class="text-right">Total Price</th>
                                                <th>Status</th>
                                                <th>Shipping Status</th>
                                                <th class="text-center">Manage</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="https://kit.fontawesome.com/5a839d378a.js" crossorigin="anonymous"></script>
    <!-- Custom and plugin javascript -->
    <script src="assets/js/inspinia.js"></script>
    <script src="assets/js/plugins/pace/pace.min.js"></script>

    <script src="assets/js/plugins/dataTables/datatables.min.js"></script>
    <script>

        // Upgrade button class name
        $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

        $(document).ready(function () {
            $('.dataTables-orders').DataTable({
                pageLength: 10,
                order: [],
                responsive: true,
                fixedHeader: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy' },
                    { extend: 'csv' },
                    { extend: 'excel', title: 'Products' },
                    { extend: 'pdf', title: 'Products' },

                    {
                        extend: 'print',
                        customize: function (win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]

            });

        });

        $(document).ready(function () {
            $('.dataTables-completed-orders').DataTable({
                pageLength: 10,
                order: [],
                responsive: true,
                fixedHeader: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy' },
                    { extend: 'csv' },
                    { extend: 'excel', title: 'Products' },
                    { extend: 'pdf', title: 'Products' },

                    {
                        extend: 'print',
                        customize: function (win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]

            });

        });

    </script>


</body>

</html>