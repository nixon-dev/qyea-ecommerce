<!DOCTYPE html>
<html lang="en">

<?php include("inc/websettings_queries.php"); ?>
<?php include("inc/fetch_product_stock_details.php"); ?>
<?php if (empty($productname)) {
    header("Location: /shop.php");

}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title><?php echo $productname; ?> - QYEA Store</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="assets/css/plugins/bootstrapSocial/bootstrap-social.css" rel="stylesheet">

    <!-- Animation CSS -->
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/landing.css" rel="stylesheet">


    <link href="assets/css/plugins/slick/slick.css" rel="stylesheet">
    <link href="assets/css/plugins/slick/slick-theme.css" rel="stylesheet">
    <style>
        .star-rating {
            direction: rtl;
            /* Right-to-left for proper star alignment */
            font-size: 2rem;
            display: inline-flex;
            cursor: pointer;
        }

        .star-rating input[type="radio"] {
            display: none;
            /* Hide radio buttons */
        }

        .star-rating label {
            color: #ccc;
            /* Default star color */
            transition: color 0.3s;
        }

        /* Highlight checked stars */
        .star-rating input:checked~label {
            color: gold;
        }
    </style>

</head>

<body id="page-top" class="landing-page no-skin-config">
    <div class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-expand-md" role="navigation">
            <div class="container">
                <!-- <a class="navbar-brand" href="index">QYEA</a> -->
                <img src="assets/img/qyea.png" height="50">

                <div class="navbar-header page-scroll">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <?php include("base/landing_navbar.php"); ?>
                        <?php include("inc/fetch_cart_count.php"); ?>
                        <!-- <li><a class="nav-link" href="cart"><i
                                    class="fa-solid fa-cart-shopping"></i><sup><?php echo $cart; ?></sup></a>
                        </li> -->
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
                        <!-- <h1>Apples</h1> -->
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
                        <!-- <h1>Pears</h1> -->
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
                        <!-- <h1>Oranges</h1> -->
                    </div>
                </div>
                <div class="header-back two">
                    <img src="assets/img/backgrounds/<?php echo $shop3; ?>"
                        style="background: 50% 0 no-repeat; height: 400px; width: 100%; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>


    <section id="about" class="container about">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox product-detail">
                    <div class="ibox-content">
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
                            <div class="col-md-5">


                                <div class="product-images">

                                    <div>
                                        <img src="assets/img/products/<?php echo $pic; ?>"
                                            style="background: 50% 0 no-repeat; height: 350px; width: 100%; object-fit: cover;">
                                    </div>


                                </div>

                            </div>
                            <div class="col-md-7">

                                <h1 class="font-bold m-b-xs">
                                    <strong> <?php echo $productname; ?></strong>
                                </h1>
                                <div class="m-t-md">
                                    <h2 class="product-main-price">₱ <?php echo number_format($ps_price, 2); ?> /
                                        <?php echo $ps_price_type; ?>
                                    </h2>
                                </div>
                                <hr>

                                <h3>Product description</h3>

                                <div class=" text-muted">
                                    <?php echo $desc; ?>
                                </div>
                                <dl class="medium m-t-md">
                                    <dt>Date: </dt>
                                    <dd>
                                        <?php
                                        $date = new DateTime($psdate);
                                        echo $date->format('F d, Y - h:i A');
                                        ?>
                                    </dd>
                                    <dt>Stocks: </dt>
                                    <dd><?php echo $ps_stock; ?></dd>
                                    <dt>Stock Type:</dt>
                                    <dd><?php echo $ps_stock_type; ?></dd>
                                    <dt>Sold: </dt>
                                    <dd><?php echo $sold; ?></dd>
                                </dl>
                                <hr>

                                <div class="row">
                                    <form method="POST" action="inc/cart.php">
                                        <input type="text" id="product-name" name="product-name"
                                            class="form-control d-none" value="<?php echo $productname; ?>">
                                        <input type="number" id="product-id" name="product-id"
                                            class="form-control d-none"
                                            value="<?php echo number_format($product_id); ?>">
                                        <input type="number" id="product-stock-id" name="product-stock-id"
                                            class="form-control d-none" value="<?php echo number_format($ps_id); ?>">


                                        <input type="number" id="product-price" name="product-price"
                                            class="form-control d-none" value="<?php echo number_format($ps_price); ?>">
                                        <div class="col-sm-12 mb-3">
                                            <div class="input-group">
                                                <input type="number" id="product-amount" name="product-amount"
                                                    class="form-control text-center" value="1"
                                                    max="<?php echo $stock; ?>" min="1" style="width: 150px;">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 mb-3">
                                            <button type="submit" class="btn btn-primary btn-sm w-100"><i
                                                    class="fa fa-cart-plus"></i> Add to cart</button>
                                        </div>
                                    </form>

                                </div>



                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <?php include("inc/fetch_product_reviews.php"); ?>
            <div class="col-sm-12 row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-dark"><strong>Customer reviews</strong></h3>
                            <?php $aveRating = number_format($averageRating); ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="star-rating">
                                        <input type="radio" <?= ($aveRating == 5) ? 'checked' : '' ?> disabled>
                                        <label for="star5">&#9733;</label>

                                        <input type="radio" <?= ($aveRating == 4) ? 'checked' : '' ?> disabled>
                                        <label for="star4">&#9733;</label>

                                        <input type="radio" <?= ($aveRating == 3) ? 'checked' : '' ?> disabled>
                                        <label for="star3">&#9733;</label>

                                        <input type="radio" <?= ($aveRating == 2) ? 'checked' : '' ?> disabled>
                                        <label for="star2">&#9733;</label>

                                        <input type="radio" <?= ($aveRating == 1) ? 'checked' : '' ?> disabled>
                                        <label for="star1">&#9733;</label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <p class="text-dark">
                                        <strong><?php echo number_format($averageRating, 1); ?></strong> out of
                                        <strong>5.0</strong></p>
                                    <p><?php echo $totalReviews; ?> total ratings</p>
                                </div>
                            </div>
                        </div>





                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-dark"><strong>Customer Reviews</strong></h3>
                            <br>

                            <?php
                            function time_ago($datetime)
                            {
                                $interval = date_diff(date_create($datetime), date_create());

                                $hours = $interval->h;
                                $minutes = $interval->i;
                                $days = $interval->d;
                                $months = $interval->m;
                                $years = $interval->y;

                                if ($years > 0) {
                                    if ($years == 1) {
                                        return "one year ago";
                                    } else {
                                        return "$years years ago";
                                    }
                                } elseif ($months > 0) {
                                    if ($months == 1) {
                                        return "one month ago";
                                    } else {
                                        return "$months months ago";
                                    }
                                } elseif ($days > 0) {
                                    if ($days == 1) {
                                        return "Yesterday";
                                    } else {
                                        return "$days days ago";
                                    }
                                } elseif ($hours > 0) {
                                    if ($hours == 1) {
                                        return "an hour ago";
                                    } else {
                                        return "$hours hours ago";
                                    }
                                } elseif ($minutes > 0) {
                                    if ($minutes == 1) {
                                        return "a minute ago";
                                    } else {
                                        return "$minutes minutes ago";
                                    }

                                } else {
                                    return "just now";
                                }
                            }
                            ?>
                            <?php foreach ($reviews as $r): ?>
                                <div class="row mb-4">
                                    <div class="col-sm-3 ">
                                        <div class=" d-flex justify-content-center">
                                            <img id="preview" src="assets/img/profile/<?php echo $r['profile']; ?>"
                                                class="rounded-circle circle-border m-b-md" alt="profile"
                                                style="width: 100px; height: 100px; object-fit: cover; border: 3px solid grey;">
                                        </div>
                                        <div class="star-rating  d-flex justify-content-center">
                                            <input type="radio" <?= ($r['r_rating'] == 5) ? 'checked' : '' ?> disabled>
                                            <label for="star5">&#9733;</label>

                                            <input type="radio" <?= ($r['r_rating'] == 4) ? 'checked' : '' ?> disabled>
                                            <label for="star4">&#9733;</label>

                                            <input type="radio" <?= ($r['r_rating'] == 3) ? 'checked' : '' ?> disabled>
                                            <label for="star3">&#9733;</label>

                                            <input type="radio" <?= ($r['r_rating'] == 2) ? 'checked' : '' ?> disabled>
                                            <label for="star2">&#9733;</label>

                                            <input type="radio" <?= ($r['r_rating'] == 1) ? 'checked' : '' ?> disabled>
                                            <label for="star1">&#9733;</label>
                                        </div>

                                    </div>
                                    <div class="col-sm-8">
                                        <h3 class="text-dark"><strong><?php echo $r['name']; ?></strong> </h3>

                                        <p><?php echo time_ago($r['timestamp']); ?></p>

                                        <h4><?= htmlspecialchars($r['r_comments']); ?></h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>


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
                    <h1>Company Bio</h1>
                    <p class="text-white">Quirino Young Entrepreneurs Association is an association organized purposely
                        to establish income
                        generating projects for the students. They are manufacturer of fruit wines and fruit juices in
                        different variants. As of now, they are also engaged in Soya butterscotch, Peanut butterscotch
                        and
                        Soya pandesal manufacturing.</p>
                </div>
                <div class="col-sm-4 text-white">
                    <h1>Contact Us</h1>
                    <address>
                        <strong><span class="navy text-white">Quirino Youth Entrepreneurs
                                Association</span></strong><br />
                        Andres Bonifacio,<br />
                        Diffun, Quirino<br />
                        <abbr title="Phone">Phone:</abbr> 0960xxxxxxx<br />
                        <abbr email="Email">Email:</abbr> admin@qyea.store
                    </address>
                </div>
                <div class="col-sm-4 text-white">
                    <h1>Connect</h1>



                    <a href="" class="btn btn-social-icon btn-facebook"><span class="fa fa-facebook"></span></a>

                    <a href="" class="btn btn-social-icon btn-twitter"><span class="fa fa-twitter"></span></a>

                    <a href="" class="btn btn-social-icon btn-google"><span class="fa fa-google"></span></a>

                    <a href="" class="btn btn-social-icon btn-instagram"><span class="fa fa-instagram"></span></a>


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
    <!-- slick carousel-->
    <script src="assets/js/plugins/slick/slick.min.js"></script>
    <script src="https://kit.fontawesome.com/5a839d378a.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $('.product-images').slick({
                dots: true
            });

        });

    </script>


    <script>

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

    <script>
        const input = document.getElementById('product-amount');
        const btnPlus = document.getElementById('btn-plus');
        const btnMinus = document.getElementById('btn-minus');

        btnPlus.addEventListener('click', () => {
            input.value = parseInt(input.value) + 1;
        });

        btnMinus.addEventListener('click', () => {
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        });

        const productAmountInput = document.getElementById('product-amount');
        const maxStock = <?php echo $stock; ?>;

        function handleInputChange() {
            const inputValue = parseInt(productAmountInput.value);
            const inputPrice = parseFloat(productPriceInput.value);

            if (inputValue > maxStock) {
                productAmountInput.setCustomValidity(`Quantity exceeds available stock (${maxStock})`);
                productAmountInput.reportValidity();
                productAmountInput.value = maxStock;
            } else {
                productAmountInput.setCustomValidity('');
            }

        }

        btnPlus.addEventListener('click', handleInputChange);
        btnMinus.addEventListener('click', handleInputChange);
        productAmountInput.addEventListener('input', handleInputChange);
    </script>
</body>

</html>