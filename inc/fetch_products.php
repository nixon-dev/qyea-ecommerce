<?php
include ('db_conn.php');

// Retrieve Products Data Tables
$prod = "SELECT * FROM products";
$result_prod = mysqli_query($link, $prod);
$products = array();
while ($row_prod = mysqli_fetch_assoc($result_prod)) {
    $products[] = $row_prod;
}

