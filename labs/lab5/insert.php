<?php

include "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request. Please submit the employee form.");
}

$employee_id = $_POST["employee_id"] ?? "";
$full_name = $_POST["full_name"] ?? "";
$email = $_POST["email"] ?? "";
$phone = $_POST["phone"] ?? "";
$gender = $_POST["gender"] ?? "";
$dob = $_POST["dob"] ?? "";
$department = $_POST["department"] ?? "";
$designation = $_POST["designation"] ?? "";
$salary = $_POST["salary"] ?? "";
$address = $_POST["address"] ?? "";

$sql = "INSERT INTO employees
(employee_id, full_name, email, phone, gender, dob, department, designation, salary, address)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("SQL Prepare Error: " . $conn->error);
}

$stmt->bind_param(
    "ssssssssds",
    $employee_id,
    $full_name,
    $email,
    $phone,
    $gender,
    $dob,
    $department,
    $designation,
    $salary,
    $address
);

if ($stmt->execute()) {

    echo "<h2 style='text-align:center; margin-top:50px; color:green;'>
            Employee added successfully!
          </h2>";

    echo "<p style='text-align:center;'>
            <a href='index.html'>Add another employee</a>
          </p>";

} else {

    echo "<h2 style='color:red;'>Insert Error</h2>";
    echo "<p>" . $stmt->error . "</p>";
}

$stmt->close();
$conn->close();

?>