<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include('db_conn.php');


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "SELECT p.product_id, ps.ps_id, p.product_name, ps.ps_date, p.product_picture, ps.ps_stock, ps.ps_stock_type, p.product_description, ps.ps_price, ps.ps_price_type, p.product_sold, t.tag_name 
    FROM products p
    LEFT JOIN product_stock ps ON p.product_id = ps.product_id
    LEFT JOIN tags t ON p.tag_id = t.tag_id
    WHERE p.product_id = ?";

    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $p_id, $ps_id, $productname, $psdate, $pic, $stock, $stocktype, $desc, $price, $pricetype, $sold, $tag);
            mysqli_stmt_fetch($stmt);

            $stmt->close();
        }
    }
}
