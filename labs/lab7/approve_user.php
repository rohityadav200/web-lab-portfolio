<?php

include "auth.php";
include "db.php";


// Only admin can approve users
if ($_SESSION["user_role"] !== "admin") {

    header("Location: employee_dashboard.php");
    exit();

}


if (!isset($_GET["id"])) {

    header("Location: admin_users.php");
    exit();

}


$user_id = intval($_GET["id"]);


// Approve user
$stmt = $conn->prepare(
    "UPDATE users
     SET status = 'approved'
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