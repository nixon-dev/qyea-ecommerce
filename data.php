<?php
// Database credentials
$servername = "localhost";
$username = "u871524642_nanashi_v2";
$password = "Qyea871524642";
$dbname = "u871524642_qyea_v2";

// Get the year from the query string (default to current year if not set)
$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL query to filter by year
    $stmt = $conn->prepare("SELECT description, year, january, february, march, april, may, june, july, august, september, october, november, december 
                            FROM cashflow 
                            WHERE type = 'INFLOW' AND year = :year"); 
    $stmt->bindParam(':year', $year, PDO::PARAM_INT);
    $stmt->execute();

    // Set the fetch mode to associative arrays
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $data = array();
    while($row = $stmt->fetch()) {
        $data[] = $row;
    }

    // Convert the PHP array to JSON (important for JavaScript)
    $json_data = json_encode($data);

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
$conn = null; // Close the connection
?>
