<?php

include "auth.php";


// Only admin can access this page
if ($_SESSION["user_role"] !== "admin") {

    header("Location: employee_dashboard.php");
    exit();

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard | TechNova</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>


<!-- ================= NAVIGATION ================= -->

<header class="navbar">

    <div class="brand">

        <span class="brand-icon">
            TN
        </span>

        <span>
            TechNova
        </span>

    </div>


    <nav>

        <a href="index.php">
            Home
        </a>

        <a href="admin_dashboard.php"
           class="active">
            Dashboard
        </a>

        <a href="logout.php">
            Logout
        </a>

    </nav>

</header>



<!-- ================= ADMIN DASHBOARD ================= -->

<main class="dashboard">


    <!-- Dashboard Header -->

    <div class="dashboard-header">

        <div>

            <span class="section-label">
                ADMIN PORTAL
            </span>

            <h1>

                Welcome,
                <?php

                echo htmlspecialchars(
                    $_SESSION["user_name"]
                );

                ?>

            </h1>

            <p>
                Manage and view TechNova
                employee information.
            </p>

        </div>


        <a href="logout.php"
           class="dashboard-logout">

            Logout

        </a>

    </div>



    <!-- ================= DASHBOARD CARDS ================= -->

    <div class="dashboard-grid">


        <!-- ================= CARD 01 ================= -->

        <div class="dashboard-card">

            <span class="card-number">
                01
            </span>


            <h2>
                Admin Profile
            </h2>


            <p>
                Your administrator account
                information.
            </p>


            <div class="profile-details">

                <p>

                    <strong>
                        Name:
                    </strong>

                    <?php

                    echo htmlspecialchars(
                        $_SESSION["user_name"]
                    );

                    ?>

                </p>


                <p>

                    <strong>
                        Email:
                    </strong>

                    <?php

                    echo htmlspecialchars(
                        $_SESSION["user_email"]
                    );

                    ?>

                </p>


                <p>

                    <strong>
                        Role:
                    </strong>

                    Administrator

                </p>

            </div>

        </div>



        <!-- ================= CARD 02 ================= -->

        <div class="dashboard-card admin-card">

            <span class="card-number">
                02
            </span>


            <h2>
                Employee Details
            </h2>


            <p>
                View the registered employees
                of TechNova Solutions.
            </p>


            <a href="employee_details.php"
               class="dashboard-button">

                View Employee Details →

            </a>

        </div>



        <!-- ================= CARD 03 ================= -->

        <div class="dashboard-card approval-card">

            <span class="card-number">
                03
            </span>


            <h2>
                User Approvals
            </h2>


            <p>
                Review employee registrations
                and approve or reject accounts.
            </p>


            <a href="admin_users.php"
               class="dashboard-button">

                Manage User Approvals →

            </a>

        </div>


    </div>


</main>



<!-- ================= FOOTER ================= -->

<footer>

    <div class="footer-brand">

        <strong>
            TechNova
        </strong>

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