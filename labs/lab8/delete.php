<?php

include "db.php";

if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit();
}

$id = intval($_GET["id"]);

$stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {

    $stmt->close();
    $conn->close();

    header("Location: index.php?deleted=1");
    exit();

} else {

    $stmt->close();
    $conn->close();

    header("Location: index.php?deleted=0");
    exit();
}

?>