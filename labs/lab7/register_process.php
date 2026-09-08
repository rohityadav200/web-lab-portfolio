<?php

include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $role = $_POST["role"];


    // Basic validation
    if (empty($name) || empty($email) || empty($password) || empty($role)) {

        echo "<script>
                alert('Please fill all required fields.');
                window.location='register.php';
              </script>";

        exit();
    }


    // Check whether email already exists
    $check = $conn->prepare(
        "SELECT id FROM users WHERE email = ?"
    );

    $check->bind_param("s", $email);

    $check->execute();

    $result = $check->get_result();


    if ($result->num_rows > 0) {

        echo "<script>
                alert('Email already registered.');
                window.location='register.php';
              </script>";

        $check->close();
        $conn->close();

        exit();
    }

    $check->close();


    // Hash password
    $hashed_password = password_hash(
        $password,
        PASSWORD_DEFAULT
    );


    /*
        New users are automatically set to PENDING.

        Admin will approve the account later.
    */

    $stmt = $conn->prepare(
        "INSERT INTO users
        (name, email, password, role, status)
        VALUES (?, ?, ?, ?, 'pending')"
    );


    $stmt->bind_param(
        "ssss",
        $name,
        $email,
        $hashed_password,
        $role
    );


    if ($stmt->execute()) {

        echo "<script>
                alert('Registration successful! Your account is waiting for admin approval.');
                window.location='login.php';
              </script>";

    } else {

        echo "Registration failed: " . $stmt->error;

    }


    $stmt->close();
    $conn->close();

}

?>