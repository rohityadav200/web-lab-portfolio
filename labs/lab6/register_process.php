<?php

include "db.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);

    $email = trim($_POST["email"]);

    $password = $_POST["password"];

    $confirm_password = $_POST["confirm_password"];

    $course = $_POST["course"];


    // Check passwords

    if ($password !== $confirm_password) {

        die("Passwords do not match.");

    }


    // Hash password

    $hashed_password = password_hash(
        $password,
        PASSWORD_DEFAULT
    );


    // Insert data

    $sql = "INSERT INTO users
            (name, email, password, course)
            VALUES (?, ?, ?, ?)";


    $stmt = $conn->prepare($sql);


    $stmt->bind_param(
        "ssss",
        $name,
        $email,
        $hashed_password,
        $course
    );


    if ($stmt->execute()) {

        echo "
        <h2>Registration Successful!</h2>

        <p>Your account has been created successfully.</p>

        <a href='login.php'>
            Go to Login
        </a>
        ";

    } else {

        echo "Error: " . $stmt->error;

    }


    $stmt->close();

}


$conn->close();

?>