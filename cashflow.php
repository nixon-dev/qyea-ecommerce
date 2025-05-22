<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title>Cashflow - QYEA Store</title>

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
                    <h2>Cashflow</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard">QYEA</a>
                        </li>
                        <li class="breadcrumb-item ">
                            Sales
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Cashflow</strong>
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
                                <h5>Cash Inflow</h5>
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
                                                <th>Description</th>
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
                                                <th class="text-right">Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php include("inc/fetch_cashflow.php"); ?>
                                            <?php foreach ($cashflow_inflow as $cfin) { ?>
                                                <tr data-type="INFLOW">
                                                    <td class="text-right">
                                                        <?php echo $cfin['year']; ?>
                                                    </td>
                                                    <td class="text-start">
                                                        <?php echo $cfin['description']; ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfin['january'], 1); ?>
                                                    </td>
                                                    <td >
                                                        <?php echo number_format($cfin['february'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfin['march'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfin['april'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfin['may'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfin['june'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfin['july'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfin['august'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfin['september'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfin['october'], decimals: 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfin['november'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfin['december'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfin['total'], 1); ?>
                                                    </td>
                                                    <td class="text-right footable-visible footable-last-column">
                                                        <div class="btn-group">
                                                            <a class="btn-info btn btn-xs" href="#"><i
                                                                    class="fa-solid fa-pencil"></i> </a>&nbsp;
                                                            <a class="btn-danger btn btn-xs" href="#"><i
                                                                    class="fa-regular fa-trash-can"></i> </a>
                                                        </div>
                                                    </td>

                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Year</th>
                                                <th>Description</th>
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
                                                <th class="text-right">Manage</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 d-none">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Cash Outflow</h5>
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
                                                <th>Description</th>
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
                                                <th class="text-right">Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php foreach ($cashflow_outflow as $cfout) { ?>

                                                <tr data-type="OUTFLOW">
                                                    <td>
                                                        <?php echo $cfout['year']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $cfout['description']; ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfout['january'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfout['february'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfout['march'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfout['april'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfout['may'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfout['june'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfout['july'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfout['august'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfout['september'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfout['october'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfout['november'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfout['december'], 1); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo number_format($cfout['total'], 1); ?>
                                                    </td>
                                                    <td class="text-right footable-visible footable-last-column">
                                                        <div class="btn-group">
                                                            <a class="btn-info btn btn-xs" href="#"><i
                                                                    class="fa-solid fa-pencil"></i> </a>&nbsp;
                                                            <a class="btn-danger btn btn-xs" href="#"><i
                                                                    class="fa-regular fa-trash-can"></i> </a>
                                                        </div>
                                                    </td>


                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Year</th>
                                                <th>Description</th>
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

    <!-- Custom and plugin javascript -->
    <script src="assets/js/inspinia.js"></script>
    <script src="assets/js/plugins/pace/pace.min.js"></script>
    <script src="https://kit.fontawesome.com/5a839d378a.js" crossorigin="anonymous"></script>

    <script src="assets/js/plugins/dataTables/datatables.min.js"></script>
    <script>

        // Upgrade button class name
        $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

        $(document).ready(function () {
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy' },
                    { extend: 'csv' },
                    { extend: 'excel', title: 'Supplies' },
                    { extend: 'pdf', title: 'Supplies' },

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