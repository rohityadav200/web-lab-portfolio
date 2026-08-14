<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employee Registration</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="container">

        <div class="form-card">

            <h1>Employee Details</h1>

            <p class="subtitle">
                Enter employee information
            </p>

            <form action="insert.php" method="POST">

                <div class="form-group">

                    <label>Employee ID</label>

                    <input
                        type="text"
                        name="employee_id"
                        placeholder="Enter employee ID"
                        required>

                </div>


                <div class="form-group">

                    <label>Full Name</label>

                    <input
                        type="text"
                        name="full_name"
                        placeholder="Enter full name"
                        required>

                </div>


                <div class="form-group">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Enter email"
                        required>

                </div>


                <div class="form-group">

                    <label>Phone</label>

                    <input
                        type="tel"
                        name="phone"
                        placeholder="Enter phone number">

                </div>


                <div class="form-group">

                    <label>Gender</label>

                    <select name="gender">

                        <option value="">Select Gender</option>

                        <option value="Male">Male</option>

                        <option value="Female">Female</option>

                        <option value="Other">Other</option>

                    </select>

                </div>


                <div class="form-group">

                    <label>Date of Birth</label>

                    <input
                        type="date"
                        name="dob">

                </div>


                <div class="form-group">

                    <label>Department</label>

                    <select name="department">

                        <option value="">Select Department</option>

                        <option value="IT">IT</option>

                        <option value="HR">HR</option>

                        <option value="Finance">Finance</option>

                        <option value="Marketing">Marketing</option>

                        <option value="Sales">Sales</option>

                    </select>

                </div>


                <div class="form-group">

                    <label>Designation</label>

                    <input
                        type="text"
                        name="designation"
                        placeholder="Enter designation">

                </div>


                <div class="form-group">

                    <label>Salary</label>

                    <input
                        type="number"
                        name="salary"
                        placeholder="Enter salary"
                        step="0.01">

                </div>


                <div class="form-group">

                    <label>Address</label>

                    <textarea
                        name="address"
                        placeholder="Enter employee address"
                        rows="4"></textarea>

                </div>


                <button type="submit">

                    Register Employee

                </button>

            </form>

        </div>

    </div>

</body>

</html>