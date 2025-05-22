<?php

include("db_conn.php");

if (isset($_POST['rejectBtn'])) {
    $order_id = $_POST['orderId'];
    $isRejectred = "True";
    $reason = $_POST['InputReason'];


    $query = "UPDATE orders SET rejected = ?, rejected_reason = ? WHERE order_id = ?";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "ssi", $isRejectred, $reason, $order_id);
        if (mysqli_stmt_execute($stmt)) {
            $msg = "Order rejected successfully!";
            header("Location: ../view-rejected-order?id=" . urlencode($order_id) . "&message=" . urlencode($msg));

        } else {
            $msg = "Error rejecting Order.";
            header("Location: ../view-order?id=" . urlencode($order_id) . "&message=" . urlencode($msg));
        }
    }

}