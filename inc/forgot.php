<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include('db_conn.php');
require('forgot_mailer.php');


if (isset($_POST['verify'])) {
    $email = $_POST['email'];


    $query = "SELECT email, username FROM users WHERE email = ?";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $username = $row['username'];


            $key = hash('sha256', 'nanashi_was_here', true); // 32-byte key
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

            // Encrypt
            $encrypted = openssl_encrypt($email, 'aes-256-cbc', $key, 0, $iv);
            $encrypted = base64_encode($iv . $encrypted);
            $url_encoded_email = urlencode($encrypted);

            sendmail($email, $url_encoded_email, $username);
        } else {
            $message = "It looks like your email address isn't registered.";
            header("Location: ../forgot-password?error=" . urlencode($message));
            exit();
        }
    }
}

if (isset($_POST['change'])) {
    $password1 = password_hash($_POST['password1'], PASSWORD_DEFAULT);
    $email = $_POST['InputEmail'];

    $query = "UPDATE users SET password = ? WHERE email = ?";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "ss", $password1, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_affected_rows($stmt);

        if ($result > 0) {
            $message = "Password has been changed successfully!";
            header("Location: ../login?message=" . urlencode($message));
            exit();
        } else {
            $message = "Error: Unable to change password!";
            header("Location: ../forgot-password?error=" . urlencode($message));
            exit();
        }
    } else {
        $message = "An error occurred. Please try again later.";
        header("Location: ../verification?message=" . urlencode($message));
        exit();
    }
}