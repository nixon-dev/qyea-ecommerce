<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include('db_conn.php');


require('mailer.php');

// Function to handle email verification
function sendVerificationEmail($email, $username)
{
    $key = hash('sha256', 'nanashi_was_here', true);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

    $encrypted = openssl_encrypt($email, 'aes-256-cbc', $key, 0, $iv);
    $encrypted = base64_encode($iv . $encrypted);
    $url_encoded_email = urlencode($encrypted);

    $_SESSION['email'] = $email;
    sendmail($email, $url_encoded_email, $username);
}

if (isset($_POST['signup'])) {

    $rawname = $_POST['fullname'];
    $fullname = ucwords(strtolower($rawname));
    $email = $_POST['email'];
    $phonenumber = $_POST['phone'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];
    $town = $_POST['town'];
    $province = $_POST['province'];
    $instruction = $_POST['instruction'];

    if (empty($rawname) || empty($email) || empty($phonenumber) || empty($username) || empty($password)) {
        $msg = 'All fields are required.';
        header("Location: ../signup?msg=" . urlencode($msg));
        exit();
    }

    $checkEmail = "SELECT * FROM users WHERE email = ?";
    if ($checkEmailStmt = mysqli_prepare($link, $checkEmail)) {
        mysqli_stmt_bind_param($checkEmailStmt, "s", $email);
        mysqli_stmt_execute($checkEmailStmt);
        mysqli_stmt_store_result($checkEmailStmt);

        if (mysqli_stmt_num_rows($checkEmailStmt) > 0) {
            $msg = "$email has already an account";
            header("Location: ../signup?error=" . urlencode($msg));
            mysqli_stmt_close($checkEmailStmt);
            exit();
        }
        mysqli_stmt_close($checkEmailStmt);
    } else {
        $msg = "Error checking email: " . mysqli_error($link);
        header("Location: ../signup?error=" . urlencode($msg));
        exit();
    }

    $checkPhone = "SELECT * FROM users WHERE phone = ?";
    if ($checkPhoneStmt = mysqli_prepare($link, $checkPhone)) {
        mysqli_stmt_bind_param($checkPhoneStmt, "s", $phone);
        mysqli_stmt_execute($checkPhoneStmt);
        mysqli_stmt_store_result($checkPhoneStmt);

        if (mysqli_stmt_num_rows($checkPhoneStmt) > 0) {
            $msg = "$phone has already an account";
            header("Location: ../signup?error=" . urlencode($msg));
            mysqli_stmt_close($checkPhoneStmt);
            exit();
        }
        mysqli_stmt_close($checkPhoneStmt);
    } else {
        $msg = "Error checking phone: " . mysqli_error($link);
        header("Location: ../signup?error=" . urlencode($msg));
        exit();
    }

    $checkUsername = "SELECT * FROM users WHERE username = ?";
    if ($stmt = mysqli_prepare($link, $checkUsername)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $msg = "Username is already taken";
            header("Location: ../signup?error=" . urlencode($msg));
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        $msg = "Error checking username";
        header("Location: ../signup?error=" . urlencode($msg));
        exit();
    }

    $insertQuery = "INSERT INTO users (name, email, phone, username, password) VALUES (?, ?, ?, ?, ?)";
    if ($insertStmt = mysqli_prepare($link, $insertQuery)) {
        mysqli_stmt_bind_param($insertStmt, "sssss", $fullname, $email, $phonenumber, $username, $password);
        mysqli_stmt_execute($insertStmt);
        mysqli_stmt_close($insertStmt);

        $lastid = mysqli_insert_id($link);

        $checkQuery = "SELECT * FROM shipping_address WHERE user_id = ?";
        if ($checkStmt = mysqli_prepare($link, $checkQuery)) {
            mysqli_stmt_bind_param($checkStmt, "i", $lastid);
            mysqli_stmt_execute($checkStmt);
            mysqli_stmt_store_result($checkStmt);

            if (mysqli_stmt_num_rows($checkStmt) > 0) {

                $updateQuery = "UPDATE shipping_address SET street = ?, barangay = ?, town = ?, province = ?, instruction = ? WHERE user_id = ?";
                if ($updateStmt = mysqli_prepare($link, $updateQuery)) {
                    mysqli_stmt_bind_param($updateStmt, "sssssi", $street, $barangay, $town, $province, $instruction, $lastid);

                    if (mysqli_stmt_execute($updateStmt)) {
                        $message = "Update Shipping Address";
                        sendVerificationEmail($email, $username);
                        header("Location: ../shipping-address?message=" . urlencode($message));
                    }
                }
            } else {
                $insertQuery = "INSERT INTO shipping_address (user_id, street, barangay, town, province, instruction) VALUES (?,?,?,?,?,?)";
                if ($insertStmt = mysqli_prepare($link, $insertQuery)) {
                    mysqli_stmt_bind_param($insertStmt, "isssss", $lastid, $street, $barangay, $town, $province, $instruction);
                    mysqli_stmt_execute($insertStmt);
                    mysqli_stmt_close($insertStmt);
                    $message = "Shipping Address Added Successfully!";
                    sendVerificationEmail($email, $username);
                    header("Location: ../shipping-address?message=" . urlencode($message));
                }
            }

        }

    } else {
        $msg = "Error: Unable to insert account" . mysqli_error($link);
        header("Location: ../signup?error=" . urlencode($msg));
        exit();
    }
}
