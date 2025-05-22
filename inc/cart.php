<?php

include("db_conn.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['id'])) {
    $message = "Login first to access shopping cart";
    header("Location: ../login.php?message=" . urlencode($message));
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['id'];
    $productName = $_POST['product-name'];
    $productId = intval($_POST['product-id'] ?? 0);
    $productStockId = intval($_POST['product-stock-id'] ?? 0);
    $productPrice = floatval($_POST['product-price'] ?? 0);
    $productAmount = intval($_POST['product-amount'] ?? 0);
    $productTotal = $productPrice * $productAmount;
    $date = date('Y-m-d');

    if ($productAmount > 0) {

        $checkQuery = "SELECT * FROM orders WHERE user_id = ? AND product_id = ? AND ps_id = ? AND type = 'Cart'";
        if ($checkStmt = mysqli_prepare($link, $checkQuery)) {
            mysqli_stmt_bind_param($checkStmt, "iii", $id, $productId, $productStockId);
            mysqli_stmt_execute($checkStmt);
            $result = mysqli_stmt_get_result($checkStmt);
            mysqli_stmt_close($checkStmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $newAmount = $row['order_amount'] + $productAmount;
                $newTotal = $newAmount * $row['order_bill'];

                $updateQuery = "UPDATE orders SET order_amount = ?, order_bill_total = ? WHERE order_id = ?";
                if ($updateStmt = mysqli_prepare($link, $updateQuery)) {
                    mysqli_stmt_bind_param($updateStmt, "iid", $newAmount, $newTotal, $row['order_id']);
                    mysqli_stmt_execute($updateStmt);
                    mysqli_stmt_close($updateStmt);

                    $message = "Product quantity updated in cart";
                    header("Location: ../view-details.php?id=" . urlencode($productStockId) . "&message=" . urlencode($message));
                    exit();
                } else {
                    
                }
            } else {
                $query = "INSERT INTO orders (user_id, product_id, ps_id, order_date, order_bill, order_amount, order_bill_total) VALUES (?,?,?,?,?,?,?)";
                if ($stmt = mysqli_prepare($link, $query)) {
                    mysqli_stmt_bind_param($stmt, "iiisdid", $id, $productId, $productStockId, $date, $productPrice, $productAmount, $productTotal);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);

                    $message = "$productName added to cart";
                    header("Location: ../view-details.php?id=" . urlencode($productStockId) . "&message=" . urlencode($message));
                    exit();
                }
            }
        }



    } else {
        header("Location: ../view-details.php?id=" . urlencode($productId) . "&error=" . urlencode("Invalid product data"));
        exit();
    }
}
