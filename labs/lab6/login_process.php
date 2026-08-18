<?php

session_start();

include "db.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);

    $password = $_POST["password"];


    $sql = "SELECT id, name, email, password, course
            FROM users
            WHERE email = ?";


    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $email);

    $stmt->execute();


    $result = $stmt->get_result();


    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();


        if (password_verify($password, $user["password"])) {

            $_SESSION["user_id"] = $user["id"];

            $_SESSION["user_name"] = $user["name"];

            $_SESSION["user_email"] = $user["email"];

            $_SESSION["user_course"] = $user["course"];


            header("Location: dashboard.php");

            exit();

        } else {

            echo "Invalid email or password.";

        }

    } else {

        echo "Invalid email or password.";

    }


    $stmt->close();

}


$conn->close();

?>