<?php

include "db.php";

$result = $conn->query("SELECT * FROM contacts ORDER BY id DESC");

$total_contacts = $result->num_rows;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact Manager | ContactHub</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="dashboard">

    <!-- Sidebar -->

    <aside class="sidebar">

        <div class="logo">

            <div class="logo-icon">
                CM
            </div>

            <div>

                <h2>Contact<span>Hub</span></h2>

                <p>Management System</p>

            </div>

        </div>


        <nav>

            <a href="index.php" class="active">

                <span>▦</span>

                Dashboard

            </a>


            <a href="add.php">

                <span>＋</span>

                Add Contact

            </a>

        </nav>


        <div class="sidebar-bottom">

            <p>Internet & Web</p>

            <strong>Technologies Lab</strong>

        </div>

    </aside>



    <!-- Main Content -->

    <main class="main-content">


        <!-- Delete Message -->

        <?php if (isset($_GET["deleted"])): ?>

            <?php if ($_GET["deleted"] == "1"): ?>

                <div class="success-message">

                    ✓ Contact deleted successfully.

                </div>

            <?php else: ?>

                <div class="error-message">

                    ✕ Failed to delete contact.

                </div>

            <?php endif; ?>

        <?php endif; ?>



        <!-- Top Header -->

        <header class="top-header">

            <div>

                <p class="welcome">
                    CONTACT MANAGEMENT
                </p>

                <h1>
                    Dashboard
                </h1>

            </div>


            <a href="add.php" class="primary-btn">

                + Add Contact

            </a>

        </header>



        <!-- Statistics -->

        <section class="stats">


            <div class="stat-card">

                <div class="stat-icon">
                    👥
                </div>

                <div>

                    <p>
                        Total Contacts
                    </p>

                    <h2>
                        <?php echo $total_contacts; ?>
                    </h2>

                </div>

            </div>



            <div class="stat-card">

                <div class="stat-icon">
                    📇
                </div>

                <div>

                    <p>
                        Contact Records
                    </p>

                    <h2>
                        <?php echo $total_contacts; ?>
                    </h2>

                </div>

            </div>



            <div class="stat-card">

                <div class="stat-icon">
                    ✓
                </div>

                <div>

                    <p>
                        System Status
                    </p>

                    <h2 class="active-status">
                        Active
                    </h2>

                </div>

            </div>

        </section>



        <!-- Contacts -->

        <section class="contacts-card">


            <div class="section-header">

                <div>

                    <h2>
                        All Contacts
                    </h2>

                    <p>
                        Manage your saved contact information
                    </p>

                </div>


                <!-- Search -->

                <div class="search-box">

                    <span>
                        ⌕
                    </span>

                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Search contacts..."
                    >

                </div>

            </div>



            <?php if ($result->num_rows > 0): ?>


                <div class="table-wrapper">

                    <table id="contactsTable">


                        <thead>

                            <tr>

                                <th>
                                    ID
                                </th>

                                <th>
                                    CONTACT
                                </th>

                                <th>
                                    EMAIL
                                </th>

                                <th>
                                    PHONE
                                </th>

                                <th>
                                    ADDRESS
                                </th>

                                <th>
                                    ACTIONS
                                </th>

                            </tr>

                        </thead>



                        <tbody>


                        <?php while ($contact = $result->fetch_assoc()): ?>


                            <tr>


                                <!-- ID -->

                                <td>

                                    <span class="contact-id">

                                        #<?php echo $contact["id"]; ?>

                                    </span>

                                </td>



                                <!-- Name -->

                                <td>

                                    <div class="contact-name">


                                        <div class="avatar">

                                            <?php

                                            echo strtoupper(
                                                substr(
                                                    $contact["name"],
                                                    0,
                                                    1
                                                )
                                            );

                                            ?>

                                        </div>


                                        <strong>

                                            <?php

                                            echo htmlspecialchars(
                                                $contact["name"]
                                            );

                                            ?>

                                        </strong>


                                    </div>

                                </td>



                                <!-- Email -->

                                <td>

                                    <?php

                                    echo htmlspecialchars(
                                        $contact["email"]
                                    );

                                    ?>

                                </td>



                                <!-- Phone -->

                                <td>

                                    <?php

                                    echo htmlspecialchars(
                                        $contact["phone"]
                                    );

                                    ?>

                                </td>



                                <!-- Address -->

                                <td>

                                    <?php

                                    echo htmlspecialchars(
                                        $contact["address"]
                                    );

                                    ?>

                                </td>



                                <!-- Actions -->

                                <td>

                                    <div class="actions">


                                        <a
                                            href="edit.php?id=<?php echo $contact["id"]; ?>"
                                            class="edit-action"
                                        >

                                            Edit

                                        </a>



                                        <a
                                            href="delete.php?id=<?php echo $contact["id"]; ?>"
                                            class="delete-action"
                                            onclick="return confirm('Are you sure you want to delete this contact?');"
                                        >

                                            Delete

                                        </a>


                                    </div>

                                </td>


                            </tr>


                        <?php endwhile; ?>


                        </tbody>


                    </table>

                </div>


            <?php else: ?>


                <!-- Empty State -->

                <div class="empty-state">


                    <div class="empty-icon">
                        👤
                    </div>


                    <h3>
                        No Contacts Yet
                    </h3>


                    <p>
                        Start building your contact list by adding your first contact.
                    </p>


                    <a href="add.php" class="primary-btn">

                        + Add First Contact

                    </a>


                </div>


            <?php endif; ?>


        </section>



        <!-- Footer -->

        <footer>

            ContactHub · Internet & Web Technologies Lab · 2026

        </footer>


    </main>

</div>



<script src="script.js"></script>


</body>

</html>