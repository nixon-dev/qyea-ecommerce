<?php

include("db_conn.php");

$allowed_types = array('image/jpeg', 'image/png', 'image/gif', 'image/webp');

require '../vendor/autoload.php';

use Tinify\Tinify;

Tinify::setKey('FBBdsLbLVvCsXQbP2XPtcJfHJQ40Ks2n');

if (isset($_POST['updateBtnAdmin'])) {
    $id = mysqli_real_escape_string($link, $_POST['id']);
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $phone = mysqli_real_escape_string($link, $_POST['phone']);
    $role = mysqli_real_escape_string($link, $_POST['role']);

    $query = "UPDATE users SET 
                name = ?,
                username = ?,
                email = ?,
                phone = ?,
                roles = ?
                WHERE user_id = ?";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "sssssi", $name, $username, $email, $phone, $role, $id);
        mysqli_stmt_execute($stmt);

        $msg = "User updated Successfully!";
        header("Location: ../users-list?message=" . urlencode($msg));
        exit();
    } else {
        $msg = "Error update failed!";
        header("Location: ../user-settings?error=" . urlencode($msg));
    }
}


if (isset($_POST['updateBtnPersonal'])) {
    $id = mysqli_real_escape_string($link, $_POST['id']);
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $phone = mysqli_real_escape_string($link, $_POST['phone']);



    if (
        $_FILES["profile"]["error"] == UPLOAD_ERR_OK &&
        is_uploaded_file($_FILES["profile"]["tmp_name"]) &&
        in_array($_FILES["profile"]["type"], $allowed_types) &&
        $_FILES["profile"]["size"] <= 11000000 &&
        $_FILES["profile"]["size"] > 0
    ) {
        $file_name = uniqid() . ".webp";
        $image_info = getimagesize($_FILES["profile"]["tmp_name"]);
        $image_width = $image_info[0];
        $source = \Tinify\fromFile($_FILES["profile"]["tmp_name"]);


        if ($image_width > 1080) {
            $resized = $source->resize([
                "method" => "scale",
                "width" => 1080
            ]);

            $resized->toFile('../assets/img/profile/' . $file_name);
        } else {

            $source->toFile('../assets/img/profile/' . $file_name);
        }

        $query = "UPDATE users SET 
                    name = ?, 
                    username = ?, 
                    email = ?, 
                    phone = ?, 
                    profile = ? 
                    WHERE user_id = ?";
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, "sssssi", $name, $username, $email, $phone, $file_name, $id);
            mysqli_stmt_execute($stmt);

            $msg = "User updated Successfully!";
            header("Location: ../user-settings?message=" . urlencode($msg));
            exit();
        } else {
            $msg = "Error update failed!";
            header("Location: ../user-settings?error=" . urlencode($msg));
        }


    } else {
        $query = "UPDATE users SET 
                    name = ?, 
                    username = ?, 
                    email = ?, 
                    phone = ?
                    WHERE user_id = ?";
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, "ssssi", $name, $username, $email, $phone, $id);
            mysqli_stmt_execute($stmt);

            $msg = "User updated Successfully!";
            header("Location: ../user-settings?message=" . urlencode($msg));
            exit();
        } else {
            $msg = "Error update failed!";
            header("Location: ../user-settings?error=" . urlencode($msg));
        }
    }
}

