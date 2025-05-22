<?php
include('db_conn.php');

$reviewsQuery = "
    SELECT 
        r.*, 
        u.*
    FROM 
        reviews r 
    LEFT JOIN 
        users u ON r.user_id = u.user_id 
    WHERE 
        r.product_id = '$product_id'
    ORDER BY timestamp DESC
";

$reviewResult = mysqli_query($link, $reviewsQuery);
$reviews = array();
while ($reviewRow = mysqli_fetch_assoc($reviewResult)) {
    $reviews[] = $reviewRow;
}


$aggregateQuery = "
    SELECT 
        AVG(r.r_rating) AS average_rating, 
        COUNT(r.r_rating) AS total_reviews 
    FROM 
        reviews r 
    WHERE 
        r.product_id = '$product_id'
";

$aggregateResult = mysqli_query($link, $aggregateQuery);
$aggregateData = mysqli_fetch_assoc($aggregateResult);
$averageRating = $aggregateData['average_rating'];
$totalReviews = $aggregateData['total_reviews'];

