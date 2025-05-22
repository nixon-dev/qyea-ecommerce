<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title>Add Orders - QYEA Store</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="assets/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="assets/css/plugins/dropzone/dropzone.css" rel="stylesheet">
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
                    <h2>Add Walk-in Order</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard">QYEA</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Sales
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Add</strong>
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
                                <h5>Walk-in Order</h5>
                            </div>
                            <div class="ibox-content">
                                <form method="POST" action="inc/insert_order.php" enctype="multipart/form-data">


                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <select class="form-control m-b" name="customer" required>
                                                <?php include("inc/fetch_customers.php"); ?>
                                                <?php foreach ($customers as $c): ?>
                                                    <option value="<?php echo $c['user_id']; ?>">
                                                        <?php echo $c['name']; ?>&nbsp;(<?php echo $c['email']; ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <select class="form-control m-b" name="product" required>
                                                <?php include("inc/fetch_products.php"); ?>
                                                <?php foreach ($products as $p): ?>
                                                    <option value="<?php echo $p['product_id']; ?>">
                                                        <?php echo $p['product_name']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="number" placeholder="Amount" name="amount" id="amount"
                                                class="form-control" oninput="calculateTotal()"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="number" placeholder="Price (ea)" name="price" id="price"
                                                class="form-control" oninput="calculateTotal()"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '')" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" placeholder="Total Price" name="total_price"
                                                id="total_price" class="form-control" readonly>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-sm-12 d-flex justify-content-center">
                                            <button class="btn btn-primary btn-md" name="insertBtn" type="submit">Insert
                                                Order</button>
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

        function calculateTotal() {
            // Get the values from the amount and price fields
            const amount = parseFloat(document.getElementById('amount').value) || 0;
            const price = parseFloat(document.getElementById('price').value) || 0;

            // Compute the total price
            const totalPrice = amount * price;

            // Set the computed total price in the total_price field
            document.getElementById('total_price').value = totalPrice.toFixed(2);
        }
    </script>


</body>

</html>