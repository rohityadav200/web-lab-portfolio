<?php
include "auth.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TechNova Solutions</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Navigation -->

    <header class="navbar">

        <div class="brand">
            <span class="brand-icon">TN</span>
            <span>TechNova</span>
        </div>

        <nav>
            <a href="index.php" class="active">Home</a>
            <a href="#about">About</a>
            <a href="#services">Services</a>
            <a href="#portal">Portal</a>
            <a href="login.php">Login</a>
        </nav>

        <a href="register.php" class="nav-button">
            Join Company
        </a>

    </header>


    <!-- Hero Section -->

    <section class="hero">

        <div class="hero-content">

            <span class="tagline">
                TECHNOLOGY • INNOVATION • GROWTH
            </span>

            <h1>
                Building the
                <span>Future</span>
                Through Technology.
            </h1>

            <p>
                TechNova Solutions delivers modern software,
                web and database solutions that help businesses
                grow faster and work smarter.
            </p>

            <div class="hero-buttons">

                <a href="#services" class="primary-button">
                    Explore Services →
                </a>

                <a href="login.php" class="secondary-button">
                    Company Portal
                </a>

            </div>

        </div>


        <div class="hero-visual">

            <div class="visual-box">

                <div class="visual-top">
                    <span>TECHNOVA</span>
                    <span>2026</span>
                </div>

                <div class="circle">
                    TN
                </div>

                <h3>
                    Digital Solutions
                </h3>

                <p>
                    Transforming ideas into
                    powerful digital experiences.
                </p>

            </div>

        </div>

    </section>


    <!-- Statistics -->

    <section class="stats">

        <div class="stat">
            <strong>50+</strong>
            <span>Projects Delivered</span>
        </div>

        <div class="stat">
            <strong>20+</strong>
            <span>Team Members</span>
        </div>

        <div class="stat">
            <strong>10+</strong>
            <span>Technology Experts</span>
        </div>

        <div class="stat">
            <strong>5+</strong>
            <span>Years Experience</span>
        </div>

    </section>


    <!-- About -->

    <section id="about" class="about">

        <div class="section-label">
            WHO WE ARE
        </div>

        <h2>
            Technology built around
            <span>your business.</span>
        </h2>

        <p class="about-text">

            TechNova Solutions is a technology-driven organization
            focused on developing reliable and innovative digital
            solutions. Our employees work together to solve
            real-world business problems using modern technologies.

        </p>

    </section>


    <!-- Services -->

    <section id="services" class="services">

        <div class="section-heading">

            <div>
                <span class="section-label">
                    WHAT WE DO
                </span>

                <h2>
                    Our Core Services
                </h2>
            </div>

            <p>
                Professional technology services designed
                for modern organizations.
            </p>

        </div>


        <div class="service-list">

            <div class="service">

                <div class="service-number">
                    01
                </div>

                <div>
                    <h3>Web Development</h3>

                    <p>
                        Responsive and modern websites
                        for businesses and organizations.
                    </p>
                </div>

                <span class="arrow">↗</span>

            </div>


            <div class="service">

                <div class="service-number">
                    02
                </div>

                <div>
                    <h3>Software Development</h3>

                    <p>
                        Customized software applications
                        designed around business requirements.
                    </p>
                </div>

                <span class="arrow">↗</span>

            </div>


            <div class="service">

                <div class="service-number">
                    03
                </div>

                <div>
                    <h3>Database Management</h3>

                    <p>
                        Secure and efficient database
                        solutions for organizational data.
                    </p>
                </div>

                <span class="arrow">↗</span>

            </div>

        </div>

    </section>


    <!-- Company Portal -->

    <section id="portal" class="portal">

        <div class="section-label">
            COMPANY PORTAL
        </div>

        <h2>
            Access Your Workspace
        </h2>

        <p>
            Employees and administrators can securely
            access their respective company information.
        </p>


        <div class="portal-container">

            <!-- Employee -->

            <div class="portal-box employee">

                <div class="portal-icon">
                    E
                </div>

                <h3>
                    Employee Portal
                </h3>

                <p>
                    Login to access administrator
                    information and company resources.
                </p>

                <a href="login.php">
                    Employee Login →
                </a>

            </div>


            <!-- Admin -->

            <div class="portal-box admin">

                <div class="portal-icon">
                    A
                </div>

                <h3>
                    Admin Portal
                </h3>

                <p>
                    Login to manage and view
                    employee information.
                </p>

                <a href="login.php">
                    Admin Login →
                </a>

            </div>

        </div>

    </section>


    <!-- Registration CTA -->

    <section class="cta">

        <div>

            <span>
                WANT TO JOIN OUR TEAM?
            </span>

            <h2>
                Start your journey with TechNova.
            </h2>

        </div>

        <a href="register.php">
            Employee Registration →
        </a>

    </section>


    <!-- Footer -->

    <footer>

        <div class="footer-brand">
            <strong>TechNova</strong>

            <p>
                Technology • Innovation • Growth
            </p>
        </div>

        <p>
            © 2026 TechNova Solutions |
            Internet & Web Technologies Lab
        </p>

    </footer>


</body>

</html>