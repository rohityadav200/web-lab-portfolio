<?php

include "auth.php";
include "db.php";


// Only admin can access this page
if ($_SESSION["user_role"] !== "admin") {

    header("Location: employee_dashboard.php");
    exit();

}


// Get all users except the currently logged-in admin
$result = $conn->query(
    "SELECT id, name, email, role, status, created_at
     FROM users
     WHERE id != " . intval($_SESSION["user_id"]) . "
     ORDER BY id DESC"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>User Management | TechNova</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="admin-users-page">

    <div class="admin-users-header">

        <div>
            <span class="section-label">
                ADMINISTRATION
            </span>

            <h1>User Management</h1>

            <p>
                Review and manage employee registrations.
            </p>
        </div>

        <a href="admin_dashboard.php"
           class="back-button">

            ← Dashboard

        </a>

    </div>


    <div class="users-card">

        <div class="table-header">

            <h2>Registered Users</h2>

            <span>
                Admin Approval
            </span>

        </div>


        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>

                <?php

                if ($result->num_rows > 0):

                    while ($user = $result->fetch_assoc()):

                ?>

                    <tr>

                        <td>
                            <?php echo $user["id"]; ?>
                        </td>

                        <td>
                            <strong>
                                <?php
                                echo htmlspecialchars($user["name"]);
                                ?>
                            </strong>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars($user["email"]);
                            ?>
                        </td>

                        <td>
                            <?php
                            echo ucfirst(
                                htmlspecialchars($user["role"])
                            );
                            ?>
                        </td>

                        <td>

                            <span class="user-status
                                <?php
                                echo htmlspecialchars(
                                    $user["status"]
                                );
                                ?>">

                                <?php
                                echo ucfirst(
                                    htmlspecialchars(
                                        $user["status"]
                                    )
                                );
                                ?>

                            </span>

                        </td>


                        <td>

                            <?php if ($user["status"] === "pending"): ?>

                                <a
                                    href="approve_user.php?id=<?php echo $user["id"]; ?>"
                                    class="approve-button"
                                    onclick="return confirm('Approve this user?');"
                                >
                                    Approve
                                </a>

                                <a
                                    href="reject_user.php?id=<?php echo $user["id"]; ?>"
                                    class="reject-button"
                                    onclick="return confirm('Reject this user?');"
                                >
                                    Reject
                                </a>

                            <?php elseif ($user["status"] === "approved"): ?>

                                <a
                                    href="reject_user.php?id=<?php echo $user["id"]; ?>"
                                    class="reject-button"
                                    onclick="return confirm('Reject this user?');"
                                >
                                    Reject
                                </a>

                            <?php elseif ($user["status"] === "rejected"): ?>

                                <a
                                    href="approve_user.php?id=<?php echo $user["id"]; ?>"
                                    class="approve-button"
                                    onclick="return confirm('Approve this user?');"
                                >
                                    Approve
                                </a>

                            <?php endif; ?>

                        </td>

                    </tr>

                <?php

                    endwhile;

                else:

                ?>

                    <tr>

                        <td colspan="6"
                            class="no-users">

                            No registered users found.

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>


    <div class="admin-users-footer">

        <a href="logout.php">
            Logout
        </a>

    </div>

</div>

</body>

</html>

<?php

$conn->close();

?>