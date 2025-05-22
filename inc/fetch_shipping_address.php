<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include('db_conn.php');


if (isset($_SESSION['id'])) {
    $id = intval($_SESSION['id']);

    $query = "SELECT street, barangay, town, province, instruction FROM shipping_address WHERE user_id = ?";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $street, $barangay, $town, $province, $instruction);
            mysqli_stmt_fetch($stmt);

            $stmt->close();
        } else {
            $street = "";
            $barangay = "";
            $town = "";
            $province = "";
            $instruction = "";
        }
    } else {
        $street = "";
        $barangay = "";
        $town = "";
        $province = "";
        $instruction = "";
    }

}
