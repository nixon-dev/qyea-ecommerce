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

    <title>Shop - QYEA Store</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/plugins/bootstrapSocial/bootstrap-social.css" rel="stylesheet">
    <link href="assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">


    <!-- Animation CSS -->
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/landing.css" rel="stylesheet">

</head>

<body id="page-top" class="landing-page no-skin-config">
    <div class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-fixed-top navbar-expand-md" role="navigation">
            <div class="container">
                <!-- <a class="navbar-brand" href="/">QYEA</a> -->
                <img src="assets/img/qyea.png" height="50">

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


    <section id="shop" class="container about">
        <div class="row">
            <div class="col-sm-12 col-md-3">
                <h1 class="text-left">Filter</h1>

                <form id="sort-form" method="POST">
                    <div class="form-group">
                        <div class="">
                            <select class="form-control m-b" name="sort" id="sort">
                                <option value="" disabled selected>Sort by</option>
                                <option value="price_asc" <?php if (isset($_POST['sort']) && $_POST['sort'] == 'price_asc')
                                    echo 'selected'; ?>>Price: Low to High</option>
                                <option value="price_desc" <?php if (isset($_POST['sort']) && $_POST['sort'] == 'price_desc')
                                    echo 'selected'; ?>>Price: High to Low</option>
                                <option value="sold_asc" <?php if (isset($_POST['sort']) && $_POST['sort'] == 'sold_asc')
                                    echo 'selected'; ?>>Sold: Low to High</option>
                                <option value="sold_desc" <?php if (isset($_POST['sort']) && $_POST['sort'] == 'sold_desc')
                                    echo 'selected'; ?>>Sold: High to Low</option>
                            </select>
                        </div>
                    </div>
                </form>

                <form id="filter-form">
                    <div class="col-sm-12">
                        <?php include("inc/fetch_tags.php"); ?>
                        <?php foreach ($tags as $tag): ?>
                            <div class="i-checks">
                                <label>
                                    <input type="checkbox" value="<?php echo $tag['tag_id']; ?>"> <i></i>
                                    <strong><?php echo $tag['tag_name']; ?></strong>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </form>


            </div>

            <div class="col-sm-12 col-md-9">
                <div class="wrapper wrapper-content animated fadeInRight">

                    <?php include("inc/fetch_products.php");

                    $totalProducts = count($products);
                    $itemsPerPage = 16;
                    $totalPages = ceil($totalProducts / $itemsPerPage);

                    $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;

                    $currentPage = max(1, min($currentPage, $totalPages));

                    $startIndex = ($currentPage - 1) * $itemsPerPage;

                    ?>

                    <div class="row product-list">


                    </div>

                    <?php if ($totalProducts == 0): ?>
                        No Result Found
                    <?php endif; ?>
                    <div class="col s12">
                        <ul class="pagination">
                            <li class="waves-effect <?php echo ($currentPage > 1) ? '' : 'disabled'; ?>">
                                <a href="<?php echo ($currentPage > 1) ? '?page=' . ($currentPage - 1) : '#'; ?>">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </a>
                            </li>

                            <?php for ($page = 1; $page <= $totalPages; $page++) { ?>
                                <li class="waves-effect <?php echo ($page == $currentPage) ? 'active' : ''; ?>">
                                    <a href="?page=<?php echo $page; ?>"><?php echo $page; ?></a>
                                </li>
                            <?php } ?>

                            <li class="waves-effect <?php echo ($currentPage < $totalPages) ? '' : 'disabled'; ?>">
                                <a
                                    href="<?php echo ($currentPage < $totalPages) ? '?page=' . ($currentPage + 1) : '#'; ?>">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
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
    <script src="https://kit.fontawesome.com/5a839d378a.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-checkbox/2.0.0/js/bootstrap-checkbox.js"
        integrity="sha512-QYk9v2sLUM4A36SkWT5Sa6bB9Y75NEJ/cjDBZtjbiFAzfhydYlgJ5vCL8nsDJOt1uFv6M3ORUOXsYO0yB8h4ZQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Custom and plugin javascript -->
    <script src="assets/js/inspinia.js"></script>
    <script src="assets/js/plugins/pace/pace.min.js"></script>
    <script src="assets/js/plugins/wow/wow.min.js"></script>
    <script>
        $(document).ready(function () {
            // Load all products on page load
            loadProducts();

            // Event for sorting dropdown
            $('#sort').on('change', function () {
                loadProducts();
            });

            // Event for filter checkboxes
            $('#filter-form input[type="checkbox"]').on('change', function () {
                loadProducts();
            });

            function loadProducts() {
                // Collect selected tags
                var selectedTags = [];
                $('#filter-form input[type="checkbox"]:checked').each(function () {
                    selectedTags.push($(this).val());
                });

                // Get sort option
                var sortOption = $('#sort').val();

                // AJAX request to fetch products
                $.ajax({
                    url: 'inc/fetch_shop_prod.php',
                    type: 'POST',
                    data: { tags: selectedTags, sort: sortOption },
                    success: function (data) {
                        console.log("Loaded Products:", data); // Log the response
                        $('.product-list').html(data);
                    },
                    error: function (xhr, status, error) {
                        console.error("Error Loading Products:", error);
                    }
                });
            }

            $.ajax({
                url: 'includes/fetch_shop_prod.php',
                success: function (data) {
                    $('.product-list').html(data);
                }
            });
        });


    </script>



    <script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-checkbox/2.0.0/js/bootstrap-checkbox.min.js"></script>

</body>

</html>