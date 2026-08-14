<?php

$servername = "localhost";
$username = "root";
$password = "rohit@@224466";
$database = "employee_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>