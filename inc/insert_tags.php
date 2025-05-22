<?php
include("db_conn.php");


if (isset($_POST["insertBtn"])) {
    $name = $_POST['tag_name'];

    $checkTags = "SELECT * FROM tags WHERE tag_name = ?";
    if ($checkTagsStmt = mysqli_prepare($link, $checkTags)) {
        mysqli_stmt_bind_param($checkTagsStmt, "s", $name);
        mysqli_stmt_execute($checkTagsStmt);
        mysqli_stmt_store_result($checkTagsStmt);

        if (mysqli_stmt_num_rows($checkTagsStmt) > 0) {
            $msg = "$name already exist";
            header("Location: ../add-tags?error=" . urlencode($msg));
            mysqli_stmt_close($checkTagsStmt);
            exit();
        } else {
            $query = "INSERT INTO tags (tag_name) VALUES (?)";
            if ($stmt = mysqli_prepare($link, $query)) {
                mysqli_stmt_bind_param($stmt, "s", $name);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                $msg = "Tags Inserted Successfully!";
                header("Location: ../add-tags?message=" . urlencode($msg));
                exit();

            } else {
                $msg = "Error Inserting Tags: " . mysqli_error($link);
                header("Location: ../add-tags?error=" . urlencode($msg));
                exit();
            }
        }

    } else {
        $msg = "Error checking tag: " . mysqli_error($link);
        header("Location: ../add-tags?error=" . urlencode($msg));
        exit();
    }




} else {
    echo mysqli_error($link);
}

