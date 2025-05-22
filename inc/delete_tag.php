<?php
include('db_conn.php');

if (isset($_GET['id'])) {

    $id = intval($_GET['id']);

    $query = "DELETE FROM tags WHERE tag_id = $id";
    mysqli_query($link, $query);


    $message = "Deleted Successfully!";
    header("Location: ../add-tags?message=" . urlencode($message));
}