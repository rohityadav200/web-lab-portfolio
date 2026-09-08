<?php

include "db.php";

if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit();
}

$id = intval($_GET["id"]);

/* Fetch existing contact */
$stmt = $conn->prepare("SELECT * FROM contacts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: index.php");
    exit();
}

$contact = $result->fetch_assoc();

$stmt->close();


/* Update contact */
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
        "UPDATE contacts
         SET name = ?, email = ?, phone = ?, address = ?
         WHERE id = ?"
    );

    $stmt->bind_param(
        "ssssi",
        $name,
        $email,
        $phone,
        $address,
        $id
    );

    if ($stmt->execute()) {

        echo "<script>
                alert('Contact updated successfully!');
                window.location='index.php';
              </script>";

    } else {

        echo "<script>
                alert('Failed to update contact.');
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

    <title>Edit Contact | ContactHub</title>

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
                    ✎
                </div>

                <div>

                    <p class="form-label">
                        CONTACT MANAGEMENT
                    </p>

                    <h1>Edit Contact</h1>

                    <p>
                        Update the contact information.
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
                        value="<?php echo htmlspecialchars($contact["name"]); ?>"
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
                        value="<?php echo htmlspecialchars($contact["email"]); ?>"
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
                        value="<?php echo htmlspecialchars($contact["phone"]); ?>"
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
                        rows="4"
                        placeholder="Enter contact address"
                    ><?php echo htmlspecialchars($contact["address"]); ?></textarea>

                </div>


                <div class="form-actions">

                    <button type="submit" class="save-btn">
                        Update Contact
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