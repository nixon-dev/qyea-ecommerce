<?php
include ('db_conn.php');

// Retrieve Customers Data Tables
$query = "SELECT * FROM users WHERE roles = 'Customer'";
$result = mysqli_query($link, $query);
$customers = array();
while ($row = mysqli_fetch_assoc($result)) {
    $customers[] = $row;
}

