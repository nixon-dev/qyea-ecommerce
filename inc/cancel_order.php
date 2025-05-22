<?php

include("db_conn.php");

if (isset($_GET['id'])) {
    $order_id = intval($_GET['id']);
    $cancel = "Canceled";

    $query = "UPDATE orders SET order_status = ?, shipping_status = ? WHERE order_id = ?";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "ssi", $cancel,   $cancel, $order_id);
        if (mysqli_stmt_execute($stmt)) {
            $msg = "Canceled Successfully.";
            header("Location: ../orders?id=" . urlencode($order_id) . "&message=" . urlencode($msg));

        } else {
            $msg = "Error canceling order.";
            header("Location: ../view-order?id=" . urlencode($order_id) . "&message=" . urlencode($msg));
        }
    }

}