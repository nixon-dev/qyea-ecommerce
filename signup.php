<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title>Signup - QYEA</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body class="white-bg">


    <div class="middle-box loginscreen animated fadeInDown">
        <div>
            <div class="text-center">
                <a href="/"><img height="145" width="auto" src="assets/img/qyea.png"></a>
            </div>
            <h3 class="text-center">Signup</h3>
            <?php if (!empty($_GET['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php elseif (!empty($_GET['message'])): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_GET['message']; ?>
                </div>
            <?php endif; ?>

            <form class="m-t" role="form" action="inc/signup.php" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Fullname" name="fullname"
                        oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')" required="">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" id="email" name="email" required="">
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" placeholder="Phone Number" id="phone" name="phone"
                        oninput="if(this.value.length > 11) this.value = this.value.slice(0, 11)" required="">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" name="username" minlength="4"
                        required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" minlength="8" id="password"
                        name="password" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Repeat Password" minlength="8"
                        id="password2" name="password2" required="">
                </div>

                <h5>Shipping Address</h5>

                <div class="form-group">
                    <input type="text" placeholder="Purok" name="street" class="form-control"
                        value="" required>
                </div>

                <div class="form-group ">
                    <input type="text" placeholder="Barangay" name="barangay" class="form-control" required>
                </div>

                <div class="form-group ">
                    <input type="text" placeholder="Town" name="town" class="form-control"
                        oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')" required>
                </div>

                <div class="form-group ">
                    <input type="text" placeholder="Province" name="province" class="form-control"
                        oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')" required>
                </div>

                <div class="form-group ">
                    <input type="text" placeholder="Delivery Instruction" name="instruction" class="form-control"
                        oninput="this.value = this.value.replace(/[^A-Za-z0-9 ]/g, '')" required>
                </div>


                <button type="submit" class="btn btn-primary block full-width m-b" name="signup">Signup</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="login">Login</a>
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script>
        document.querySelector("#email").addEventListener("input", function () {
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,63}$/;
            if (!emailPattern.test(this.value)) {
                this.setCustomValidity("Please enter a valid Email address!");
            } else {
                this.setCustomValidity("");
            }
        });

        document.querySelector('#phone').addEventListener("input", function () {
            const phonePattern = /^\d{11}$/;;

            if (!phonePattern.test(this.value)) {
                this.setCustomValidity("Please enter a valid phone number!");
            } else {
                this.setCustomValidity("");
            }
        });

        document.querySelector('#password2').addEventListener('input', function () {
            const password = document.getElementById('password').value;
            const repeatPassword = document.getElementById('password2').value;

            if (password !== repeatPassword) {
                document.getElementById('password2').setCustomValidity("Passwords do not match!");
            } else {
                document.getElementById('password2').setCustomValidity("");
            }
        });



    </script>

</body>

</html>