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
    <title>QYEA Store</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/plugins/bootstrapSocial/bootstrap-social.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/landing.css" rel="stylesheet">

</head>

<body id="page-top" class="landing-page no-skin-config ">
    <div class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-fixed-top navbar-expand-md" role="navigation">
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
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div id="inSlider" class="carousel slide" data-ride="carousel" data-interval="3000" style="height: 400px;">

        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <div class="container">
                    <div class="carousel-caption">
                        <h1><?php echo $title; ?></h1>
                        <p><?php echo $desc; ?></p>
                    </div>
                </div>

                <div class="header-back one">
                    <img src="assets/img/backgrounds/<?php echo $slider1; ?>"
                        style="background: 50% 0 no-repeat; height: 400px; width: 100%; object-fit: cover; filter: grayscale(30%); filter: brightness(50%);">
                </div>

            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="carousel-caption">
                        <h1><?php echo $title; ?></h1>
                        <p><?php echo $desc; ?></p>
                    </div>
                </div>

                <div class="header-back two">
                    <img src="assets/img/backgrounds/<?php echo $slider2; ?>"
                        style="background: 50% 0 no-repeat; height: 400px; width: 100%; object-fit: cover; filter: grayscale(60%); filter: brightness(50%);">
                </div>
            </div>
        </div>
    </div>


    <section id="about" class="container about">
        <div class="row">
            <div class="col-sm-12 ">
                <h1 class="text-center" style="color: #1d1d1e;"><strong>About Us</strong></h1>
                <h4 style="text-align: justify; text-justify: inter-word;">
                    <p style="text-indent: 20px; margin: 0; font-size: 15px; color: #1d1d1e;">
                        <?php
                        $text = str_replace(["\r\n", "\r"], "\n", $section_desc);
                        $paragraphs = explode("\n\n", $text);
                        $firstParagraph = htmlspecialchars(trim($paragraphs[0]));

                        echo $firstParagraph;
                        ?>
                    </p>
                </h4>
                <div class="d-flex justify-content-center">
                    <a href="/about#about" class="text-center btn btn-primary">Learn more</a>

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


    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/js/inspinia.js"></script>
    <script src="assets/js/plugins/pace/pace.min.js"></script>
    <script src="assets/js/plugins/wow/wow.min.js"></script>

    <script>
        $(document).ready(function () {

            $('body').scrollspy({
                target: '#navbar',
                offset: 80
            });

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

        new WOW().init();

    </script>

</body>
</html>