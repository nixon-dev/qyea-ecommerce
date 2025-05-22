<?php

$prod = "SELECT * FROM orders WHERE type = 'Order' AND rejected = 'False' AND order_status = 'Pending'";
$result_prod = mysqli_query($link, $prod);
$pendingOrders = array();
while ($row_prod = mysqli_fetch_assoc($result_prod)) {
    $pendingOrders[] = $row_prod;
    $pendingOrderCount = count($pendingOrders);
}
