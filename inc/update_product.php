<?php

include("db_conn.php");

if (isset($_POST['updateProduct'])) {
    $product_id = intval($_POST['id']);
    $product_name = mysqli_real_escape_string($link, $_POST['product_name']);
    $product_description = mysqli_real_escape_string($link, $_POST['product_description']);
    $product_low_stock = mysqli_real_escape_string($link, $_POST['product_low_stock']);
    $product_tags = mysqli_real_escape_string($link, $_POST['product_tags']);



    $query = "UPDATE products SET product_name = ?, product_description = ?, product_low_stock = ?, tag_id = ? WHERE product_id = ?";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "ssiii", $product_name, $product_description, $product_low_stock, $product_tags, $product_id);
        if (mysqli_stmt_execute($stmt)) {
            $msg = "Product successfully updated.";
            header("Location: ../edit-product?id=" . urlencode($product_id) . "&message=" . urlencode($msg));

        } else {
            $msg = "Error updating product.";
            header("Location: ../edit-product?id=" . urlencode($product_id) . "&message=" . urlencode($msg));
        }
    }

}