<!DOCTYPE html>
<html lang="en">
<?php include("inc/websettings_queries.php"); ?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title>Cart - QYEA Store</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/plugins/bootstrapSocial/bootstrap-social.css" rel="stylesheet">
    <link href="assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <link href="assets/css/plugins/bootstrapSocial/bootstrap-social.css" rel="stylesheet">

    <!-- Animation CSS -->
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/landing.css" rel="stylesheet">

</head>

<?php include("inc/fetch_cart_count.php"); ?>

<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];

    $checkQuery = "SELECT * FROM shipping_address WHERE user_id = ?";
    if ($checkStmt = mysqli_prepare($link, $checkQuery)) {
        mysqli_stmt_bind_param($checkStmt, "i", $user_id);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);

        if (mysqli_stmt_num_rows($checkStmt) > 0) {

        } else {
            $msg = "You must add Shipping Address";
            header("Location: ../shipping-address?error=" . urlencode($msg));
            exit();
        }

    }
} else {
    $msg = "You must login first";
    header("Location: ../login?error=" . urlencode($msg));
    exit();
}

?>



<body id="page-top" class="landing-page no-skin-config">
    <div class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-fixed-top navbar-expand-md" role="navigation">
            <div class="container">
                <a class="navbar-brand" href="index">QYEA</a>
                <div class="navbar-header page-scroll">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <?php include("base/landing_navbar.php"); ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div id="inSlider" class="carousel slide" data-ride="carousel" data-bs-interval="3000" style="height: 400px">

        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <div class="container ">
                    <div class="carousel-caption d-none d-sm-block">
                        <h1>Apples</h1>
                        <!-- <p>Fresh</p> -->
                    </div>
                </div>
                <div class="header-back one">
                    <img src="assets/img/backgrounds/<?php echo $shop1; ?>"
                        style="background: 50% 0 no-repeat; height: 400px; width: 100%; object-fit: cover;">
                </div>

            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Pears</h1>
                    </div>
                </div>
                <div class="header-back two">
                    <img src="assets/img/backgrounds/<?php echo $shop2; ?>"
                        style="background: 50% 0 no-repeat; height: 400px; width: 100%; object-fit: cover;">
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Oranges</h1>
                    </div>
                </div>
                <div class="header-back two">
                    <img src="assets/img/backgrounds/<?php echo $shop3; ?>"
                        style="background: 50% 0 no-repeat; height: 400px; width: 100%; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
    </div>


    <section id="about" class="container about">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="wrapper wrapper-content animated fadeInRight">

                    <div class="row">
                        <div class="col-md-9">

                            <?php if (!empty($_GET['error'])): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $_GET['error']; ?>
                                </div>
                            <?php elseif (!empty($_GET['message'])): ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo $_GET['message']; ?>
                                </div>
                            <?php endif; ?>


                            <div class="ibox">
                                <div class="ibox-title">
                                    <span class="float-right">(<strong><?php echo $cart; ?></strong>)
                                        items</span>
                                    <h5>Items in your cart</h5>
                                </div>



                                <?php foreach ($cartItems as $c): ?>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table shoping-cart-table">
                                                <tbody>
                                                    <tr>
                                                        <td width="90">
                                                            <img src="assets/img/products/<?php echo $c['product_picture']; ?>"
                                                                style="height: 90px; width: 90px; object-fit: cover;">
                                                        </td>
                                                        <td class="desc">
                                                            <h3>
                                                                <a href="#" class="text-navy">
                                                                    <?php echo $c['product_name']; ?>
                                                                </a>
                                                            </h3>
                                                            <p class="small">
                                                                <?php echo $c['product_description']; ?>
                                                            </p>

                                                            <div class="m-t-sm">
                                                                <form method="GET" action="inc/remove_from_cart.php">
                                                                    <input type="hidden" name="product-id"
                                                                        value="<?php echo $c['order_id']; ?>">
                                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                                            class="fa fa-trash"> </i> Remove Item</button>
                                                                </form>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <p class="text-dark">
                                                                <strong>₱<?php echo number_format($c['ps_price'], 2); ?></strong>
                                                            </p>
                                                            <s
                                                                class="small text-muted">₱<?php echo (number_format($c['ps_price'] + ($c['ps_price'] * 0.35))) ?></s>
                                                        </td>
                                                        <td width="65">
                                                            <input type="text" class="form-control"
                                                                value="<?php echo $c['order_amount']; ?>" readonly>
                                                        </td>
                                                        <td>
                                                            <h4>
                                                                ₱<?php echo number_format($c['order_bill_total'], 2); ?>
                                                            </h4>
                                                        </td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                <?php endforeach; ?>




                            </div>

                        </div>
                        <div class="col-md-3">

                            <div class="ibox">
                                <div class="ibox-title">
                                    <h5>Cart Summary</h5>
                                </div>
                                <div class="ibox-content">
                                    <span>
                                        Total
                                    </span>
                                    <h2 class="font-bold">
                                        ₱ <?php echo number_format($totalprice, 2); ?>
                                    </h2>

                                    <hr />

                                    <div class="m-t-sm">
                                        <div class="btn-group">
                                            <form method="POST" action="inc/update_order.php"
                                                enctype="multipart/form-data">

                                                <div class="row">
                                                    <?php if (empty($cartItems)): ?>
                                                    <?php else: ?>
                                                        <?php foreach ($cartItems as $c): ?>
                                                            <div class="col-sm-12 mb-3 d-none">
                                                                <input type="number" value="<?php echo $c['order_id']; ?>"
                                                                    name="order_id[]">
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>

                                                    <div class="form-group mb-3"
                                                        style="padding-left: 15px; padding-right: 15px;">
                                                        <label class="text-grey">GCASH Payment (Temporary)</label>
                                                        <p>Pay +639602747990, and screenshot proof.</p>

                                                        <img src="assets/img/gcash.png" loading="lazy" height="auto"
                                                            width="150px">

                                                        <p class="text-center">GCash QR Code</p>

                                                        <div class="custom-file col-sm-12">
                                                            <input name="proof" id="proof" type="file"
                                                                class="custom-file-input"
                                                                accept="image/jpeg, image/png, image/webp" required
                                                                oninvalid="this.setCustomValidity('Upload your GCASH Payment Screenshot')"
                                                                oninput="this.setCustomValidity('')" />
                                                            <label class="custom-file-label">Upload Proof</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 mb-3">
                                                        <label class="form-label">Reference #</label>
                                                        <input name="reference" id="reference" type="text"
                                                            class="form-control" required
                                                            oninvalid="this.setCustomValidity('Enter reference number in your payment reciept')"
                                                            oninput="this.setCustomValidity('')" />
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <button type="submit" id="updateOrderBtn" name="updateOrderBtn"
                                                            class="btn btn-primary w-100"><i
                                                                class="fa fa-shopping-cart"></i>
                                                            Checkout</>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ibox">
                                <div class="ibox-title">
                                    <h5>Support</h5>
                                </div>
                                <div class="ibox-content text-center">



                                    <h3><i class="fa fa-phone"></i> +63 960 274 7990</h3>
                                    <span class="small">
                                        Please contact with us if you have any questions. We are avalible 24h.
                                    </span>


                                </div>
                            </div>



                        </div>
                    </div>

                </div>
            </div>
    </section>








    <section id="contact" class="green-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 text-white">
                    <h1><?php echo $bio_title; ?></h1>
                    <p class="text-white"><?php echo $bio_context; ?></p>
                </div>
                <div class="col-sm-4 text-white">
                    <h1>Contact Us</h1>
                    <address>
                        <strong><span class="navy text-white"><?php echo $title; ?></span></strong><br />
                        <?php echo $location; ?><br />
                        <?php echo $contact_1; ?><br />
                        <?php echo $contact_2; ?><br />
                        <?php echo $contact_3; ?><br />
                        <?php echo $contact_4; ?><br />
                    </address>
                </div>
                <div class="col-sm-4 text-white">
                    <h1>Connect</h1>



                    <a href="<?php echo $facebook; ?>" class="btn btn-social-icon btn-facebook"><span
                            class="fa fa-facebook"></span></a>

                    <a href="<?php echo $twitter; ?>" class="btn btn-social-icon btn-twitter"><span
                            class="fa fa-twitter"></span></a>

                    <a href="<?php echo $youtube; ?>" class="btn btn-social-icon btn-google"><span
                            class="fa fa-youtube"></span></a>

                    <a href="<?php echo $instagram; ?>" class="btn btn-social-icon btn-instagram"><span
                            class="fa fa-instagram"></span></a>
                </div>
            </div>
        </div>

    </section>


    <!-- Mainly scripts -->
    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="assets/js/inspinia.js"></script>
    <script src="assets/js/plugins/pace/pace.min.js"></script>
    <script src="assets/js/plugins/wow/wow.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

    <script>

        $(document).ready(function () {
            bsCustomFileInput.init()
        })

        $(document).ready(function () {

            $('body').scrollspy({
                target: '#navbar',
                offset: 80
            });

            // Page scrolling feature
            $('a.page-scroll').bind('click', function (event) {
                var link = $(this);
                $('html, body').stop().animate({
                    scrollTop: $(link.attr('href')).offset().top - 50
                }, 500);
                event.preventDefault();
                $("#navbar").collapse('hide');
            });
        });

        var cbpAnimatedHeader = (function () {
            var docElem = document.documentElement,
                header = document.querySelector('.navbar-default'),
                didScroll = false,
                changeHeaderOn = 200;
            function init() {
                window.addEventListener('scroll', function (event) {
                    if (!didScroll) {
                        didScroll = true;
                        setTimeout(scrollPage, 250);
                    }
                }, false);
            }
            function scrollPage() {
                var sy = scrollY();
                if (sy >= changeHeaderOn) {
                    $(header).addClass('navbar-scroll')
                }
                else {
                    $(header).removeClass('navbar-scroll')
                }
                didScroll = false;
            }
            function scrollY() {
                return window.pageYOffset || docElem.scrollTop;
            }
            init();

        })();

        // Activate WOW.js plugin for animation on scrol
        new WOW().init();

    </script>

</body>

</html>