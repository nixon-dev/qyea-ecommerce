<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">

    <title>Edit Product - QYEA Store</title>

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
                    <h2>Edit Product</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard">QYEA</a>
                        </li>
                        <li class="breadcrumb-item ">
                            <a href="products-list">Products</a>
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
                $query = "SELECT * FROM products WHERE product_id = ?";
                if ($stmt = mysqli_prepare($link, $query)) {
                    mysqli_stmt_bind_param($stmt, "s", $id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        if ($row == Null) {
                            echo "<script>window.location.href='products-list.php?error=No Product Found'</script>";
                            exit();
                        }
                    }
                    $stmt->close();
                }
            } else {
                echo "<script>window.location.href='products-list.php?error=Error'</script>";
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
                                <h5>Product Information</h5>
                            </div>
                            <div class="ibox-content">
                                <form method="POST" action="inc/update_product.php" enctype="multipart/form-data">

                                    <div class="form-group d-none">
                                        <div class="col-sm-12">
                                            <input type="text" placeholder="ID" name="id" class="form-control"
                                                oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')"
                                                value="<?php echo $_GET['id']; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-sm-12">
                                            <label class="form-label">Product Name</label>
                                            <input type="text" placeholder="Product Name" name="product_name"
                                                class="form-control"
                                                oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')"
                                                value="<?php echo $row['product_name']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label class="form-label">Product Description</label>
                                            <textarea class="form-control" style="height: 100px"
                                                placeholder="Product Description" name="product_description"
                                                required><?php echo trim($row['product_description']); ?></textarea>
                                        </div>
                                    </div>


                                    <div class="form-group ">
                                        <div class="col-sm-12">
                                            <label class="form-label">Product Low Stock</label>
                                            <input type="number" placeholder="Product Low Stock"
                                                name="product_low_stock" class="form-control"
                                                value="<?php echo $row['product_low_stock']; ?>" required>
                                        </div>
                                    </div>


                                    <?php $product_tag = $row['tag_id']; ?>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label class="form-label">Product Tags</label>
                                            <select class="form-control m-b" name="product_tags" required>
                                                <?php include("inc/fetch_tags.php"); ?>
                                                <?php foreach ($tags as $tag): ?>
                                                    <option value="<?php echo $tag['tag_id']; ?>" <?php if ($product_tag == $tag['tag_id']) {
                                                           echo "selected";
                                                       } ?>>
                                                        <?php echo $tag['tag_name']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12 d-flex justify-content-center">
                                            <button class="btn btn-primary btn-md" name="updateProduct"
                                                type="submit">Update Product</button>
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


</body>

</html>