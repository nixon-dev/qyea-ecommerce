<?php
include ('db_conn.php');

// Retrieve Supplies Data Tables
$query = "SELECT * FROM supplies";
$result_sup = mysqli_query($link, $query);
$supplies = array();
while ($row_sup = mysqli_fetch_assoc($result_sup)) {
    $supplies[] = $row_sup;
}

