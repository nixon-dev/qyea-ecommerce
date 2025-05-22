<?php
include('db_conn.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



if (empty($_SESSION['id'])) {
    $cart_count = 0;
    $totalPrice = 0;
    $cart = "0";
    $totalprice = "0";
} else {
    $id = intval($_SESSION['id']);
    $x = 'Cart';
    $y = 'False';
    
    $query = "SELECT
                p.*,
                o.*,
                ps.*
            FROM
                orders o
            LEFT JOIN products p ON
                o.product_id = p.product_id
            LEFT JOIN product_stock ps ON
                o.ps_id = ps.ps_id
            WHERE
                o.user_id = ? AND TYPE = ? AND rejected = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "iss", $id, $x, $y);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $cartItems = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $cartItems[] = $row;
    }


    $query2 = "SELECT *, 
    COUNT(DISTINCT(order_id)) as count,
    SUM(order_bill_total) as total FROM orders WHERE user_id = $id AND type = 'Cart' AND rejected = 'False'";
    $result2 = mysqli_query($link, $query2);
    if (mysqli_num_rows($result2) > 0) {
        $row2 = mysqli_fetch_assoc($result2);
        $cart = $row2['count'];
        $totalprice = $row2['total'];
    }
}
