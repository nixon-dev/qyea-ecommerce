<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include('db_conn.php');


if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    $query = "SELECT name, username, email, phone, profile, roles FROM users WHERE user_id = ?";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt,"s", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $name, $username, $email, $phone, $profile, $roles);
            mysqli_stmt_fetch($stmt);

            $stmt->close();
        }
    }
}