<!DOCTYPE html>
<html>

<?php
if (empty($_GET['id'])) {
    header("Location: /orders");
} else {
    include("inc/fetch_order_details.php");
}

if (empty($productname)) {
    header("Location: /orders");
}
?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title>Manage Order - QYEA Store</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body class="fixed-sidebar full-height-layout skin-2">

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
                    <h2>Manage Order</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard">QYEA</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Orders
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="orders">List</a>
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
                    <div class="col-md-4">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Order Detail</h5>
                            </div>
                            <div>
                                <?php if (!empty($proof)): ?>
                                    <div class="ibox-content no-padding border-left-right">
                                        <img alt="image" class="img-fluid" src="assets/img/proofs/<?php echo $proof; ?>"
                                            style="height: 100%; width: 100%; oject-fit: cover;">
                                    </div>
                                <?php endif; ?>
                                <div class="ibox-content profile-content">
                                    <h5>Reference #: <strong><?php echo $reference; ?></strong></h5>
                                    <h3><strong><?php echo $productname; ?></strong></h3>
                                    <h5>Amount: <?php echo number_format($amount); ?></h5>
                                    <h5>Price: ₱<?php echo number_format($price); ?></h5>
                                    <h5>Total Bill: ₱<?php echo number_format($total); ?></h5>

                                    <h5>Customer: <?php echo $customer; ?></h5>
                                    <h5>Email: <?php echo $customeremail; ?></h5>
                                    <h5>Phone: <?php echo $phone; ?></h5>
                                    <?php if ($manual == "True"): ?>
                                        <h5>Order Type: Manual</h5>
                                    <?php endif; ?>

                                    <br><br>
                                    <h3>Shipping Address</h3>
                                    <h5>Street: <?php echo $street; ?></h5>
                                    <h5>Town: <?php echo $town; ?></h5>
                                    <h5>Province: <?php echo $province; ?></h5>
                                    <h5>Instruction: <?php echo $instruction; ?></h5>



                                    <!-- <div class="user-button">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="inc/reject_order.php?id=<?php echo $o_id; ?>"
                                                    class="btn btn-danger btn-sm btn-block">Reject Order</a>
                                            </div>
                                        </div>
                                    </div> -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Order</h5>
                            </div>
                            <div class="ibox-content">
                                <form method="POST" action="inc/update_order_status.php" enctype="multipart/form-data">


                                    <div class="form-group ">
                                        <!-- ID -->
                                        <div class="col-sm-12">
                                            <input type="number" id="order_id" name="order_id"
                                                class="form-control d-none" value="<?php echo $_GET['id']; ?>" required>
                                        </div>

                                        <!-- Product Name  -->
                                        <div class="col-sm-12">
                                            <input type="text" id="product_name" name="product_name"
                                                class="form-control d-none" value="<?php echo $productname; ?>"
                                                required>
                                        </div>

                                        <!-- Total Bill  -->
                                        <div class="col-sm-12">
                                            <input type="text" id="total_bill" name="total_bill"
                                                class="form-control d-none" value="<?php echo $total; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label>Order Status</label>
                                            <select class="form-control m-b" id="order_status" name="order_status"
                                                required>
                                                <option value="Processing" <?php echo ($status == "Processing") ? "selected" : ""; ?>>Processing</option>
                                                <option value="Completed" id="completedOption" <?php echo ($status == "Completed") ? "selected" : ""; ?>>Completed</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label>Shipping Status</label>
                                            <select class="form-control m-b" id="shipping_status" name="shipping_status"
                                                required onchange="toggleOrderStatus()">
                                                <option value="In Warehouse" <?php echo ($ship == "In Warehouse") ? "selected" : ""; ?>>In Warehouse</option>
                                                <option value="Shipped" <?php echo ($ship == "Shipped") ? "selected" : ""; ?>>Shipped</option>
                                                <option value="In Transit" <?php echo ($ship == "In Transit") ? "selected" : ""; ?>>In Transit</option>
                                                <option value="Out for Delivery" <?php echo ($ship == "Out for Delivery") ? "selected" : ""; ?>>Out for Delivery</option>
                                                <option value="Delivered" <?php echo ($ship == "Delivered") ? "selected" : ""; ?>>Delivered</option>
                                            </select>
                                        </div>
                                    </div>


                                    <?php if ($status != "Completed"): ?>
                                        <div class="form-group row">
                                            <div class="col-sm-12 d-flex justify-content-center">
                                                <button class="btn btn-primary btn-md" name="updateOrderBtn"
                                                    type="submit">Update</button>
                                            </div>
                                        </div>
                                    <?php endif; ?>
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
        function toggleOrderStatus() {
            const shippingSelect = document.getElementById('shipping_status');
            const completedOption = document.getElementById('completedOption');


            if (shippingSelect.value === 'Delivered') {
                completedOption.disabled = false;  // Enable the secondary select
            } else {
                completedOption.disabled = true;   // Disable the secondary select

                // Optional: reset selection if "Completed" was previously selected
                const orderStatus = document.getElementById('order_status');
                if (orderStatus.value === 'Completed') {
                    orderStatus.value = 'Processing';
                }
            }
        }

        window.onload = toggleOrderStatus;
    </script>


</body>

</html>