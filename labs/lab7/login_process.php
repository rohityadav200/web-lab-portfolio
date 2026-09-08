<?php

include "db.php";

session_start();


// Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit();
}


// Get login details
$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";


// Validate input
if (empty($email) || empty($password)) {

    echo "<script>
            alert('Please enter email and password.');
            window.location='login.php';
          </script>";

    exit();
}


// Find user by email
$stmt = $conn->prepare(
    "SELECT id, name, email, password, role, status
     FROM users
     WHERE email = ?"
);

$stmt->bind_param("s", $email);

$stmt->execute();

$result = $stmt->get_result();


// User not found
if ($result->num_rows === 0) {

    $stmt->close();
    $conn->close();

    echo "<script>
            alert('Invalid email or password.');
            window.location='login.php';
          </script>";

    exit();
}


// Get user information
$user = $result->fetch_assoc();


// Verify password
if (!password_verify($password, $user["password"])) {

    $stmt->close();
    $conn->close();

    echo "<script>
            alert('Invalid email or password.');
            window.location='login.php';
          </script>";

    exit();
}


// Check account status
if ($user["status"] === "pending") {

    $stmt->close();
    $conn->close();

    echo "<script>
            alert('Your account is waiting for admin approval.');
            window.location='login.php';
          </script>";

    exit();
}


if ($user["status"] === "rejected") {

    $stmt->close();
    $conn->close();

    echo "<script>
            alert('Your account has been rejected by the administrator.');
            window.location='login.php';
          </script>";

    exit();
}


// Only approved users reach this point
if ($user["status"] !== "approved") {

    $stmt->close();
    $conn->close();

    echo "<script>
            alert('Your account is not approved.');
            window.location='login.php';
          </script>";

    exit();
}


// Regenerate session ID for security
session_regenerate_id(true);


// Create session
$_SESSION["user_id"] = $user["id"];

$_SESSION["user_name"] = $user["name"];

$_SESSION["user_email"] = $user["email"];

$_SESSION["user_role"] = $user["role"];

$_SESSION["user_status"] = $user["status"];


// Close database
$stmt->close();
$conn->close();


// Redirect according to role
if ($user["role"] === "admin") {

    header("Location: admin_dashboard.php");
    exit();
}


if ($user["role"] === "employee") {

    header("Location: employee_dashboard.php");
    exit();
}


// Invalid role
session_unset();
session_destroy();

echo "<script>
        alert('Invalid user role.');
        window.location='login.php';
      </script>";

exit();

?>