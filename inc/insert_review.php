<?php

include("db_conn.php");

if (isset($_POST['reviewBtn'])) {
    $productId = $_POST['product_id'];
    $ratings = $_POST['rating'];
    $review = $_POST['reviewTextarea'];
    $order_id = $_POST['order_id'];
    $user_id = $_POST['user_id'];


    $checkReviews = "SELECT * FROM reviews WHERE user_id = ? AND product_id = ?";
    if ($checkReviewsStmt = mysqli_prepare($link, $checkReviews)) {
        mysqli_stmt_bind_param($checkReviewsStmt, "ii", $user_id, $productId);
        mysqli_stmt_execute($checkReviewsStmt);
        mysqli_stmt_store_result($checkReviewsStmt);

        if (mysqli_stmt_num_rows($checkReviewsStmt) > 0) {

            $query = "UPDATE reviews SET r_rating = ?, r_comments = ? WHERE user_id = ? AND product_id = ?";
            if ($stmt = mysqli_prepare($link, $query)) {
                mysqli_stmt_bind_param($stmt, "isii", $ratings, $review, $user_id, $productId);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                $msg = "Review Updated Successfully!";
                header("Location: ../view-completed-order?id=" . urlencode($order_id) . "&message=" . urlencode($msg));
            } else {
                $msg = "Error Updating Review: " . mysqli_error($link);
                header("Location: ../view-completed-order?id=" . urlencode($order_id) . "&error=" . urlencode($msg));
                exit();
            }



        } else {
            $query = "INSERT INTO reviews (user_id, product_id, r_rating, r_comments) VALUES (?,?,?,?)";
            if ($stmt = mysqli_prepare($link, $query)) {
                mysqli_stmt_bind_param($stmt, "iiis", $user_id, $productId, $ratings, $review);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                $msg = "Review Inserted Successfully!";
                header("Location: ../view-completed-order?id=" . urlencode($order_id) . "&message=" . urlencode($msg));
                exit();

            } else {
                $msg = "Error Inserting Review: " . mysqli_error($link);
                header("Location: ../view-completed-order?id=" . urlencode($order_id) . "&error=" . urlencode($msg));
                exit();
            }

        }

    }



}

