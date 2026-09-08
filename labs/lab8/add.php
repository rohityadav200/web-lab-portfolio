<?php

include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $address = trim($_POST["address"]);

    if ($name === "" || $email === "" || $phone === "") {

        echo "<script>
                alert('Please fill all required fields.');
                window.history.back();
              </script>";
        exit();
    }

    $stmt = $conn->prepare(
        "INSERT INTO contacts (name, email, phone, address)
         VALUES (?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "ssss",
        $name,
        $email,
        $phone,
        $address
    );

    if ($stmt->execute()) {

        echo "<script>
                alert('Contact added successfully!');
                window.location='index.php';
              </script>";

    } else {

        echo "<script>
                alert('Failed to add contact.');
                window.history.back();
              </script>";
    }

    $stmt->close();
    $conn->close();

    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Contact | ContactHub</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="form-page">

    <div class="form-container">

        <a href="index.php" class="back-link">
            ← Back to Dashboard
        </a>

        <div class="form-card">

            <div class="form-header">

                <div class="form-icon">
                    +
                </div>

                <div>
                    <p class="form-label">CONTACT MANAGEMENT</p>

                    <h1>Add New Contact</h1>

                    <p>
                        Create a new contact record.
                    </p>
                </div>

            </div>


            <form method="POST">

                <div class="form-group">

                    <label for="name">
                        Full Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="e.g. Rohit Yadav"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="email">
                        Email Address
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="e.g. rohit@gmail.com"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="phone">
                        Phone Number
                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        placeholder="10-digit phone number"
                        maxlength="10"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="address">
                        Address
                    </label>

                    <textarea
                        id="address"
                        name="address"
                        placeholder="Enter contact address"
                        rows="4"
                    ></textarea>

                </div>


                <div class="form-actions">

                    <button type="submit" class="save-btn">
                        Save Contact
                    </button>

                    <a href="index.php" class="cancel-btn">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>


<script src="script.js"></script>

</body>

</html>