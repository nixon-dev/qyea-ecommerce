<?php
include('db_conn.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['role']) && $_SESSION['role'] == "Customer") {
    // Retrieve Orders Data Tables of Customer
    $id = intval($_SESSION['id']);
    $query = "SELECT o.*, u.*, p.* 
                FROM orders o
                INNER JOIN users u ON o.user_id = u.user_id
                INNER JOIN products p ON o.product_id = p.product_id
                WHERE o.user_id = $id AND rejected = 'False' AND order_status NOT IN ('Completed', 'Canceled') AND type = 'Order'
                ORDER BY o.order_date DESC";


    $result = mysqli_query($link, $query);
    $orders = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }

    $query2 = "SELECT o.*, u.*, p.*
                FROM orders o
                INNER JOIN users u ON o.user_id = u.user_id
                INNER JOIN products p ON o.product_id = p.product_id
                WHERE order_status = 'Completed' AND rejected = 'False' AND o.user_id = $id AND type = 'Order'
                ORDER BY o.order_date DESC";
    $result2 = mysqli_query($link, $query2);
    $completed_orders = array();
    while ($row2 = mysqli_fetch_assoc($result2)) {
        $completed_orders[] = $row2;
    }

    $query3 = "SELECT o.*, u.*, p.*
                FROM orders o
                INNER JOIN users u ON o.user_id = u.user_id
                INNER JOIN products p ON o.product_id = p.product_id
                WHERE order_status = 'Canceled' AND o.user_id = $id AND rejected = 'False' AND type = 'Order'
                ORDER BY o.order_date DESC";
    $result3 = mysqli_query($link, $query3);
    $canceled_orders = array();
    while ($row3 = mysqli_fetch_assoc($result3)) {
        $canceled_orders[] = $row3;
    }



} else {
    // Retrieve Orders Data Tables of all Customers
    $query = "SELECT o.*, u.*, p.*
                FROM orders o
                INNER JOIN users u ON o.user_id = u.user_id
                INNER JOIN products p ON o.product_id = p.product_id
                WHERE order_status NOT IN ('Completed', 'Canceled', 'Pending') AND rejected = 'False'  AND type = 'Order'
                ORDER BY o.order_date DESC";
    $result = mysqli_query($link, $query);
    $orders = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }

    $query2 = "SELECT o.*, u.*, p.*
                FROM orders o
                INNER JOIN users u ON o.user_id = u.user_id
                INNER JOIN products p ON o.product_id = p.product_id
                WHERE order_status = 'Completed' AND rejected = 'False' AND type = 'Order'
                ORDER BY o.order_date DESC";
    $result2 = mysqli_query($link, $query2);
    $completed_orders = array();
    while ($row2 = mysqli_fetch_assoc($result2)) {
        $completed_orders[] = $row2;
    }



}
