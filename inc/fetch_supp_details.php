<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include('db_conn.php');


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "SELECT supplies_id, supplies_name, supplies_picture, supplies_stock FROM supplies WHERE supplies_id = ?";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt,"s", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $s_id, $supplyname, $pic, $stock);
            mysqli_stmt_fetch($stmt);

            $stmt->close();
        }
    }
}
