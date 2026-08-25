<?php

session_start();

include "db.php";


if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    exit();

}


/* Only employees can access this page */

if ($_SESSION["user_role"] !== "employee") {

    header("Location: login.php");
    exit();

}


/* Get administrator details */

$result = $conn->query(
    "SELECT id, name, email, created_at
     FROM users
     WHERE role = 'admin'
     ORDER BY id ASC"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Admin Details | TechNova</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>


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

        <a href="employee_dashboard.php">
            Dashboard
        </a>

        <a href="admin_details.php"
           class="active">
            Admin Details
        </a>

        <a href="logout.php">
            Logout
        </a>

    </nav>

</header>


<main class="records-page">

    <div class="records-header">

        <div>

            <span class="section-label">
                EMPLOYEE PORTAL
            </span>

            <h1>
                Admin Details
            </h1>

            <p>
                Administrator information of
                TechNova Solutions.
            </p>

        </div>


        <a href="employee_dashboard.php"
           class="back-button">

            ← Dashboard

        </a>

    </div>


    <div class="records-table-container">

        <table>

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Name</th>

                    <th>Email</th>

                    <th>Role</th>

                    <th>Joined</th>

                </tr>

            </thead>


            <tbody>

                <?php

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {

                ?>

                    <tr>

                        <td>
                            <?php echo $row["id"]; ?>
                        </td>

                        <td>
                            <?php

                            echo htmlspecialchars(
                                $row["name"]
                            );

                            ?>
                        </td>

                        <td>
                            <?php

                            echo htmlspecialchars(
                                $row["email"]
                            );

                            ?>
                        </td>

                        <td>

                            <span class="admin-badge">
                                Administrator
                            </span>

                        </td>

                        <td>
                            <?php

                            echo date(
                                "d M Y",
                                strtotime(
                                    $row["created_at"]
                                )
                            );

                            ?>
                        </td>

                    </tr>

                <?php

                    }

                } else {

                ?>

                    <tr>

                        <td colspan="5">

                            No administrator found.

                        </td>

                    </tr>

                <?php

                }

                ?>

            </tbody>

        </table>

    </div>

</main>


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

<?php

$conn->close();

?>