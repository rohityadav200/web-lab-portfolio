<?php

session_start();

include "db.php";


if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: login.php");

    exit();

}


$email = trim($_POST["email"]);

$password = $_POST["password"];


$sql = $conn->prepare(
    "SELECT id, name, email, password, role
     FROM users
     WHERE email = ?"
);

$sql->bind_param("s", $email);

$sql->execute();

$result = $sql->get_result();


if ($result->num_rows === 1) {

    $user = $result->fetch_assoc();


    if (password_verify($password, $user["password"])) {


        /* Store user information in session */

        $_SESSION["user_id"] =
            $user["id"];

        $_SESSION["user_name"] =
            $user["name"];

        $_SESSION["user_email"] =
            $user["email"];

        $_SESSION["user_role"] =
            $user["role"];


        /* Role-based redirect */

        if ($user["role"] === "employee") {

            header(
                "Location: employee_dashboard.php"
            );

            exit();

        }


        if ($user["role"] === "admin") {

            header(
                "Location: admin_dashboard.php"
            );

            exit();

        }

    } else {

        echo "
        <script>

            alert('Invalid password.');

            window.location='login.php';

        </script>
        ";

        exit();

    }

} else {

    echo "
    <script>

        alert('No account found with this email.');

        window.location='login.php';

    </script>
    ";

    exit();

}


$sql->close();

$conn->close();

?>