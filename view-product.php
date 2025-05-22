<!DOCTYPE html>
<html>
<?php

if (empty($_GET['id'])) {
    header("Location: /products-list");
} else {
    include("inc/fetch_prod_details.php");
}

if (empty($productname)) {
    header("Location: /products-list");
}
?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title><?php echo $productname; ?> - QYEA Store</title>

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

        <div id="page-wrapper" class="gray-bg">
            <?php include("base/navbar.php"); ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2><?php echo $productname; ?></h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard">QYEA</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="products-list">Product</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong><?php echo $productname; ?></strong>
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
                                <h5>Product Detail</h5>
                            </div>
                            <div>
                                <div class="ibox-content no-padding border-left-right">
                                    <img alt="image" class="img-fluid" src="assets/img/products/<?php echo $pic; ?>"
                                        style="height: 100%; width: 100%; oject-fit: cover;">
                                </div>
                                <div class="ibox-content profile-content">
                                    <h4><strong><?php echo $productname; ?></strong></h4>
                                    <h5>Stocks: <?php echo number_format($stock); ?></h5>
                                    <p>
                                        <?php echo $desc; ?>
                                    </p>
                                    <div class="user-button">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="edit-product?id=<?php echo $p_id; ?>"
                                                    class="btn btn-primary btn-sm btn-block">Edit Product</a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="add-product-stocks?id=<?php echo $p_id; ?>"
                                                    class="btn btn-primary btn-sm btn-block">Add Stock</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>History</h5>

                            </div>
                            <div class="ibox-content">

                                <?php

                                date_default_timezone_set("Asia/Manila");
                                include("inc/fetch_products_history.php");
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

                                <?php foreach ($history_products as $hp): ?>



                                    <?php if ($hp['ph_type'] == "Add"): ?>
                                        <div class="stream-small">
                                            <span class="label label-success"> Add</span>
                                            <span class="text-muted"> <?php echo time_ago($hp['ph_date']); ?> </span> -
                                            <?php echo $hp['ph_context']; ?><br>
                                            <span><strong>Amount:</strong>
                                                <?php echo number_format($hp['ph_amount']); ?></span><br>
                                            <span><strong>By:</strong> <?php echo $hp['ph_who']; ?></span>
                                        </div>
                                    <?php elseif ($hp['ph_type'] == "Remove"): ?>
                                        <div class="stream-small">
                                            <span class="label label-danger"> Remove</span>
                                            <span class="text-muted"> <?php echo time_ago($hp['ph_date']); ?> </span> -
                                            <?php echo $hp['ph_context']; ?><br>
                                            <span><strong>Amount:</strong>
                                                <?php echo number_format($hp['ph_amount']); ?></span><br>
                                            <span><strong>By:</strong> <?php echo $hp['ph_who']; ?></span>
                                        </div>
                                    <?php endif; ?>

                                <?php endforeach; ?>


                                <?php if (empty($history_products)): ?>
                                    <div class="stream-small">
                                        <span class="label label-plain"> None</span>
                                        <span class="text-muted">No history</span>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-8">

                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Product Stock</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <table
                                        class="table table-striped table-bordered table-hover nowrap dataTables-product-stock">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th class="text-center">Stocks</th>
                                                <th class="text-center">Type</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Price Type</th>
                                                <th class="text-right">Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php include("inc/fetch_product_stock.php"); ?>
                                            <?php foreach ($product_stocks as $p): ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        $date = new DateTime($p['ps_date']);
                                                        echo $date->format('F d, Y - h:i A');
                                                        ?>
                                                    </td>
                                                    <td class="text-center"><?php echo $p['ps_stock']; ?></td>
                                                    <td class="text-center"><?php echo $p['ps_stock_type']; ?></td>
                                                    <td class="text-right">₱ <?php echo number_format($p['ps_price'], 2); ?>
                                                    </td>
                                                    <td class="text-center"><?php echo $p['ps_price_type']; ?></td>
                                                    <td class="text-right footable-visible footable-last-column">
                                                        <div class="btn-group">
                                                            <a class="btn-info btn btn-xs"
                                                                href="remove-product-stocks?id=<?php echo $p['ps_id']; ?>"><i
                                                                    class="fa-solid fa-pencil"></i> </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Date</th>
                                                <th class="text-center">Stocks</th>
                                                <th class="text-center">Type</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Price Type</th>
                                                <th class="text-right">Manage</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
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
    <script src="assets/js/plugins/dataTables/datatables.min.js"></script>
    <script>

        // Upgrade button class name
        $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm d-none';

        $(document).ready(function () {
            $('.dataTables-product-stock').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy' },

                ]

            });

        });

    </script>


</body>

</html>