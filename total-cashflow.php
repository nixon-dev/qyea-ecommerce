<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title>Total Cashflow - QYEA Store</title>

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
                    <h2>Total Cashflow</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard">QYEA</a>
                        </li>
                        <li class="breadcrumb-item ">
                            Sales
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Total</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                        <!-- <a href="" class="btn btn-primary">This is action area</a> -->
                    </div>
                </div>
            </div>

            <?php include("inc/fetch_supplies.php"); ?>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Cashflow</h5>
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
                                                <th>Year</th>
                                                <th>Jan.</th>
                                                <th>Feb.</th>
                                                <th>Mar.</th>
                                                <th>Apr.</th>
                                                <th>May</th>
                                                <th>Jun.</th>
                                                <th>Jul.</th>
                                                <th>Aug.</th>
                                                <th>Sep.</th>
                                                <th>Oct.</th>
                                                <th>Nov.</th>
                                                <th>Dec.</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php include("inc/fetch_totalcashflow.php"); ?>
                                            <?php foreach ($net_flow_data as $nf) { ?>

                                                <tr data-type="OUTFLOW">
                                                    <td>
                                                        <?php echo $nf['year']; ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($nf['January'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($nf['February'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($nf['March'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($nf['April'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($nf['May'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($nf['June'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($nf['July'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($nf['August'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($nf['September'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($nf['October'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($nf['November'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($nf['December'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($nf['Total'], 1); ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Year</th>
                                                <th>Jan.</th>
                                                <th>Feb.</th>
                                                <th>Mar.</th>
                                                <th>Apr.</th>
                                                <th>May</th>
                                                <th>Jun.</th>
                                                <th>Jul.</th>
                                                <th>Aug.</th>
                                                <th>Sep.</th>
                                                <th>Oct.</th>
                                                <th>Nov.</th>
                                                <th>Dec.</th>
                                                <th>Total</th>
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

    <!-- Custom and plugin javascript -->
    <script src="assets/js/inspinia.js"></script>
    <script src="assets/js/plugins/pace/pace.min.js"></script>
    <script src="https://kit.fontawesome.com/5a839d378a.js" crossorigin="anonymous"></script>


</body>

</html>