<?php
include ('db_conn.php');

// Retrieve Inflow Data Tables
$sql_inflow = "SELECT * FROM cashflow WHERE type = 'INFLOW' ORDER BY year ASC ";
$result_inflow = mysqli_query($link, $sql_inflow);
$cashflow_inflow = array();
while ($row_inflow = mysqli_fetch_assoc($result_inflow)) {
    $cashflow_inflow[] = $row_inflow;
}

// Retrieve Outflow Data Tables
$sql_outflow = "SELECT * FROM cashflow WHERE type = 'OUTFLOW' ORDER BY year ASC";
$result_outflow = mysqli_query($link, $sql_outflow);
$cashflow_outflow = array();
while ($row_outflow = mysqli_fetch_assoc($result_outflow)) {
    $cashflow_outflow[] = $row_outflow;
}

// Retrieve year selection
$sql_years = "SELECT DISTINCT year FROM cashflow";
$result_years = mysqli_query($link, $sql_years);
$years = array();
while ($row_year = mysqli_fetch_assoc($result_years)) {
    $years[] = $row_year['year'];
    sort($years);
}
