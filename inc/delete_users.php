<?php
include('db_conn.php');

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "DELETE FROM users WHERE user_id = $id";
    mysqli_query($link, $query);


    $message = "Deleted Successfully!";
    header("Location: ../users-list?message=" . urlencode($message));
}