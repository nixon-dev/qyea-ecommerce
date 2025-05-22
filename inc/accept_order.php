<?php

include("db_conn.php");

if (isset($_POST['acceptOrderBtn'])) {
    $order_id = intval($_POST['orderId']);
    $isProcessing = "Processing";
    $orderAmount = $_POST['orderAmount'];
    $orderPSid = $_POST['orderPSid'];
    $orderProductId = $_POST['orderProductId'];

    $prodPass = false;
    $psPass = false;

    // Check product stock first
    $prodSubtractQuery = "SELECT product_stock FROM products WHERE product_id = ? AND product_stock >= ?";
    if ($stmt = mysqli_prepare($link, $prodSubtractQuery)) {
        mysqli_stmt_bind_param($stmt, "ii", $orderProductId, $orderAmount);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $prodPass = true;
        } else {
            $msg = "Not enough product stock.";
            header("Location: ../pending-orders?id=" . urlencode($order_id) . "&error=" . urlencode($msg));
            exit; // Prevent further execution
        }
        mysqli_stmt_close($stmt);
    }

    // Check PS stock next
    $psSubtractQuery = "SELECT ps_stock FROM product_stock WHERE ps_id = ? AND ps_stock >= ?";
    if ($stmt = mysqli_prepare($link, $psSubtractQuery)) {
        mysqli_stmt_bind_param($stmt, "ii", $orderPSid, $orderAmount);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $psPass = true;
        } else {
            $msg = "Not enough PS stock.";
            header("Location: ../pending-orders?id=" . urlencode($order_id) . "&error=" . urlencode($msg));
            exit; // Prevent further execution
        }
        mysqli_stmt_close($stmt);
    }

    // If both stock checks pass, proceed with the updates
    if ($prodPass && $psPass) {
        // Update product stock
        $prodSubtractQuery = "UPDATE products SET product_stock = product_stock - ?, product_sold = product_sold + ? WHERE product_id = ?";
        if ($stmt = mysqli_prepare($link, $prodSubtractQuery)) {
            mysqli_stmt_bind_param($stmt, "iii", $orderAmount, $orderAmount, $orderProductId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        // Update PS stock
        $psSubtractQuery = "UPDATE product_stock SET ps_stock = ps_stock - ? WHERE ps_id = ?";
        if ($stmt = mysqli_prepare($link, $psSubtractQuery)) {
            mysqli_stmt_bind_param($stmt, "ii", $orderAmount, $orderPSid);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        // Update order status to Processing
        $query = "UPDATE orders SET order_status = ? WHERE order_id = ?";
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, "si", $isProcessing, $order_id);
            if (mysqli_stmt_execute($stmt)) {
                $msg = "Order Accepted.";
                header("Location: ../manage-order?id=" . urlencode($order_id) . "&message=" . urlencode($msg));
            } else {
                $msg = "Error accepting Order.";
                header("Location: ../manage-order?id=" . urlencode($order_id) . "&message=" . urlencode($msg));
            }
            mysqli_stmt_close($stmt);
        }
    }
}