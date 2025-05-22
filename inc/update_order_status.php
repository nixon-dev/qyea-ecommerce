<?php

include("db_conn.php");

if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];
    $shipping_status = $_POST['shipping_status'];
    $product_name = $_POST['product_name'];
    $total_bill = $_POST['total_bill'];
    $query = "UPDATE orders SET order_status = ?, shipping_status = ? WHERE order_id = ?";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "ssi", $order_status, $shipping_status, $order_id);
        if (mysqli_stmt_execute($stmt)) {
            if ($order_status == 'Completed') {
                $todayYear = date("Y");
                $todayMonth = strtolower(date("F"));
                $type = "INFLOW";
                $checkProduct = "SELECT * FROM cashflow WHERE description = ? AND year = ?";
                if ($checkProductStmt = mysqli_prepare($link, $checkProduct)) {
                    mysqli_stmt_bind_param($checkProductStmt, "ss", $product_name, $todayYear);
                    mysqli_stmt_execute($checkProductStmt);
                    mysqli_stmt_store_result($checkProductStmt);

                    if (mysqli_stmt_num_rows($checkProductStmt) > 0) {
                        // UPDATE EXISTING CASHFLOW

                        $query = "UPDATE cashflow SET `$todayMonth` = COALESCE(`$todayMonth`, 0) + ? WHERE description = ? AND year = ?";

                        if ($stmt = mysqli_prepare($link, $query)) {
                            mysqli_stmt_bind_param($stmt, "dss", $total_bill, $product_name, $todayYear);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                        } 
                    } else {
                        // INSERT CASHFLOW IF IT DOESN'T EXIST YET 
                        $query = "INSERT INTO cashflow (type, year, description, `$todayMonth`) VALUES (?,?,?,?)";
                        if ($stmt = mysqli_prepare($link, $query)) {
                            mysqli_stmt_bind_param($stmt, "sssd", $type, $todayYear, $product_name, $total_bill);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                        }
                    }

                }
                $msg = "Order successfully updated.";
                header("Location: ../view-order?id=" . urlencode($order_id) . "&message=" . urlencode($msg));
            } else {
                $msg = "Order successfully updated.";
                header("Location: ../manage-order?id=" . urlencode($order_id) . "&message=" . urlencode($msg));
            }
        } else {
            $msg = "Error updating Order.";
            header("Location: ../manage-order?id=" . urlencode($order_id) . "&message=" . urlencode($msg));
        }
    }

}