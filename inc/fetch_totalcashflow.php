<?php
include('db_conn.php');

$sql_inflow = "SELECT
            year,
            SUM(january) AS January,
            SUM(february) AS February,
            SUM(march) AS March,
            SUM(april) AS April,
            SUM(may) AS May,
            SUM(june) AS June,
            SUM(july) AS July,
            SUM(august) AS August,
            SUM(september) AS September,
            SUM(october) AS October,
            SUM(november) AS November,
            SUM(december) AS December,
            SUM(total) as Total,
            type
        FROM
            cashflow
        WHERE
            type = 'INFLOW'
        GROUP BY
            year";
$result_inflow = mysqli_query($link, $sql_inflow);
$cashflow_inflow = array();
while ($row_inflow = mysqli_fetch_assoc($result_inflow)) {
    $cashflow_inflow[] = $row_inflow;
}


$sql_outflow = "SELECT
            year,
            SUM(january) AS January,
            SUM(february) AS February,
            SUM(march) AS March,
            SUM(april) AS April,
            SUM(may) AS May,
            SUM(june) AS June,
            SUM(july) AS July,
            SUM(august) AS August,
            SUM(september) AS September,
            SUM(october) AS October,
            SUM(november) AS November,
            SUM(december) AS December,
            SUM(total) as Total,
            type
        FROM
            cashflow
        WHERE
            type = 'OUTFLOW'
        GROUP BY
            year";
$result_outflow = mysqli_query($link, $sql_outflow);
$cashflow_outflow = array();
while ($row_outflow = mysqli_fetch_assoc($result_outflow)) {
    $cashflow_outflow[] = $row_outflow;
}


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
    $net_flow_data[] = $row_net_flow;
}



$sql_years = "SELECT DISTINCT year FROM cashflow";
$result_years = mysqli_query($link, $sql_years);
$years = array();
while ($row_year = mysqli_fetch_assoc($result_years)) {
    $years[] = $row_year['year'];
    sort($years);
}

