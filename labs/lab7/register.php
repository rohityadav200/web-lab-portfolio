<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Employee Registration | TechNova</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<header class="navbar">

    <div class="brand">
        <span class="brand-icon">TN</span>
        <span>TechNova</span>
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

        <a href="login.php">
            Login
        </a>

    </nav>

    <a href="register.php"
       class="nav-button">

        Registration

    </a>

</header>


<main class="auth-page">

    <div class="auth-container">

        <div class="auth-info">

            <span class="section-label">
                JOIN TECHNOVA
            </span>

            <h1>
                Start Your
                <span>Journey.</span>
            </h1>

            <p>
                Register with TechNova Solutions to
                become part of our organization.
            </p>

            <div class="auth-feature">

                <strong>01</strong>

                <span>
                    Secure employee registration
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
                    Protected company information
                </span>

            </div>

        </div>


        <div class="form-card">

            <h2>
                Create Account
            </h2>

            <p>
                Enter your details below.
            </p>

            <form
                id="registrationForm"
                action="register_process.php"
                method="POST">


                <label>
                    Full Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Enter your full name"
                    required>


                <label>
                    Email Address
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    required>


                <label>
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimum 6 characters"
                    required>


                <label>
                    Confirm Password
                </label>

                <input
                    type="password"
                    id="confirm_password"
                    name="confirm_password"
                    placeholder="Re-enter password"
                    required>


                <label>
                    Account Type
                </label>

                <select
                    name="role"
                    required>

                    <option value="">
                        Select Account Type
                    </option>

                    <option value="employee">
                        Employee
                    </option>

                    <option value="admin">
                        Admin
                    </option>

                </select>


                <button
                    type="submit">

                    Create Account →

                </button>

            </form>


            <p class="form-footer">

                Already have an account?

                <a href="login.php">
                    Login here
                </a>

            </p>

        </div>

    </div>

</main>


<footer>

    <div class="footer-brand">

        <strong>TechNova</strong>

        <p>
            Technology • Innovation • Growth
        </p>

    </div>

    <p>
        © 2026 TechNova Solutions
    </p>

</footer>


<script src="script.js"></script>

</body>

</html>