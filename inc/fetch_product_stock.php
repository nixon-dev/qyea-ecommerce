<?php
include('db_conn.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);


    // Retrieve Product Stock Data Tables
    $prod = "SELECT * FROM product_stock WHERE product_id = '$id'";
    $result_prod = mysqli_query($link, $prod);
    $product_stocks = array();
    while ($row_prod = mysqli_fetch_assoc($result_prod)) {
        $product_stocks[] = $row_prod;
    }

}


