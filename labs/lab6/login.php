<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta
        name="description"
        content="Student login portal for the Computer Science Department."
    >

    <title>Login | CS Department</title>

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
         LOGIN SECTION
    ========================== -->

    <section class="form-section">


        <div class="form-card">


            <!-- Login Header -->

            <div class="form-header">

                <div class="form-icon">
                    🔐
                </div>


                <span class="section-tag">
                    STUDENT PORTAL
                </span>


                <h2>
                    Welcome Back
                </h2>


                <p>
                    Login to access your Computer Science
                    Department account.
                </p>

            </div>



            <!-- Login Form -->

            <form
                action="login_process.php"
                method="POST"
            >


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
                        placeholder="Enter your password"
                        autocomplete="current-password"
                        required
                    >

                </div>



                <!-- Login Button -->

                <button type="submit">
                    Login to Account →
                </button>


            </form>



            <!-- Registration Link -->

            <p class="login-link">

                Don't have an account?

                <a href="register.php">
                    Create an account
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


</body>

</html>