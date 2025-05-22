<?php

include("db_conn.php");

if (isset($_GET['id'])) {
    $order_id = intval($_GET['id']);
    $isRejectred = "True";


    $query = "UPDATE orders SET rejected = ? WHERE order_id = ?";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "si", $isRejectred, $order_id);
        if (mysqli_stmt_execute($stmt)) {
            $msg = "Order rejected.";
            header("Location: ../manage-order?id=" . urlencode($order_id) . "&message=" . urlencode($msg));

        } else {
            $msg = "Error rejecting Order.";
            header("Location: ../manage-order?id=" . urlencode($order_id) . "&message=" . urlencode($msg));
        }
    }

}