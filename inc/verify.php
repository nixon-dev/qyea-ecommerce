<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include('db_conn.php');


// Handle form submission
if (isset($_POST['vcode'])) {
    $enteredCode = $_POST['vcode'];
    if ($enteredCode === $_SESSION['verification_code']) {

        $email = $_SESSION['email'];
        $status = "Verified";

        $query = "UPDATE users SET status = ? WHERE email = ?";
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, "ss", $status, $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_affected_rows($stmt);

            if ($result > 0) {
                $message = "Verification success, you may now login your account!";
                header("Location: ../login?message=" . urlencode($message));
                exit();
            } else {
                $message = "Verification failed. Please try again or contact support.";
                header("Location: ../verification?error=" . urlencode($message));
                exit();
            }

        }


    } else {
        $message = "An error occurred. Please try again later.";
        header("Location: ../verification?message=" . urlencode($message));
        exit();
    }
}