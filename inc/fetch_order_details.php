<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include('db_conn.php');


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "SELECT 
        o.order_id,
        o.product_id,
        o.ps_id,
        o.order_amount,
        o.order_bill,
        o.order_bill_total,
        o.order_status,
        o.shipping_status,
        o.proof,
        o.reference,
        o.manual,
        u.name,
        u.email,
        u.phone,
        p.product_name,
        s.street,
        s.town,
        s.province,
        s.instruction,
        o.rejected,
        o.rejected_reason,
        o.user_id
        FROM orders o 
        LEFT JOIN users u ON o.user_id = u.user_id 
        LEFT JOIN products p ON o.product_id = p.product_id
        LEFT JOIN shipping_address s ON o.user_id = s.user_id
        WHERE order_id = ?";

    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $o_id, $product_id, $ps_id, $amount, $price, $total, $status, $ship, $proof, $reference, $manual, $customer, $customeremail, $phone, $productname, $street, $town, $province, $instruction, $rejected, $rejection, $user_id);
            mysqli_stmt_fetch($stmt);

            $stmt->close();
        }
    } else {
        $message = ("Query preparation failed: " . mysqli_error($link));
        header("Location: ../orders?error=" . urlencode($message));
        exit();
    }
}
