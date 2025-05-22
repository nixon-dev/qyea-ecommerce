<?php

include("db_conn.php");

$allowed_types = array('image/jpeg', 'image/png', 'image/gif', 'image/webp');

require '../vendor/autoload.php';

use Tinify\Tinify;

Tinify::setKey('FBBdsLbLVvCsXQbP2XPtcJfHJQ40Ks2n');

if (isset($_POST['updateOrderBtn'])) {

    if (!empty($_FILES["proof"]["tmp_name"]) && is_array($_POST['order_id'])) {
        $order_ids = $_POST['order_id']; 
        $reference  = $_POST['reference'];
        $file = $_FILES["proof"]; 
        $errors = [];

        if (
            $file["error"] == UPLOAD_ERR_OK &&
            is_uploaded_file($file["tmp_name"]) &&
            in_array($file["type"], $allowed_types) &&
            $file["size"] <= 11000000 &&
            $file["size"] > 0
        ) {

            $file_name = uniqid() . ".webp";
            $image_info = getimagesize($file["tmp_name"]);
            $image_width = $image_info[0];
            $source = \Tinify\fromFile($file["tmp_name"]);

            if ($image_width > 1080) {
                $resized = $source->resize([
                    "method" => "scale",
                    "width" => 1080
                ]);
                $resized->toFile('../assets/img/proofs/' . $file_name);
            } else {
                $source->toFile('../assets/img/proofs/' . $file_name);
            }

            $type = "Order";
            $date = date("Y-m-d");

            foreach ($order_ids as $id) {
                $query = "UPDATE orders SET
                            order_date =?, 
                            type = ?, 
                            proof = ?,
                            reference = ? 
                            WHERE order_id = ?";
                if ($stmt = mysqli_prepare($link, $query)) {
                    mysqli_stmt_bind_param($stmt, "ssssi", $date,$type, $file_name, $reference, $id);
                    if (!mysqli_stmt_execute($stmt)) {
                        $errors[] = "Error updating order ID: {$id}";
                    }
                } else {
                    $errors[] = "Database error for order ID: {$id}";
                }
            }

            if (empty($errors)) {
                $msg = "Ordered successfully!";
                header("Location: ../cart?message=" . urlencode($msg));
            } else {
                $msg = implode("<br>", $errors);
                header("Location: ../cart?error=" . urlencode($msg));
            }
        } else {
            $msg = "Invalid file uploaded!";
            header("Location: ../cart?error=" . urlencode($msg));
        }
        exit();
    } else {
        $msg = "Error: Upload proof";
        header("Location: ../cart?error=" . urlencode($msg));
        exit();
    }
}
