<?php
include("db_conn.php");

$allowed_types = array('image/jpeg', 'image/png', 'image/gif', 'image/webp');


//Load Composer's autoloader
require '../vendor/autoload.php';

use Tinify\Tinify;


Tinify::setKey('FBBdsLbLVvCsXQbP2XPtcJfHJQ40Ks2n');

if (isset($_POST["insertBtn"])) {
    $name = $_POST['suppliesname'];
    $stock = $_POST['suppliesstock'];

    $checkSupplies = "SELECT * FROM supplies WHERE supplies_name = ?";
    if ($checkSuppliesStmt = mysqli_prepare($link, $checkSupplies)) {
        mysqli_stmt_bind_param($checkSuppliesStmt, "s", $name);
        mysqli_stmt_execute($checkSuppliesStmt);
        mysqli_stmt_store_result($checkSuppliesStmt);

        if (mysqli_stmt_num_rows($checkSuppliesStmt) > 0) {
            $msg = "$name already exist";
            header("Location: ../add-supplies?error=" . urlencode($msg));
            mysqli_stmt_close($checkSuppliesStmt);
            exit();
        }
        mysqli_stmt_close($checkSuppliesStmt);
    } else {
        $msg = "Error checking email: " . mysqli_error($link);
        header("Location: ../add-supplies?error=" . urlencode($msg));
        exit();
    }


    if (
        $_FILES["suppliespicture"]["error"] == UPLOAD_ERR_OK &&
        is_uploaded_file($_FILES["suppliespicture"]["tmp_name"]) &&
        in_array($_FILES["suppliespicture"]["type"], $allowed_types) &&
        $_FILES["suppliespicture"]["size"] <= 11000000 &&
        $_FILES["suppliespicture"]["size"] > 0
    ) {

        $file_name = uniqid() . ".webp";
        $image_info = getimagesize($_FILES["suppliespicture"]["tmp_name"]);
        $image_width = $image_info[0];
        $source = \Tinify\fromFile($_FILES["suppliespicture"]["tmp_name"]);


        if ($image_width > 1080) {
            $resized = $source->resize([
                "method" => "scale",
                "width" => 1080
            ]);

            $resized->toFile('../assets/img/supplies/' . $file_name);
        } else {

            $source->toFile('../assets/img/supplies/' . $file_name);
        }


        $query = "INSERT INTO supplies (supplies_picture, supplies_name, supplies_stock) VALUES (?,?,?)";
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, "ssi", $file_name, $name, $stock);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $msg = "Supply Inserted Successfully!";
            header("Location: ../add-supplies?message=" . urlencode($msg));
            exit();

        } else {
            $msg = "Error Inserting Supply: " . mysqli_error($link);
            header("Location: ../add-supplies?error=" . urlencode($msg));
            exit();
        }


    } elseif ($_FILES["suppliespicture"]["size"] > 11000000) {
        $msg = "The uploaded image exceeds the maximum allowed size of 10MB.";
        header("Location: ../add-supplies?error=" . urlencode($msg));
        exit();

    }


} else {
    echo mysqli_error($link);
}

