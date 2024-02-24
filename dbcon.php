<?php

$host = "localhost";
$reg_id = "root";
$password = "";
$database = "pms_db";

$con = mysqli_connect($host, $reg_id, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


?>