<?php
include ('db_conn.php');

$query = "SELECT * FROM financial_journal ORDER BY fj_id DESC LIMIT 1";
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $cashbal = $row['cash_balance'];
} else {
    $cashbal = "0";
}

$checkcfquery = "SELECT * FROM cashflow";
$resultcf = mysqli_query($link, $checkcfquery);

if (mysqli_num_rows($resultcf) > 0) {
    $sql_net_flow = "SELECT
                    year,
                    SUM(CASE WHEN type = 'INFLOW' THEN january ELSE 0 END) - SUM(CASE WHEN type = 'OUTFLOW' THEN january ELSE 0 END) AS January,
                    SUM(CASE WHEN type = 'INFLOW' THEN february ELSE 0 END) - SUM(CASE WHEN type = 'OUTFLOW' THEN february ELSE 0 END) AS February,
                    SUM(CASE WHEN type = 'INFLOW' THEN march ELSE 0 END) - SUM(CASE WHEN type = 'OUTFLOW' THEN march ELSE 0 END) AS March,
                    SUM(CASE WHEN type = 'INFLOW' THEN april ELSE 0 END) - SUM(CASE WHEN type = 'OUTFLOW' THEN april ELSE 0 END) AS April,
                    SUM(CASE WHEN type = 'INFLOW' THEN may ELSE 0 END) - SUM(CASE WHEN type = 'OUTFLOW' THEN may ELSE 0 END) AS May,
                    SUM(CASE WHEN type = 'INFLOW' THEN june ELSE 0 END) - SUM(CASE WHEN type = 'OUTFLOW' THEN june ELSE 0 END) AS June,
                    SUM(CASE WHEN type = 'INFLOW' THEN july ELSE 0 END) - SUM(CASE WHEN type = 'OUTFLOW' THEN july ELSE 0 END) AS July,
                    SUM(CASE WHEN type = 'INFLOW' THEN august ELSE 0 END) - SUM(CASE WHEN type = 'OUTFLOW' THEN august ELSE 0 END) AS August,
                    SUM(CASE WHEN type = 'INFLOW' THEN september ELSE 0 END) - SUM(CASE WHEN type = 'OUTFLOW' THEN september ELSE 0 END) AS September,
                    SUM(CASE WHEN type = 'INFLOW' THEN october ELSE 0 END) - SUM(CASE WHEN type = 'OUTFLOW' THEN october ELSE 0 END) AS October,
                    SUM(CASE WHEN type = 'INFLOW' THEN november ELSE 0 END) - SUM(CASE WHEN type = 'OUTFLOW' THEN november ELSE 0 END) AS November,
                    SUM(CASE WHEN type = 'INFLOW' THEN december ELSE 0 END) - SUM(CASE WHEN type = 'OUTFLOW' THEN december ELSE 0 END) AS December,
                    SUM(CASE WHEN type = 'INFLOW' THEN total ELSE 0 END) - SUM(CASE WHEN type = 'OUTFLOW' THEN total ELSE 0 END) as Total
                FROM
                    cashflow
                GROUP BY
                    year";

$result_net_flow = mysqli_query($link, $sql_net_flow);
$net_flow_data = array();

while ($row_net_flow = mysqli_fetch_assoc($result_net_flow)) {
    $year = $row_net_flow['year'];
    foreach ($row_net_flow as $key => $value) {
        if ($key !== 'year') {
            $month = $key;
            $net_flow_data[$year][$month] = $value;
        }
    }
}

// Ensure all months are present for each year, defaulting to 0 if not
$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'Total'];
foreach ($net_flow_data as $year => $month_data) {
    foreach ($months as $month) {
        if (!isset($net_flow_data[$year][$month])) {
            $net_flow_data[$year][$month] = 0;
        }
    }
}

// Convert data to JSON format for use with Chart.js
$chart_data = array();
foreach ($net_flow_data as $year => $month_data) {
    $chart_data[$year] = array_values($month_data);
}

// Find min and max values for chart scaling
$all_values = array_merge(...array_values($chart_data));
$minval = min($all_values);
$maxval = max($all_values);

$chartmin = $minval - 10000;
$chartmax = $maxval + 10000;

// Convert years to JSON format for use as labels in the chart
$chart_years = array_keys($net_flow_data);

// Encode data as JSON
$chart_data_json = json_encode($chart_data);
$chart_years_json = json_encode($chart_years);
}
