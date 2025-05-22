<?php
include('db_conn.php');

// Retrieve Users Data Tables
$query = "SELECT *, roles FROM users 
    ORDER BY CASE
    WHEN roles = 'administrator' THEN 1
    WHEN roles = 'staff' THEN 2
    WHEN roles = 'customer' THEN 3
    ELSE 999
    END";
$result = mysqli_query($link, $query);
$users = array();
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

