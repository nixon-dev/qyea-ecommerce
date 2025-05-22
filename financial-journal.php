<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title>Financial Journal - QYEA Store</title>

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
                    <h2>Financial Journal</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard">QYEA</a>
                        </li>
                        <li class="breadcrumb-item">
                            Finance
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Journal</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                        <!-- <a href="" class="btn btn-primary">This is action area</a> -->
                    </div>
                </div>
            </div>

            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Finance</h5>
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
                                        class="table table-striped table-bordered table-hover nowrap dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Description</th>
                                                <th>Receipt Number</th>
                                                <th>Cash Receipt</th>
                                                <th>Amounts Receievable</th>
                                                <th>Cash Exp.</th>
                                                <th>Account Payable</th>
                                                <th>Cash Balance</th>
                                                <th>Non Cash Balance</th>
                                                <th class="text-right">Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php include("inc/fetch_financial.php"); ?>
                                            <?php foreach ($finances as $f): ?>
                                                <tr>
                                                    <td><?php echo $f['date']; ?></td>
                                                    <td><?php echo $f['description']; ?></td>
                                                    <td><?php echo $f['reference_number']; ?></td>
                                                    <td><?php echo $f['cash_receipt']; ?></td>
                                                    <td><?php echo $f['accounts_receivable']; ?></td>
                                                    <td><?php echo $f['cash_exp']; ?></td>
                                                    <td><?php echo $f['accounts_payable']; ?></td>
                                                    <td><?php echo $f['cash_balance']; ?></td>
                                                    <td><?php echo $f['non_cash_balance']; ?></td>
                                                    <td class="text-right footable-visible footable-last-column">
                                                        <div class="btn-group">
                                                            <a class="btn-info btn btn-xs"
                                                                href="edit-users?id=<?php echo $u['user_id']; ?>"><i
                                                                    class="fa-solid fa-pencil"></i> </a>&nbsp;
                                                            <a class="btn-danger btn btn-xs"
                                                                href="inc/delete_users?id=<?php echo $u['user_id']; ?>"><i
                                                                    class="fa-regular fa-trash-can"></i> </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Date</th>
                                                <th>Description</th>
                                                <th>Receipt Number</th>
                                                <th>Cash Receipt</th>
                                                <th>Amounts Receievable</th>
                                                <th>Cash Exp.</th>
                                                <th>Account Payable</th>
                                                <th>Cash Balance</th>
                                                <th>Non Cash Balance</th>
                                                <th class="text-right">Manage</th>
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
    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="https://kit.fontawesome.com/5a839d378a.js" crossorigin="anonymous"></script>
    <!-- Custom and plugin javascript -->
    <script src="assets/js/inspinia.js"></script>
    <script src="assets/js/plugins/pace/pace.min.js"></script>


</body>

</html>