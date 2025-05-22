<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include('db_conn.php');

function generateRandomString($length)
{
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}

require('mailer.php');



if (isset($_POST['login'])) {

    if (isset($_POST['username'])) {
        $username = $_POST['username'];
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    if ((!$username) || (!$password)) {
        $msg = 'Please fill all the fields!';
        header("Location: ../login?message=" . urlencode($msg));
        exit();
    } else {

        $query = "SELECT user_id, name, email, roles, status, password, phone FROM users WHERE username = ?";
        if ($queryStmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($queryStmt, "s", $username);
            mysqli_stmt_execute($queryStmt);
            mysqli_stmt_store_result($queryStmt);

            if (mysqli_stmt_num_rows($queryStmt) > 0) {
                mysqli_stmt_bind_result($queryStmt, $user_id, $name, $email, $roles, $status, $hashed_password, $phone);
                mysqli_stmt_fetch($queryStmt);


                if (password_verify($password, $hashed_password)) {

                    $_SESSION['id'] = $user_id;
                    $_SESSION['name'] = $name;
                    $_SESSION['email'] = $email;
                    $_SESSION['role'] = $roles;
                    $_SESSION['username'] = $username;
                    $_SESSION['status'] = $status;
                    $_SESSION['phone'] = $phone;

                    if ($status == "Unverified") {
                        $key = hash('sha256', 'nanashi_was_here', true); // 32-byte key
                        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

                        // Encrypt
                        $encrypted = openssl_encrypt($email, 'aes-256-cbc', $key, 0, $iv);
                        $encrypted = base64_encode($iv . $encrypted);
                        $url_encoded_email = urlencode($encrypted);


                        sendmail($email, $url_encoded_email, $username);
                    } elseif ($roles == 'Customer') {
                        header("Location: ../index");
                        exit();
                    } elseif ($roles = 'Administrator' || $roles == 'Staff') {
                        header("Location: ../dashboard");
                        exit();
                    }
                } else {
                    $msg = "Incorrect username/password";
                    header("Location: ../login?error=" . urlencode($msg));
                }
            } else {
                $msg = "Incorrect username/password";
                header("Location: ../login?error=" . urlencode($msg));
            }
        }



    }
} else {
    $msg = "Error: No Accepted Method Received";
    header("Location: ../login?error=" . urlencode($msg));
}
