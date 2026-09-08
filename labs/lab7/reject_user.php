<?php

include "auth.php";
include "db.php";


// Only admin can reject users
if ($_SESSION["user_role"] !== "admin") {

    header("Location: employee_dashboard.php");
    exit();

}


if (!isset($_GET["id"])) {

    header("Location: admin_users.php");
    exit();

}


$user_id = intval($_GET["id"]);


// Reject employee
$stmt = $conn->prepare(
    "UPDATE users
     SET status = 'rejected'
     WHERE id = ?
     AND role = 'employee'"
);

$stmt->bind_param("i", $user_id);

$stmt->execute();

$stmt->close();

$conn->close();


header("Location: admin_users.php");

exit();

?>