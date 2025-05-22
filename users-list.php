<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title>Users List - QYEA Store</title>

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
                    <h2>Users List</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard">QYEA</a>
                        </li>
                        <li class="breadcrumb-item ">
                            Users
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>List</strong>
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
                                <h5>Users</h5>
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
                                    <table class="table table-bordered table-hover nowrap dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Profile</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Roles</th>
                                                <th class="text-right">Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php include("inc/fetch_users.php"); ?>
                                            <?php foreach ($users as $u): ?>
                                                <tr>
                                                    <td>
                                                        <img loading="lazy" height="100" width="100"
                                                            style="object-fit: cover;"
                                                            src="assets/img/profile/<?php echo $u['profile']; ?>">
                                                    </td>
                                                    <td><?php echo $u['name']; ?></td>
                                                    <td><?php echo $u['email']; ?></td>
                                                    <td><?php echo $u['phone']; ?></td>
                                                    <td>
                                                        <?php if ($u['roles'] == "Administrator"): ?>
                                                            <span class="label label-danger">Administrator</span>
                                                        <?php elseif ($u['roles'] == "Staff"): ?>
                                                            <span class="label label-warning">Staff</span>
                                                        <?php else: ?>
                                                            <span class="label label-info">Customer</span>
                                                        <?php endif; ?>

                                                    </td>
                                                    <td class="text-right footable-visible footable-last-column">
                                                        <div class="btn-group">
                                                            <a class="btn-info btn btn-xs"
                                                                href="edit-users?id=<?php echo $u['user_id']; ?>"><i
                                                                    class="fa-solid fa-pencil"></i> </a>&nbsp;
                                                            <?php if ($u['roles'] == "Administrator" && $u['email'] == "admin@qyea.store"): ?>
                                                                <button class="btn-danger btn btn-xs"
                                                                    disabled><i class="fa-regular fa-trash-can"></i> </button>
                                                            <?php else: ?>
                                                                <a class="btn-danger btn btn-xs"
                                                                    href="inc/delete_users?id=<?php echo $u['user_id']; ?>"><i
                                                                        class="fa-regular fa-trash-can"></i> </a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Profile</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Roles</th>
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
                    { extend: 'excel', title: 'Users' },
                    { extend: 'pdf', title: 'Users' },

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