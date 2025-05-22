<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title>Forgot Password - QYEA Store</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body class="white-bg">


    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <a href="/"><img height="145" width="auto" src="assets/img/qyea.png"></a>
            </div>
            <h3>Forgot Password</h3>
            <?php if (!empty($_GET['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php elseif (!empty($_GET['message'])): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_GET['message']; ?>
                </div>
            <?php endif; ?>

            <form class="m-t" role="form" action="inc/forgot.php" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Email" name="email" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b" name="verify">Verify</button>
            </form>



        </div>
    </div>


    <!-- Mainly scripts -->
    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>

</body>

</html>