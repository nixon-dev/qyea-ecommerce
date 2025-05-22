<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title>Add Product Stock - QYEA Store</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body class="fixed-sidebar full-height-layout skin-2">
    <?php
    if (empty($_GET['id'])) {
        header("Location: /products-list");
    } else {
        include("inc/fetch_prod_details.php");
    }

    if (empty($productname)) {
        header("Location: /products-list");
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
                    <h2>Manage <?php echo $productname; ?> Stocks</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard">QYEA</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Product
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="view-product?id=<?php echo $p_id; ?>"><?php echo $productname; ?></a>
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
                                <h5>Add Stock</h5>
                            </div>
                            <div class="ibox-content">
                                <form method="POST" action="inc/update_product_stocks.php"
                                    enctype="multipart/form-data">


                                    <div class="form-group ">
                                        <div class="col-sm-12">
                                            <input type="number" placeholder="ID" id="product_id" name="product_id"
                                                class="form-control d-none" value="<?php echo $_GET['id']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-sm-12">
                                            <input type="text" placeholder="Name" id="name" name="name"
                                                class="form-control d-none" value="<?php echo $_SESSION['name']; ?>"
                                                required>
                                        </div>
                                    </div>

                                    <div class="form-group d-none">
                                        <div class="col-sm-12">
                                            <select class="form-control m-b" id="type" name="type" required>
                                                <option value="Add" selected>Add Stock</option>
                                                <option value="Remove">Remove Stock</option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="form-group ">
                                        <div class="col-sm-12">
                                            <label class="form-label">Stock Amount</label>
                                            <input type="number" placeholder="Stock Amount" id="amount" name="amount"
                                                class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label class="form-label">Stock Type</label>
                                            <select class="form-control m-b" id="stock_type" name="stock_type" required>
                                                <option value="pcs" selected>pcs</option>
                                                <option value="kg">kg</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-sm-12">
                                            <label class="form-label">Price</label>
                                            <input type="number" placeholder="Price" id="price" name="price"
                                                class="form-control" step="0.001" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label class="form-label">Price Type</label>
                                            <select class="form-control m-b" id="price_type" name="price_type" required>
                                                <option value="per pcs" selected>per pcs</option>
                                                <option value="per kilo">per kilo</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" style="height: 100px"
                                                placeholder="Description" name="reason"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12 d-flex justify-content-center">
                                            <button class="btn btn-primary btn-md" id="updateStockBtn"
                                                name="updateStockBtn" type="submit">Update</button>
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

    <script>
        function disableButton() {
            // Disable the submit button
            document.getElementById('updateStockBtn').disabled = true;
        }
    </script>

</body>

</html>