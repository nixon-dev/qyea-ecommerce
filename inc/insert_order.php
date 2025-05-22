<?php
include("db_conn.php");

if (isset($_POST["insertBtn"])) {
    $customer = $_POST['customer'];
    $product = $_POST['product'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $total_price = $_POST['total_price'];
    $order_status = "Completed";
    $shipping_status = "Delivered";
    $type = "Order";
    $manual = "True";
    $date = date("Y-m-d");

    $query = "INSERT INTO orders (user_id, product_id,order_date, order_amount, order_bill, order_bill_total, order_status, order_ship, type, manual) VALUES (?,?,?,?,?,?,?,?,?)";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "iiisssssss", $customer, $product, $amount, $date, $price, $total_price, $order_status, $shipping_status, $type, $manual);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $msg = "Order Inserted Successfully!";
        header("Location: ../orders?message=" . urlencode($msg));
        exit();

    } else {
        $msg = "Error Inserting Order: " . mysqli_error($link);
        header("Location: ../orders?error=" . urlencode($msg));
        exit();
    }

} else {
    echo mysqli_error($link);
}

