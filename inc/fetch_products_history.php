<?php
include ('db_conn.php');

$id = intval($_GET['id']);

// Retrieve Products Data Tables
$hp = "SELECT * FROM product_history WHERE product_id = $id ORDER BY ph_id DESC LIMIT 10";
$hp_result = mysqli_query($link, $hp);
$history_products = array();
while ($row_hp = mysqli_fetch_assoc($hp_result)) {
    $history_products[] = $row_hp;
}

