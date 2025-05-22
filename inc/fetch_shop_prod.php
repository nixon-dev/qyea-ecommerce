<?php
include('db_conn.php');

$tags_query = "SELECT * FROM tags";
$tags_result = mysqli_query($link, $tags_query);

$selected_tags = isset($_POST['tags']) ? $_POST['tags'] : [];

$filter_query = "SELECT ps.*, p.*  FROM product_stock ps LEFT JOIN products p ON ps.product_id = p.product_id";

if (!empty($selected_tags)) {
    $tags_ids = implode(",", array_map('intval', $selected_tags));
    $filter_query .= " WHERE tag_id IN ($tags_ids)";
}



$result_prod = mysqli_query($link, $filter_query);
$products = [];
while ($row_prod = mysqli_fetch_assoc($result_prod)) {
    $products[] = $row_prod;
}



if (isset($_POST['sort']) && !empty($products)) {
    $sort = $_POST['sort'];
    usort($products, function ($a, $b) use ($sort) {
        switch ($sort) {
            case 'price_asc':
                return $a['product_price'] - $b['product_price']; // Low to High
            case 'price_desc':
                return $b['product_price'] - $a['product_price']; // High to Low
            case 'sold_asc':
                return $a['product_sold'] - $b['product_sold']; // Low to High
            case 'sold_desc':
                return $b['product_sold'] - $a['product_sold']; // High to Low
            default:
                return 0;
        }
    });
}


if (!empty($products)) {
    foreach ($products as $pns) {
        echo '
            <div class="col-md-4">
                <div class="ibox">
                    <div class="ibox-content product-box">
                        <a href="view-details?id= ' . htmlspecialchars($pns['ps_id']) . '">
                        <img loading="lazy" src="assets/img/products/' . htmlspecialchars($pns['product_picture']) . '"
                            style="height: 200px; width: 100%; object-fit: cover;">
                        </a>
                        <div class="product-desc">
                            <span class="product-price">
                                ₱ ' . number_format($pns['ps_price'], 2) . '
                            </span>
                            <a href="view-details?id=' . htmlspecialchars($pns['ps_id']) . '" class="product-name">' . htmlspecialchars($pns['product_name']) . '</a>
                         
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="text-muted">Stocks: ' . htmlspecialchars($pns['product_stock']) . ' </p>
                                </div>
                                 <div class="col-md-6 text-right">
                                    <p class="text-muted">Sold: ' . htmlspecialchars($pns['product_sold']) . ' </p>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>';
    }
} else {
    echo '<div class="col s12"><p>No products found.</p></div>';
}
