<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - CS Department</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

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


    <section class="form-section">

        <div class="form-card">

            <h2>Student Login</h2>

            <p>
                Login to your department account
            </p>

            <form action="login_process.php" method="POST">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    required
                >


                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >


                <button type="submit">
                    Login
                </button>

            </form>


            <p class="login-link">

                Don't have an account?

                <a href="register.php">
                    Register here
                </a>

            </p>

        </div>

    </section>


    <footer>

        <p>
            © 2026 Computer Science Department |
            Internet & Web Technologies Lab
        </p>

    </footer>

</body>

</html>