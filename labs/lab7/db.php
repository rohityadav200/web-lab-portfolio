<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "sql105.infinityfree.com";
$username = "if0_43301884";
$password = "Rohitmca2002";
$database = "if0_43301884_lab7";

$conn = new mysqli($host, $username, $password, $database);
$conn->set_charset("utf8mb4");
?>