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

    <title>View Order - QYEA Store</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <style>
        .star-rating {
            direction: rtl;
            /* Right-to-left for easier handling of hover effect */
            display: inline-flex;
            font-size: 2rem;
        }

        .star-rating input[type="radio"] {
            display: none;
            /* Hide radio buttons */
        }

        .star-rating label {
            color: #ccc;
            cursor: pointer;
            transition: color 0.2s;
        }

        .star-rating input:checked~label,
        .star-rating label:hover,
        .star-rating label:hover~label {
            color: gold;
            /* Highlight stars */
        }
    </style>

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
                    <h2>View Completed Order</h2>
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
                        <li class="breadcrumb-item">
                            <a href="orders">Completed</a>
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
                                <h5>Receipt</h5>
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
                                    <h5>Email: <?php echo $email; ?></h5>
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
                                <h3><strong>Order Status:</strong> Completed </h3>
                                <h3><strong>Shipping Status:</strong> Delivered </h3>
                            </div>

                        </div>

                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Write a Review</h5>
                            </div>
                            <div class="ibox-content">
                                <?php include("inc/fetch_customer_review.php"); ?>
                                <form id="rating-form" method="POST" action="inc/insert_review.php">

                                    <input name="user_id" value="<?php echo $_SESSION['id']; ?>" class="d-none"
                                        readonly>
                                    <input name="order_id" value="<?php echo $o_id; ?>" class="d-none" readonly>
                                    <input name="product_id" value="<?php echo $product_id; ?>" class="d-none" readonly>

                                    <?php if (empty($r_rating)): ?>
                                        <?php $r_rating = 0; ?>
                                    <?php endif; ?>
                                    <div class="star-rating">
                                        <input type="radio" id="star5" name="rating" value="5" <?= ($r_rating == 5) ? 'checked' : '' ?>>
                                        <label for="star5">&#9733;</label>

                                        <input type="radio" id="star4" name="rating" value="4" <?= ($r_rating == 4) ? 'checked' : '' ?>>
                                        <label for="star4">&#9733;</label>

                                        <input type="radio" id="star3" name="rating" value="3" <?= ($r_rating == 3) ? 'checked' : '' ?>>
                                        <label for="star3">&#9733;</label>

                                        <input type="radio" id="star2" name="rating" value="2" <?= ($r_rating == 2) ? 'checked' : '' ?>>
                                        <label for="star2">&#9733;</label>

                                        <input type="radio" id="star1" name="rating" value="1" <?= ($r_rating == 1) ? 'checked' : '' ?>>
                                        <label for="star1">&#9733;</label>
                                    </div>
                                    <div id="error-message" style="color: red; display: none;"><strong>Please select a
                                            rating.</strong>
                                    </div>


                                    <?php if (!empty($r_comments)): ?>
                                        <textarea class="form-control mb-4" placeholder="Leave a review here"
                                            id="reviewTextarea" name="reviewTextarea"
                                            style="height: 100px"><?= htmlspecialchars(trim($r_comments)); ?></textarea>
                                    <?php else: ?>
                                        <textarea class="form-control mb-4" placeholder="Leave a review here"
                                            id="reviewTextarea" name="reviewTextarea" style="height: 100px"></textarea>
                                    <?php endif; ?>
                                    <button class="btn btn-success w-100" type="submit" name="reviewBtn">Submit</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="assets/js/inspinia.js"></script>
    <script src="assets/js/plugins/pace/pace.min.js"></script>

    <script>
        document.getElementById('rating-form').addEventListener('submit', function (event) {
            // Check if any radio button is selected
            const ratingSelected = document.querySelector('input[name="rating"]:checked');

            if (!ratingSelected) {
                event.preventDefault(); // Prevent form submission
                document.getElementById('error-message').style.display = 'block'; // Show error message
            } else {
                document.getElementById('error-message').style.display = 'none'; // Hide error message if a rating is selected
            }
        });
    </script>


</body>

</html>