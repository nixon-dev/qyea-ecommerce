<?php
include('db_conn.php');

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "DELETE FROM products WHERE product_id = $id";
    mysqli_query($link, $query);


    $message = "Deleted Successfully!";
    header("Location: ../products-list?message=" . urlencode($message));
}