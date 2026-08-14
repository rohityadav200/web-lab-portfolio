<?php

include "db.php";

$sql = "SELECT * FROM employees ORDER BY id DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employee Records</title>

   <link rel="stylesheet" href="records.css">

</head>

<body>

<div class="records-container">

    <div class="records-card">

        <h1>Employee Records</h1>

        <p class="subtitle">
            Registered Employee Details
        </p>

        <?php if ($result && $result->num_rows > 0): ?>

        <div class="table-wrapper">

            <table class="employee-table">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Employee ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Salary</th>
                        <th>Address</th>
                    </tr>

                </thead>

                <tbody>

                    <?php while ($row = $result->fetch_assoc()): ?>

                    <tr>

                        <td>
                            <?php echo htmlspecialchars($row["id"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row["employee_id"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row["full_name"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row["email"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row["phone"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row["gender"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row["dob"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row["department"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row["designation"]); ?>
                        </td>

                        <td>
                            ₹<?php echo htmlspecialchars($row["salary"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row["address"]); ?>
                        </td>

                    </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>

        </div>

        <?php else: ?>

            <p class="no-records">
                No employee records found.
            </p>

        <?php endif; ?>

        <div class="record-buttons">

            <a href="index.html" class="back-btn">
                + Add New Employee
            </a>

        </div>

    </div>

</div>

<?php

$conn->close();

?>

</body>

</html>