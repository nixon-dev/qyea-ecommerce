<?php

include("db_conn.php");
date_default_timezone_set("Asia/Manila");

if (isset($_POST['updateStockBtn'])) {
    $product_id = $_POST['product_id'];
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $amount_type = $_POST['stock_type'];
    $price = $_POST['price'];
    $price_type = $_POST['price_type'];
    $reason = $_POST['reason'];
    $date = date("Y-m-d H:i:s");
    $who = $_POST['name'];

    // Database query to fetch current stock
    $query = "SELECT product_stock FROM products WHERE product_id = ?";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $product_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $old_stock);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    } else {
        $msg = "Error fetching product stock.";
        header("Location: ../view-product?id=" . urlencode($product_id) . "&message=" . urlencode($msg));
        exit;
    }

    $new_stock = $old_stock + $amount;

    $query1 = "UPDATE products SET product_stock = ? WHERE product_id = ?";
    if ($stmt1 = mysqli_prepare($link, $query1)) {
        mysqli_stmt_bind_param($stmt1, "ii", $new_stock, $product_id);
        if (mysqli_stmt_execute($stmt1)) {
            $msg = "Stock successfully updated.";
            header("Location: ../view-product?id=" . urlencode($product_id) . "&message=" . urlencode($msg));

        } else {
            $msg = "Error updating stock.";
            header("Location: ../view-product?id=" . urlencode($product_id) . "&message=" . urlencode($msg));
        }
        mysqli_stmt_close($stmt1);
    } else {
        $msg = "Error preparing the stock update query.";
        header("Location: ../view-product?id=" . urlencode($product_id) . "&message=" . urlencode($msg));
    }

    $query2 = "INSERT INTO product_history (product_id, ph_type, ph_amount, ph_context, ph_date, ph_who) VALUES (?,?,?,?,?,?)";
    if ($stmt2 = mysqli_prepare($link, $query2)) {
        mysqli_stmt_bind_param($stmt2, "isisss", $product_id, $type, $amount, $reason, $date, $who);
        mysqli_stmt_execute($stmt2);
    }

    $query3 = "INSERT INTO product_stock (product_id, ps_date, ps_stock, ps_stock_type, ps_price, ps_price_type) VALUES (?,?,?,?,?,?)";
    if ($stmt3 = mysqli_prepare($link, $query3)) {
        mysqli_stmt_bind_param($stmt3, "isisds", $product_id, $date, $amount, $amount_type, $price, $price_type);
        mysqli_stmt_execute($stmt3);
    }
}


if (isset($_POST['removeStockBtn'])) {
    $product_id = $_POST['product_id'];
    $ps_id = $_POST['ps_id'];
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $reason = $_POST['reason'];
    $date = date("Y-m-d H:i:s");
    $who = $_POST['name'];

    // Database query to fetch current stock
    $query = "SELECT product_stock FROM products WHERE product_id = ?";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $product_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $old_stock);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    } else {
        $msg = "Error fetching product stock.";
        header("Location: ../view-product?id=" . urlencode($product_id) . "&message=" . urlencode($msg));
        exit;
    }

    $new_stock = $old_stock - $amount;

    $query1 = "UPDATE products SET product_stock = ? WHERE product_id = ?";
    if ($stmt1 = mysqli_prepare($link, $query1)) {
        mysqli_stmt_bind_param($stmt1, "ii", $new_stock, $product_id);
        if (mysqli_stmt_execute($stmt1)) {
            $msg = "Stock successfully updated.";
            header("Location: ../view-product?id=" . urlencode($product_id) . "&message=" . urlencode($msg));

        } else {
            $msg = "Error updating stock.";
            header("Location: ../view-product?id=" . urlencode($product_id) . "&message=" . urlencode($msg));
        }
        mysqli_stmt_close($stmt1);
    } else {
        $msg = "Error preparing the stock update query.";
        header("Location: ../view-product?id=" . urlencode($product_id) . "&message=" . urlencode($msg));
    }

    $query2 = "INSERT INTO product_history (product_id, ph_type, ph_amount, ph_context, ph_date, ph_who) VALUES (?,?,?,?,?,?)";
    if ($stmt2 = mysqli_prepare($link, $query2)) {
        mysqli_stmt_bind_param($stmt2, "isisss", $product_id, $type, $amount, $reason, $date, $who);
        mysqli_stmt_execute($stmt2);
    }

    $query3 = "SELECT ps_stock FROM product_stock WHERE ps_id = ?";
    if ($stmt3 = mysqli_prepare($link, $query3)) {
        mysqli_stmt_bind_param($stmt3, "i", $ps_id);
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_bind_result($stmt3, $ps_old_stock);
        mysqli_stmt_fetch($stmt3);
        mysqli_stmt_close($stmt3);
    } else {
        $msg = "Error fetching product stock.";
        header("Location: ../view-product?id=" . urlencode($product_id) . "&message=" . urlencode($msg));
        exit;
    }

    $ps_new_stock = $ps_old_stock - $amount;

    if ($ps_new_stock == 0) {
        $query = "DELETE FROM product_stock WHERE ps_id = $ps_id";
        mysqli_query($link, $query);
        $msg = "Deleted Successfully!";
        header("Location: ../view-product?id=" . urlencode($product_id) . "&message=" . urlencode($msg));
    } else {
        $query4 = "UPDATE product_stock SET ps_stock = ? WHERE ps_id = ?";
        if ($stmt4 = mysqli_prepare($link, $query4)) {
            mysqli_stmt_bind_param($stmt4, "ii", $ps_new_stock, $ps_id);
            if (mysqli_stmt_execute($stmt4)) {
                $msg = "Stock successfully updated.";
                header("Location: ../view-product?id=" . urlencode($product_id) . "&message=" . urlencode($msg));

            } else {
                $msg = "Error updating stock.";
                header("Location: ../view-product?id=" . urlencode($product_id) . "&message=" . urlencode($msg));
            }
            mysqli_stmt_close($stmt4);
        } else {
            $msg = "Error preparing the stock update query.";
            header("Location: ../view-product?id=" . urlencode($product_id) . "&message=" . urlencode($msg));
        }
    }

}

