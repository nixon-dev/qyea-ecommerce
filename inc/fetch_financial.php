<?php
include ('db_conn.php');

// Retrieve Finance Data Tables
$query = "SELECT * FROM financial_journal";
$result = mysqli_query($link, $query);
$finances = array();
while ($row = mysqli_fetch_assoc($result)) {
    $finances[] = $row;
}

