<?php
include('db_conn.php');

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "DELETE FROM supplies WHERE supplies_id = $id";
    mysqli_query($link, $query);


    $message = "Deleted Successfully!";
    header("Location: ../supplies-list?message=" . urlencode($message));
}