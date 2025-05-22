<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title>Manage Supply - QYEA Store</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="assets/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="assets/css/plugins/dropzone/dropzone.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body class="fixed-sidebar full-height-layout skin-2">
    <?php
    if (empty($_GET['id'])) {
        header("Location: /supplies-list");
    } else {
        include("inc/fetch_supp_details.php");
    }

    if (empty($supplyname)){
        header("Location: /supplies-list");
    }
    ?>

    <div id="wrapper">

        <?php if (session_status() !== PHP_SESSION_ACTIVE) {
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
                    <h2>Manage <?php echo $supplyname; ?> Stocks</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard">QYEA</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Supplies
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="view-product?id=<?php echo $p_id; ?>"><?php echo $supplyname; ?></a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Manage</strong>
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
                                <h5>Supply</h5>
                            </div>
                            <div class="ibox-content">
                                <form method="POST" action="inc/update_supply_stocks.php" enctype="multipart/form-data">


                                    <div class="form-group ">
                                        <div class="col-sm-12">
                                            <input type="number" placeholder="ID" id="supply_id" name="supply_id"
                                                class="form-control d-none" value="<?php echo $_GET['id']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-sm-12">
                                            <input type="text" placeholder="Name" id="name" name="name"
                                                class="form-control d-none" value="<?php echo $_SESSION['name']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <select class="form-control m-b" id="type" name="type" required>
                                                <option value="Add">Add Stock</option>
                                                <option value="Remove">Remove Stock</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-sm-12">
                                            <input type="number" placeholder="Amount" id="amount" name="amount"
                                                class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-sm-12">
                                            <input type="text" placeholder="Description" name="reason"
                                                class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12 d-flex justify-content-center">
                                            <button class="btn btn-primary btn-md" name="updateStockBtn"
                                                type="submit">Update</button>
                                        </div>
                                    </div>
                                </form>
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
    <script src="assets/js/plugins/bs-custom-file/bs-custom-file-input.min.js"></script>
    <script>
        $(document).ready(function () {

            bsCustomFileInput.init()
        });
    </script>
    <script>

        const stockType = document.getElementById('type');
        const stockAmount = document.getElementById('amount');
        const maxStock = <?php echo $stock; ?>;

        stockAmount.value = '';

        stockType.addEventListener('change', function () {
            if (this.value === 'Remove') {
                stockAmount.setAttribute('max', maxStock);
            } else {
                stockAmount.removeAttribute('max');
            }
        });
    </script>

</body>

</html>