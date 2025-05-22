<?php

include("db_conn.php");
date_default_timezone_set("Asia/Manila");

if (isset($_POST['updateStockBtn'])) {
    $supply_id = $_POST['supply_id'];
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $reason = $_POST['reason'];
    $date = date("Y-m-d H:i:s");
    $who = $_POST['name'];
   

    // Database query to fetch current stock
    $query = "SELECT supplies_stock FROM supplies WHERE supplies_id = ?";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $supply_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $old_stock);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Error fetching product stock.";
        exit;
    }

    if ($type === "Add") {
        $new_stock = $old_stock + $amount;
    } elseif ($type === "Remove") {
        if ($amount > $old_stock) {
            echo "Error: Cannot remove more stock than available.";
            exit;
        }
        $new_stock = $old_stock - $amount;
    } else {
        echo "Invalid stock update type.";
        exit;
    }

    $query1 = "UPDATE supplies SET supplies_stock = ? WHERE supplies_id = ?";
    if ($stmt1 = mysqli_prepare($link, $query1)) {
        mysqli_stmt_bind_param($stmt1, "ii", $new_stock, $supply_id);
        if (mysqli_stmt_execute($stmt1)) {
            $msg = "Stock successfully updated.";
            header("Location: ../view-supply?id=" . urlencode($supply_id) . "&message=" . urlencode($msg));

        } else {
            $msg = "Error updating stock.";
            header("Location: ../view-supply?id=" . urlencode($supply_id) . "&message=" . urlencode($msg));
        }
        mysqli_stmt_close($stmt1);
    } else {
        $msg = "Error preparing the stock update query.";
        header("Location: ../view-supply?id=" . urlencode($supply_id) . "&message=" . urlencode($msg));
    }

    $query2 = "INSERT INTO supplies_history (supplies_id, sh_type, sh_amount, sh_context, sh_date, sh_who) VALUES (?,?,?,?,?,?)";
    if ($stmt2 = mysqli_prepare($link, $query2)) {
        mysqli_stmt_bind_param($stmt2, "isisss", $supply_id, $type, $amount, $reason, $date, $who);
        mysqli_stmt_execute($stmt2);
    }
}

