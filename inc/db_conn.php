<?php

$dbname = 'u871524642_qyea_v2';
$dbuser = 'u871524642_nanashi_v2';
$dbpass = 'Qyea871524642';
$dbhost = 'localhost';


$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$link) {
    echo "Connection to DB failed!";
} 

?>