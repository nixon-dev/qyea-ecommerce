<?php

$prod = "SELECT * FROM products WHERE product_stock <= product_low_stock";
$result_prod = mysqli_query($link, $prod);
$lowstocks = array();
while ($row_prod = mysqli_fetch_assoc($result_prod)) {
    $lowstocks[] = $row_prod;
    $count = count($lowstocks);
}
