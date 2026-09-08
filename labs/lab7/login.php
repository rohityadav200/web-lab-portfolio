<?php
session_start();

// Show messages coming from login_process.php
$error = "";

if (isset($_GET["error"])) {

    if ($_GET["error"] === "pending") {
        $error = "Your account is waiting for admin approval.";
    }

    if ($_GET["error"] === "rejected") {
        $error = "Your account has been rejected by the administrator.";
    }
}
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

    <div class="login-page">

        <div class="login-card">

            <div class="login-logo">
                TN
            </div>

            <h1>Welcome Back</h1>

            <p class="login-subtitle">
                Login to your TechNova account
            </p>


            <?php if (!empty($error)): ?>

                <div class="login-error">
                    <?php echo htmlspecialchars($error); ?>
                </div>

            <?php endif; ?>


            <form action="login_process.php"
                  method="POST">


                <div class="form-group">

                    <label for="email">
                        Email Address
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >

                </div>


                <button type="submit"
                        class="login-button">

                    Login

                </button>

            </form>


            <div class="login-footer">

                <p>
                    Don't have an account?
                    <a href="register.php">
                        Register
                    </a>
                </p>

                <a href="index.php">
                    ← Back to Website
                </a>

            </div>

        </div>

    </div>

</body>

</html>