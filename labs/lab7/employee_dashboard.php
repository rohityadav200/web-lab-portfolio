<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION["user_role"] !== "employee") {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Employee Dashboard | TechNova</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<header class="navbar">

    <div class="brand">

        <span class="brand-icon">TN</span>

        <span>TechNova</span>

    </div>

    <nav>

        <a href="index.php">Home</a>

        <a href="employee_dashboard.php"
           class="active">
            Dashboard
        </a>

        <a href="logout.php">
            Logout
        </a>

    </nav>

</header>


<main class="dashboard">

    <div class="dashboard-header">

        <div>

            <span class="section-label">
                EMPLOYEE PORTAL
            </span>

            <h1>
                Welcome,
                <?php echo htmlspecialchars($_SESSION["user_name"]); ?>
            </h1>

            <p>
                This is your TechNova employee dashboard.
            </p>

        </div>

        <a href="logout.php"
           class="dashboard-logout">
            Logout
        </a>

    </div>


    <div class="dashboard-grid">


        <div class="dashboard-card">

            <span class="card-number">
                01
            </span>

            <h2>
                My Profile
            </h2>

            <p>
                View your registered account information.
            </p>

            <div class="profile-details">

                <p>
                    <strong>Name:</strong>
                    <?php
                    echo htmlspecialchars(
                        $_SESSION["user_name"]
                    );
                    ?>
                </p>

                <p>
                    <strong>Email:</strong>
                    <?php
                    echo htmlspecialchars(
                        $_SESSION["user_email"]
                    );
                    ?>
                </p>

                <p>
                    <strong>Role:</strong>
                    Employee
                </p>

            </div>

        </div>


        <div class="dashboard-card admin-card">

            <span class="card-number">
                02
            </span>

            <h2>
                Admin Details
            </h2>

            <p>
                Access administrator information
                as required by the Lab 7 specification.
            </p>

            <a href="admin_details.php"
               class="dashboard-button">

                View Admin Details →

            </a>

        </div>


    </div>

</main>


<footer>

    <div class="footer-brand">

        <strong>TechNova</strong>

        <p>
            Technology • Innovation • Growth
        </p>

    </div>

    <p>
        © 2026 TechNova Solutions
    </p>

</footer>

</body>

</html>