<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title>Edit Users - QYEA Store</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body class="fixed-sidebar full-height-layout skin-2">

    <div id="wrapper">

        <?php session_start(); ?>
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
                    <h2>Edit Users</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard">QYEA</a>
                        </li>
                        <li class="breadcrumb-item ">
                            Users
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Edit</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                        <!-- <a href="" class="btn btn-primary">This is action area</a> -->
                    </div>
                </div>
            </div>

            <?php
            global $link;
            if (isset($_GET['id'])) {
                $id = mysqli_real_escape_string($link, $_GET['id']);
                $query = "SELECT * FROM users WHERE user_id = ?";
                if ($stmt = mysqli_prepare($link, $query)) {
                    mysqli_stmt_bind_param($stmt, "s", $id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        if ($row == Null) {
                            echo "<script>window.location.href='users-list.php?error=No User Found'</script>";
                            exit();
                        }
                    }
                    $stmt->close();
                }
            } else {
                echo "<script>window.location.href='users-list.php?error=Error'</script>";
                exit();
            }
            ?>

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
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>User Information</h5>
                            </div>
                            <div class="ibox-content">
                                <form method="POST" action="inc/update_users.php" enctype="multipart/form-data">

                                    <div class="form-group d-none">
                                        <div class="col-sm-12">
                                            <input type="text" placeholder="ID" name="id" class="form-control"
                                                oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')"
                                                value="<?php echo $_GET['id']; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-sm-12">
                                            <input type="text" placeholder="Full Name" name="name" class="form-control"
                                                oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')"
                                                value="<?php echo $row['name']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-sm-12">
                                            <input type="text" placeholder="Username" name="username" minlength="4"
                                                class="form-control" value="<?php echo $row['username']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-sm-12">
                                            <input type="email" placeholder="Email" id="email" name="email"
                                                class="form-control" value="<?php echo $row['email']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-sm-12">
                                            <input type="number" placeholder="Phone Number" id="phone" name="phone"
                                                oninput="if(this.value.length > 11) this.value = this.value.slice(0, 11)"
                                                value="<?php echo $row['phone']; ?>" class="form-control" required>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <select class="form-control m-b" name="role">
                                                <option value="Customer" <?php if ($row['roles'] == 'Customer') {
                                                    echo "selected";
                                                } ?>>Customer</option>
                                                <option value="Staff" <?php if ($row['roles'] == 'Staff') {
                                                    echo "selected";
                                                } ?>>Staff</option>
                                                <option value="Administrator" <?php if ($row['roles'] == 'Administrator') {
                                                    echo "selected";
                                                } ?>>Administrator</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12 d-flex justify-content-center">
                                            <button class="btn btn-primary btn-md" name="updateBtnAdmin"
                                                type="submit">Update
                                                User</button>
                                        </div>
                                    </div>
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



    </script>


</body>

</html>