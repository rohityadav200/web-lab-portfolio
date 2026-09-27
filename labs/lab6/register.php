<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta
        name="description"
        content="Student registration for the Computer Science Department."
    >

    <title>Registration | CS Department</title>

    <link rel="stylesheet" href="style.css">

</head>


<body>


    <!-- =========================
         NAVIGATION
    ========================== -->

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
                <a href="register.php">Registration</a>
            </li>

            <li>
                <a href="login.php">Login</a>
            </li>

        </ul>

    </nav>



    <!-- =========================
         REGISTRATION SECTION
    ========================== -->

    <section class="form-section">


        <div class="form-card">


            <!-- Form Header -->

            <div class="form-header">

                <div class="form-icon">
                    🎓
                </div>


                <span class="section-tag">
                    STUDENT PORTAL
                </span>


                <h2>
                    Create Your Account
                </h2>


                <p>
                    Register with the Computer Science Department
                    to access the student portal.
                </p>

            </div>



            <!-- Registration Form -->

            <form
                action="register_process.php"
                method="POST"
                id="registrationForm"
            >


                <!-- Full Name -->

                <div class="form-group">

                    <label for="name">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Enter your full name"
                        autocomplete="name"
                        required
                    >

                </div>



                <!-- Email -->

                <div class="form-group">

                    <label for="email">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="Enter your email"
                        autocomplete="email"
                        required
                    >

                </div>



                <!-- Password -->

                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Create a password"
                        autocomplete="new-password"
                        required
                    >

                </div>



                <!-- Confirm Password -->

                <div class="form-group">

                    <label for="confirm_password">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="confirm_password"
                        id="confirm_password"
                        placeholder="Confirm your password"
                        autocomplete="new-password"
                        required
                    >

                </div>



                <!-- Course -->

                <div class="form-group">

                    <label for="course">
                        Course
                    </label>

                    <select
                        name="course"
                        id="course"
                        required
                    >

                        <option value="">
                            Select Course
                        </option>

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

                </div>



                <!-- Submit -->

                <button type="submit">
                    Create Account →
                </button>


            </form>



            <!-- Login -->

            <p class="login-link">

                Already registered?

                <a href="login.php">
                    Login here
                </a>

            </p>


        </div>

    </section>



    <!-- =========================
         FOOTER
    ========================== -->

    <footer>

        <div class="footer-content">


            <div class="footer-brand">

                <h3>
                    CS Department
                </h3>

                <p>
                    Computer Science Department
                </p>

            </div>


            <div class="footer-links">

                <a href="index.php">
                    Home
                </a>

                <a href="about.php">
                    About
                </a>

                <a href="register.php">
                    Registration
                </a>

                <a href="login.php">
                    Login
                </a>

            </div>

        </div>


        <div class="footer-bottom">

            <p>
                © 2026 Computer Science Department
                | Internet & Web Technologies Lab
            </p>

        </div>

    </footer>



    <script src="script.js"></script>

</body>

</html>