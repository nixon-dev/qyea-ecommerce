<?php

include('db_conn.php');



if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['role']) && $_SESSION['role'] == "Customer") {
    $id = intval($_SESSION['id']);
    $start = $_POST['start'];
    $length = $_POST['length'];
    $searchValue = $_POST['search']['value'];

    $totalQuery = "SELECT COUNT(*) AS total FROM orders WHERE order_status != 'Completed'";
    $totalResult = $conn->query($totalQuery);
    $totalRecords = $totalResult->fetch_assoc()['total'];

    $query = "SELECT o.*, u.*, p.* 
                FROM orders o
                INNER JOIN users u ON o.user_id = u.user_id
                INNER JOIN products p ON o.product_id = p.product_id
                WHERE o.user_id = $id AND 1=1
                ORDER BY o.order_id DESC";
    if (!empty($searchValue)) {
        $query .= " AND (u.name LIKE '%$searchValue%' or u.email LIKE '%$searchValue%')";
    }
    $query .= " LIMIT $start, $length";
    $result = $link->query($query);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            $row['order_date'],
            $row['name'],
            $row['product_name'],
            $row['order_amount'],
            $row['order_bill'],
            $row['order_bill_total'],
            $row['order_status'],
            $row['shipping_status'],
            $row['order_id'],
        ];
    }

    $filteredQuery = "SELECT COUNT(*) AS total FROM orders WHERE 1=1";
    if (!empty($searchValue)) {
        $filteredQuery .= " AND (u.name LIKE '%$searchValue%' or u.email like '%$searchValue%'";
    }
    $filteredResult = $link->query($filteredQuery);
    $filteredRecords = $filteredResult->fetch_assoc()['total'];

    echo json_encode([
        "draw" => intval($_POST['draw']), // From DataTables request
        "recordsTotal" => $totalRecords,
        "recordsFiltered" => $filteredRecords,
        "data" => $data
    ]);

}