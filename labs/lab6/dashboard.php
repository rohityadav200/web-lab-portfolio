<?php

session_start();


if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");

    exit();

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - CS Department</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <nav class="navbar">

        <div class="logo">
            CS Department
        </div>

        <ul class="nav-links">

            <li>
                <a href="index.php">Home</a>
            </li>

            <li>
                <a href="about.php">About Us</a>
            </li>

            <li>
                <a href="dashboard.php">Dashboard</a>
            </li>

            <li>
                <a href="logout.php">Logout</a>
            </li>

        </ul>

    </nav>


    <section class="form-section">

        <div class="form-card">

            <h2>
                Welcome,
                <?php echo htmlspecialchars($_SESSION["user_name"]); ?>!
            </h2>

            <p>
                You have successfully logged in to the
                Computer Science Department portal.
            </p>


            <hr>


            <h3>Student Details</h3>

            <p>
                <strong>Name:</strong>
                <?php echo htmlspecialchars($_SESSION["user_name"]); ?>
            </p>

            <p>
                <strong>Email:</strong>
                <?php echo htmlspecialchars($_SESSION["user_email"]); ?>
            </p>

            <p>
                <strong>Course:</strong>
                <?php echo htmlspecialchars($_SESSION["user_course"]); ?>
            </p>


            <a href="logout.php" class="btn">
                Logout
            </a>

        </div>

    </section>


    <footer>

        <p>
            © 2026 Computer Science Department |
            Internet & Web Technologies Lab
        </p>

    </footer>

</body>

</html>