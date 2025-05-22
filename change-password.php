<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title>Change Password - QYEA Store</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body class="white-bg">


    <?php session_start(); ?>
    <?php

    $email = $_GET['code'];
    $key = hash('sha256', 'nanashi_was_here', true); // 32-byte key
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

    $email = base64_decode($email);
    $iv = substr($email, 0, openssl_cipher_iv_length('aes-256-cbc'));
    $ciphertext = substr($email, openssl_cipher_iv_length('aes-256-cbc'));

    $decrypted = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, 0, $iv);

    // echo $email;
    // echo $decrypted;
    
    ?>
    <?php if (isset($_GET['code'])): ?>
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <div>
                    <a href="/"><img height="145" width="auto" src="assets/img/qyea.png"></a>
                </div>
                <h3>Change Password</h3>
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
                    <div class="form-group has-validation">
                        <input type="email" class="form-control" id="InputEmail" name="InputEmail"
                            aria-describedby="emailHelp" placeholder="Enter Email Address" value="<?php echo $decrypted; ?>"
                            readonly>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="New Password" name="password1" required="">

                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="password2"
                            required="">
                    </div>  

                    <button type="submit" class="btn btn-primary block full-width m-b" name="change">Change</button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <div>
                    <img height="145" width="auto" src="assets/img/qyea.png">
                </div>
                <h3>Your code has expired, please try again!</h3>
            </div>
        </div>
    <?php endif; ?>


    <!-- Mainly scripts -->
    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>

</body>

</html>