<!DOCTYPE html>
<html>
<?php
if (empty($_GET['id'])) {
    header("Location: /supplies-list");
} else {
    include("inc/fetch_supp_details.php");
}

if (empty($supplyname)) {
    header("Location: /supplies-list");
}
?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title><?php echo $supplyname; ?> - QYEA Store</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body class="fixed-sidebar full-height-layout skin-2">


    <div id="wrapper">

        <?php if (session_status() !== PHP_SESSION_ACTIVE) {
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

        <?php
        if ($_SESSION['role'] != "Administrator" && $_SESSION['role'] != "Staff") {
            session_destroy();
            header("Location: /login");
            exit;
        }
        ?>


        <div id="page-wrapper" class="gray-bg">
            <?php include("base/navbar.php"); ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2><?php echo $supplyname; ?></h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard">QYEA</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="supplies-list">Supplies</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong><?php echo $supplyname; ?></strong>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                        <!-- <a href="" class="btn btn-primary">This is action area</a> -->
                    </div>
                </div>
            </div>

            <div class="wrapper wrapper-content">

                <?php if (!empty($_GET['error'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_GET['error']; ?>
                    </div>
                <?php elseif (!empty($_GET['message'])): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_GET['message']; ?>
                    </div>
                <?php endif; ?>

                <div class="row animated fadeInRight">
                    <div class="col-md-4">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Supply Detail</h5>
                            </div>
                            <div>
                                <div class="ibox-content no-padding border-left-right">
                                    <img alt="image" class="img-fluid" src="assets/img/supplies/<?php echo $pic; ?>"
                                        style="height: 100%; width: 100%; oject-fit: cover;">
                                </div>
                                <div class="ibox-content profile-content">
                                    <!-- <h4><strong><?php echo $supplyname; ?></strong></h4> -->
                                    <h5><strong>Stocks:</strong> <?php echo number_format($stock); ?></h5>

                                    <div class="user-button">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="manage-supplies?id=<?php echo $s_id; ?>"
                                                    class="btn btn-primary btn-sm btn-block">Edit Supply</a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="manage-supplies?id=<?php echo $s_id; ?>"
                                                    class="btn btn-primary btn-sm btn-block">Manage Stock</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>History</h5>

                            </div>
                            <div class="ibox-content">

                                <?php

                                date_default_timezone_set("Asia/Manila");
                                include("inc/fetch_supplies_history.php");
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

                                <?php foreach ($history_supplies as $hs): ?>



                                    <?php if ($hs['sh_type'] == "Add"): ?>
                                        <div class="stream-small">
                                            <span class="label label-success"> Add</span>
                                            <span class="text-muted"> <?php echo time_ago($hs['sh_date']); ?> </span> -
                                            <?php echo $hs['sh_context']; ?><br>
                                            <span><strong>Amount:</strong>
                                                <?php echo number_format($hs['sh_amount']); ?></span><br>
                                            <span><strong>By:</strong> <?php echo $hs['sh_who']; ?></span>
                                        </div>
                                    <?php elseif ($hs['sh_type'] == "Remove"): ?>
                                        <div class="stream-small">
                                            <span class="label label-danger"> Remove</span>
                                            <span class="text-muted"> <?php echo time_ago($hs['sh_date']); ?> </span> -
                                            <?php echo $hs['sh_context']; ?><br>
                                            <span><strong>Amount:</strong>
                                                <?php echo number_format($hs['sh_amount']); ?></span><br>
                                            <span><strong>By:</strong> <?php echo $hs['sh_who']; ?></span>
                                        </div>
                                    <?php endif; ?>

                                <?php endforeach; ?>


                                <?php if (empty($history_supplies)): ?>
                                    <div class="stream-small">
                                        <span class="label label-plain"> None</span>
                                        <span class="text-muted">No history</span>
                                    </div>
                                <?php endif; ?>





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


</body>

</html>