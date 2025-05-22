<?php

include("inc/db_conn.php");

if (isset($_GET['code'])) {
    $email = $_GET['code'];
    $key = hash('sha256', 'nanashi_was_here', true); // 32-byte key
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

    $email = base64_decode($email);
    $iv = substr($email, 0, openssl_cipher_iv_length('aes-256-cbc'));
    $ciphertext = substr($email, openssl_cipher_iv_length('aes-256-cbc'));

    $decrypted = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, 0, $iv);
    $status = "Verified";



    $query = "UPDATE users SET status = ? WHERE email = ?";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "ss", $status, $decrypted);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_affected_rows($stmt);

        if ($result > 0) {
            $message = "Verification success, you may now login your account!";
            header("Location: ../login?message=" . urlencode($message));
            exit();
        } else {
            $message = "Verification failed. Please try again or contact support.";
            header("Location: ../login?error=" . urlencode($message));
            exit();
        }

    }

} else {
    echo "Something";
}