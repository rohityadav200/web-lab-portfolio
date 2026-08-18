<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration - CS Department</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <nav class="navbar">

        <div class="logo">
            CS Department
        </div>

        <ul class="nav-links">

            <li><a href="index.php">Home</a></li>

            <li><a href="about.php">About Us</a></li>

            <li><a href="register.php">Registration</a></li>

            <li><a href="login.php">Login</a></li>

        </ul>

    </nav>


    <section class="form-section">

        <div class="form-card">

            <h2>Student Registration</h2>

            <p>Register for the Computer Science Department</p>

            <form action="register_process.php" method="POST" id="registrationForm">

                <label>Full Name</label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    placeholder="Enter your full name"
                    required
                >


                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Enter your email"
                    required
                >


                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Create a password"
                    required
                >


                <label>Confirm Password</label>

                <input
                    type="password"
                    name="confirm_password"
                    id="confirm_password"
                    placeholder="Confirm your password"
                    required
                >


                <label>Course</label>

                <select name="course" required>

                    <option value="">Select Course</option>

                    <option value="MCA">
                        MCA
                    </option>

                    <option value="BCA">
                        BCA
                    </option>

                    <option value="MSc Computer Science">
                        MSc Computer Science
                    </option>

                </select>


                <button type="submit">
                    Register
                </button>

            </form>

            <p class="login-link">
                Already registered?
                <a href="login.php">Login here</a>
            </p>

        </div>

    </section>


    <footer>

        <p>
            © 2026 Computer Science Department |
            Internet & Web Technologies Lab
        </p>

    </footer>


    <script src="script.js"></script>

</body>

</html>