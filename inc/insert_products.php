<?php
include("db_conn.php");

$allowed_types = array('image/jpeg', 'image/png', 'image/gif', 'image/webp');


//Load Composer's autoloader
require '../vendor/autoload.php';

use Tinify\Tinify;


Tinify::setKey('FBBdsLbLVvCsXQbP2XPtcJfHJQ40Ks2n');

if (isset($_POST["insertBtn"])) {

    $productname = $_POST['productname'];
    $tags = $_POST['producttags'];
    $description = $_POST['productdescription'];
    $lowstock = $_POST['productlowstock'];



    $checkProduct = "SELECT * FROM products WHERE product_name = ?";
    if ($checkProductStmt = mysqli_prepare($link, $checkProduct)) {
        mysqli_stmt_bind_param($checkProductStmt, "s", $productname);
        mysqli_stmt_execute($checkProductStmt);
        mysqli_stmt_store_result($checkProductStmt);

        if (mysqli_stmt_num_rows($checkProductStmt) > 0) {
            $msg = "$productname already exist";
            header("Location: ../add-products?error=" . urlencode($msg));
            mysqli_stmt_close($checkProductStmt);
            exit();
        }
        mysqli_stmt_close($checkProductStmt);
    } else {
        $msg = "Error checking email: " . mysqli_error($link);
        header("Location: ../add-products?error=" . urlencode($msg));
        exit();
    }


    if (
        $_FILES["productpicture"]["error"] == UPLOAD_ERR_OK &&
        is_uploaded_file($_FILES["productpicture"]["tmp_name"]) &&
        in_array($_FILES["productpicture"]["type"], $allowed_types) &&
        $_FILES["productpicture"]["size"] <= 11000000 &&
        $_FILES["productpicture"]["size"] > 0
    ) {

        $file_name = uniqid() . ".webp";
        $image_info = getimagesize($_FILES["productpicture"]["tmp_name"]);
        $image_width = $image_info[0];
        $source = \Tinify\fromFile($_FILES["productpicture"]["tmp_name"]);


        if ($image_width > 1080) {
            $resized = $source->resize([
                "method" => "scale",
                "width" => 1080
            ]);

            $resized->toFile('../assets/img/products/' . $file_name);
        } else {

            $source->toFile('../assets/img/products/' . $file_name);
        }


        $query = "INSERT INTO products (product_picture, product_name, tag_id, product_description, product_low_stock) VALUES (?,?,?,?,?)";
        if ($insertPnsStmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($insertPnsStmt, "ssisi", $file_name, $productname, $tags, $description, $lowstock);
            mysqli_stmt_execute($insertPnsStmt);
            mysqli_stmt_close($insertPnsStmt);

            $msg = "Product Inserted Successfully!";
            header("Location: ../add-products?message=" . urlencode($msg));
            exit();

        } else {
            $msg = "Error Inserting Product: " . mysqli_error($link);
            header("Location: ../add-products?error=" . urlencode($msg));
            exit();
        }


    } elseif ($_FILES["productpicture"]["size"] > 11000000) {
        $msg = "The uploaded image exceeds the maximum allowed size of 10MB.";
        header("Location: ../add-products?error=" . urlencode($msg));
        exit();
    }
}
