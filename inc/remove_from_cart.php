<?php
include("db_conn.php");

if (isset($_GET['product-id'])) {

    $id = $_GET['product-id'];

    $query = "DELETE FROM orders WHERE order_id = $id";
    mysqli_query($link, $query);


    $message = "Deleted Successfully!";
    header("Location: ../cart?message=" . urlencode($message));
}