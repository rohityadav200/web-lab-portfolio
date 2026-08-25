<?php

include "db.php";


if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: register.php");

    exit();

}


$name = trim($_POST["name"]);
$email = trim($_POST["email"]);
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];
$role = $_POST["role"];


/* Check password */

if ($password !== $confirm_password) {

    die("Error: Passwords do not match.");

}


if (strlen($password) < 6) {

    die("Error: Password must contain at least 6 characters.");

}


/* Check role */

if ($role !== "employee" && $role !== "admin") {

    die("Error: Invalid account type.");

}


/* Check existing email */

$check = $conn->prepare(
    "SELECT id FROM users WHERE email = ?"
);

$check->bind_param("s", $email);

$check->execute();

$result = $check->get_result();


if ($result->num_rows > 0) {

    die("Error: This email is already registered.");

}


/* Hash password */

$hashed_password = password_hash(
    $password,
    PASSWORD_DEFAULT
);


/* Insert user */

$sql = $conn->prepare(
    "INSERT INTO users
    (name, email, password, role)
    VALUES (?, ?, ?, ?)"
);

$sql->bind_param(
    "ssss",
    $name,
    $email,
    $hashed_password,
    $role
);


if ($sql->execute()) {

    echo "
    <!DOCTYPE html>

    <html>

    <head>

        <title>Registration Successful</title>

        <link rel='stylesheet'
              href='style.css'>

    </head>

    <body>

        <main class='auth-page'>

            <div class='form-card'
                 style='max-width:500px; text-align:center;'>

                <h2>
                    Registration Successful!
                </h2>

                <p>
                    Your TechNova account has been
                    created successfully.
                </p>

                <a href='login.php'
                   class='primary-button'>

                    Continue to Login →

                </a>

            </div>

        </main>

    </body>

    </html>
    ";

} else {

    echo "Error: " . $conn->error;

}


$check->close();

$sql->close();

$conn->close();

?>