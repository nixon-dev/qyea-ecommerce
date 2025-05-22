<?php

include("db_conn.php");

$allowed_types = array('image/jpeg', 'image/png', 'image/gif', 'image/webp');

require '../vendor/autoload.php';

use Tinify\Tinify;

Tinify::setKey('FBBdsLbLVvCsXQbP2XPtcJfHJQ40Ks2n');

if (isset($_POST['updateBtnWebsettings'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $section_title = $_POST['section_title'];
    $section_description = $_POST['section_description'];
    $bio_title = $_POST['bio_title'];
    $bio_description = $_POST['bio_description'];
    $location = $_POST['location'];
    $contact_1 = $_POST['contact_1'];
    $contact_2 = $_POST['contact_2'];
    $contact_3 = $_POST['contact_3'];
    $contact_4 = $_POST['contact_4'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $youtube = $_POST['youtube'];
    $instagram = $_POST['instagram'];
    $id = 1;






    $query = "UPDATE settings SET 
                title = ?,
                description = ?,
                section_title = ?,
                section_desc = ?,
                bio_title = ?,
                bio_context = ?,
                location = ?,
                contact1 = ?,
                contact2 = ?,
                contact3 = ?,
                contact4 = ?,
                facebook = ?,
                twitter = ?,
                youtube = ?,
                instagram = ?
                WHERE setting_id = ?";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "sssssssssssssssi", $title, $description, $section_title, $section_description, $bio_title, $bio_description, $location, $contact_1, $contact_2, $contact_3, $contact_4, $facebook, $twitter, $youtube, $instagram, $id);
        mysqli_stmt_execute($stmt);

        $msg = "Web settings updated Successfully!";
        header("Location: ../web-settings?message=" . urlencode($msg));
        exit();
    } else {
        $msg = "Error update failed!";
        header("Location: ../web-settings?error=" . urlencode($msg));
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

