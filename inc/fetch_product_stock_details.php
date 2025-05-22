<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include('db_conn.php');


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "SELECT p.product_name, ps.ps_id, ps.product_id, ps.ps_stock, ps.ps_stock_type, ps.ps_price, ps.ps_price_type, p.product_picture, ps.ps_date, p.product_description, p.product_sold FROM product_stock ps LEFT JOIN products p on ps.product_id = p. product_id WHERE ps.ps_id = ?";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

      

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $productname, $ps_id, $product_id, $ps_stock, $ps_stock_type, $ps_price, $ps_price_type, $pic, $psdate, $desc, $sold);
            mysqli_stmt_fetch($stmt);


            $stmt->close();
        }
    }
}
