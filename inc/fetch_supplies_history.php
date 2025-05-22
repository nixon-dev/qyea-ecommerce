<?php
include ('db_conn.php');

$id = intval($_GET['id']);

// Retrieve Suppplies History Data Tables
$hs = "SELECT * FROM supplies_history WHERE supplies_id = $id ORDER BY sh_id DESC";
$hs_result = mysqli_query($link, $hs);
$history_supplies = array();
while ($row_hs = mysqli_fetch_assoc($hs_result)) {
    $history_supplies[] = $row_hs;
}

