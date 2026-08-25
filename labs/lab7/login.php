<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login | TechNova Solutions</title>

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

        <a href="index.php">
            Home
        </a>

        <a href="index.php#about">
            About
        </a>

        <a href="index.php#services">
            Services
        </a>

        <a href="register.php">
            Registration
        </a>

    </nav>


    <a href="login.php"
       class="nav-button">

        Login

    </a>

</header>


<main class="auth-page">

    <div class="auth-container">


        <!-- Login Information -->

        <div class="auth-info">

            <span class="section-label">
                COMPANY PORTAL
            </span>

            <h1>
                Welcome
                <span>Back.</span>
            </h1>

            <p>

                Login to your TechNova account
                to access your company dashboard.

            </p>


            <div class="auth-feature">

                <strong>01</strong>

                <span>
                    Secure authentication
                </span>

            </div>


            <div class="auth-feature">

                <strong>02</strong>

                <span>
                    Role-based access
                </span>

            </div>


            <div class="auth-feature">

                <strong>03</strong>

                <span>
                    Protected company data
                </span>

            </div>

        </div>


        <!-- Login Form -->

        <div class="form-card">

            <h2>
                Sign In
            </h2>

            <p>
                Enter your account credentials.
            </p>


            <form
                action="login_process.php"
                method="POST">


                <label>
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    required>


                <label>
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required>


                <button type="submit">

                    Login →

                </button>

            </form>


            <p class="form-footer">

                Don't have an account?

                <a href="register.php">
                    Register here
                </a>

            </p>

        </div>

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