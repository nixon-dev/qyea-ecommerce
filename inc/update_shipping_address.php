<?php

include("db_conn.php");

if (isset($_POST['updateShippingBtn'])) {
    $user_id = $_POST['id'];
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];
    $town = $_POST['town'];
    $province = $_POST['province'];
    $instruction = $_POST['instruction'];


    $checkQuery = "SELECT * FROM shipping_address WHERE user_id = ?";
    if ($checkStmt = mysqli_prepare($link, $checkQuery)) {
        mysqli_stmt_bind_param($checkStmt, "i", $user_id);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);

        if (mysqli_stmt_num_rows($checkStmt) > 0) {

            $updateQuery = "UPDATE shipping_address SET street = ?, barangay = ?, town = ?, province = ?, instruction = ? WHERE user_id = ?";
            if ($updateStmt = mysqli_prepare($link, $updateQuery)) {
                mysqli_stmt_bind_param($updateStmt, "sssssi", $street, $barangay, $town, $province, $instruction, $user_id);

                if (mysqli_stmt_execute($updateStmt)) {
                    $message = "Update Shipping Address";
                    header("Location: ../shipping-address?message=" . urlencode($message));
                } else {
                    $msg = "Error updating Shipping Address: " . mysqli_error($link);
                    header("Location: ../shipping-address?error=" . urlencode($msg));
                    exit();
                }
            }
        } else {
            $insertQuery = "INSERT INTO shipping_address (user_id, street, barangay, town, province, instruction) VALUES (?,?,?,?,?,?)";
            if ($insertStmt = mysqli_prepare($link, $insertQuery)) {
                mysqli_stmt_bind_param($insertStmt, "isssss", $user_id, $street, $barangay, $town, $province, $instruction);
                mysqli_stmt_execute($insertStmt);
                mysqli_stmt_close($insertStmt);

                $message = "Shipping Address Added Successfully!";
                header("Location: ../shipping-address?message=" . urlencode($message));
            } else {
                $msg = "Error adding Shipping Address: " . mysqli_error($link);
                header("Location: ../shipping-address?error=" . urlencode($msg));
                exit();
            }
        }

    }


}