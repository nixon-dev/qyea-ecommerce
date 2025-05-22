<?php
include('db_conn.php');

// Retrieve Tags Data Tables
$tagquery = "SELECT * FROM tags";
$result_tags = mysqli_query($link, $tagquery);
$tags = array();
while ($row = mysqli_fetch_assoc($result_tags)) {
    $tags[] = $row;
}

