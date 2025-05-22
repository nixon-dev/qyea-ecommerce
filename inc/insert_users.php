<?php
include("db_conn.php");

if (isset($_POST["insertBtn"])) {
    $rawname = $_POST['name'];
    $name = ucwords(strtolower($rawname));
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password1'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $status = "Verified";

    $c1 = checkEmail($email);
    $c2 = checkPhone($phone);
    $c3 = checkUsername($username);


    if (!$c1 && !$c2 && !$c3) {
        $query = "INSERT INTO users (name, username, email, phone, password, roles, status) VALUES (?,?,?,?,?,?,?)";
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, "sssssss", $name, $username, $email, $phone, $hashed_password, $role, $status);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $msg = "User added Successfully!";
            header("Location: ../users-list?message=" . urlencode($msg));
            exit();

        } else {
            $msg = "Error adding user: " . mysqli_error($link);
            header("Location: ../add-users?error=" . urlencode($msg));
            exit();
        }
    } else {
        $msg = "Error!";
        header("Location: ../add-users?error=" . urlencode($msg));
        exit();
    }

} else {
    echo mysqli_error($link);
}



function checkEmail($email)
{
    global $link;
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) > 0) {
        $msg = "Email already in used!";
        header("Location: ../add-users?error=" . urlencode($msg));
        exit();
    }

    return False;
}

function checkPhone($phone)
{
    global $link;
    $query = "SELECT * FROM users WHERE phone = '$phone'";
    $result = mysqli_query($link, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $msg = "Phone already in used!";
        header("Location: ../add-users?error=" . urlencode($msg));
        exit();
    }

    return False;
}

function checkUsername($username)
{
    global $link;
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) > 0) {
        $msg = "Username already in used!";
        header("Location: ../add-users?error=" . urlencode($msg));
        exit();
    }

    return False;
}



