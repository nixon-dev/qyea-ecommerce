<!DOCTYPE html>
<html>

<?php
if (empty($_GET['id'])) {
    header("Location: /pending-orders");
} else {
    include("inc/fetch_order_details.php");
}
if (empty($productname)) {
    header("Location: /pending-orders");
}
?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title>View Order - QYEA Store</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">

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
                    <h2>View Order</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard">QYEA</a>
                        </li>
                        <li class="breadcrumb-item">
                            Sales
                        </li>
                        <li class="breadcrumb-item">
                            <a href="orders">Orders</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>View</strong>
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
                    <div class="col-md-6">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <?php if (!empty($proof)): ?>
                                    <h5>Receipt</h5>
                                <?php else: ?>
                                    <h5>No Receipt</h5>
                                <?php endif; ?>
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


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Order</h5>
                            </div>
                            <div class="ibox-content">
                                <h3><strong>Order Status:</strong> <?php echo $status; ?></h3>
                                <h3><strong>Shipping Status:</strong> <?php echo $ship; ?></h3>

                                <?php if ($status == 'Pending' && $_SESSION['role'] != "Customer"): ?>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6 d-flex justify-content-end">
                                            <form method="POST" action="inc/accept_order"
                                                class="col-sm-12  d-flex justify-content-end">
                                                <input name="orderId" value="<?php echo $o_id; ?>" class="d-none">
                                                <input name="orderAmount" value="<?php echo number_format($amount); ?>"
                                                    class="d-none">
                                                <input name="orderPSid" value="<?php echo $ps_id; ?>" class="d-none">
                                                <input name="orderProductId" value="<?php echo $product_id; ?>"
                                                    class="d-none">
                                                <button class="btn btn-sm btn-success btn-block"
                                                    name="acceptOrderBtn">Accept Order</button>
                                            </form>
                                        </div>
                                        <div class="col-sm-6 d-flex justify-content-start">
                                            <button type="button" class="btn btn-danger  btn-block" data-bs-toggle="modal"
                                                data-bs-target="#rejectModal">
                                                Reject Order
                                            </button>
                                        </div>
                                    </div>

                                <?php endif; ?>

                                <?php if ($status != 'Canceled' && $status != 'Completed' && $rejected == 'False' && $_SESSION['id'] == $user_id && $_SESSION['role'] == 'Customer'): ?>
                                    <!-- $status IS NOT IN (Canceled, Completed) AND NOT Rejected -->
                                    <br>
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <button data-bs-toggle="modal" data-bs-target="#confirmDelete"
                                            class="btn btn-danger btn-sm btn-block w-50">Cancel Order</button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Confirmation Modal -->
            <div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteLabel">Confirm Cancelation</h5>
                            <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                    class="fa fa-times" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to cancel this order?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <a href="inc/cancel_order?id=<?php echo $o_id; ?>" id="confirmDelete"
                                class="btn btn-danger">Cancel Order</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Reject Order</h1>
                        </div>
                        <div class="modal-body">
                            <form class="user needs-validation" action="inc/reject_order_reason.php" method="POST"
                                needs-validation>

                                <input value="<?php echo $o_id; ?>" name="orderId" class="d-none">

                                <div class="form-group has-validation">
                                    <textarea type="text" class="form-control" id="InputReason" name="InputReason"
                                        placeholder="Rejection Reason" required></textarea>
                                </div>



                                <button class="btn btn-primary w-100 btn-block" type="submit" id="rejectBtn"
                                    name="rejectBtn">Reject</button>
                                <br>
                            </form>


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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="assets/js/inspinia.js"></script>
    <script src="assets/js/plugins/pace/pace.min.js"></script>



</body>

</html>