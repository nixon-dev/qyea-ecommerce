<?php
include('db_conn.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['id'];

$query = "SELECT r_rating, r_comments FROM reviews WHERE user_id = ? AND product_id = ?";
if ($stmt = mysqli_prepare($link, $query)) {
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $r_rating, $r_comments);
        mysqli_stmt_fetch($stmt);

        $stmt->close();
    }
}