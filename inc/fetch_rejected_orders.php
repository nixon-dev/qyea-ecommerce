<?php
include('db_conn.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$query = "SELECT o.*, u.*, p.*
FROM orders o
INNER JOIN users u ON o.user_id = u.user_id
INNER JOIN products p ON o.product_id = p.product_id
WHERE rejected = 'True'
ORDER BY o.order_date DESC";


$result = mysqli_query($link, $query);
$orders = array();
while ($row = mysqli_fetch_assoc($result)) {
    $orders[] = $row;
}
