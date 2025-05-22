<?php
include('db_conn.php');

if (isset($_GET['id'])) {

    $id = intval($_GET['id']);

    $query = "DELETE FROM orders WHERE order_id = $id";
    mysqli_query($link, $query);


    $message = "Deleted Successfully!";
    header("Location: ../orders?message=" . urlencode($message));
}