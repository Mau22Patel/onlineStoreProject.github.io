<?php
// Start session to access session variables
session_start();

// Check if user is logged in
if (!isset($_SESSION["firstName"])) {
    // If not logged in, redirect to login page
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Perfect Cuppa</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header class="header">
        <div class="hero">
            <div class="top-bar">
                <a href="#" class="logo">
                    <img src="images/logo.png" alt="A Perfect Cuppa Logo">
                </a>
                <!-- Account Dropdown -->
                <nav role="navigation" class="loginhome-navigation">
                    <ul>
                        <li class="dropdown">
                            <a href="#">My Account &dtrif;</a>
                            <ul class="dropdown">
                                <li><a href="index.html">Logout</a></li>
                                <li><a href="member_page.php">My Details</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Hero Section -->
            <h1>Hello, <?php echo htmlspecialchars($_SESSION["firstName"]); ?>!</h1>
            <p>Get your chai high.</p>
            <div>
                <a href="products.php" class="btn">Shop Now</a>
            </div>
        </div>
    </header>

    <footer>
        <p>2024 A Perfect Cuppa</p>
    </footer>
</body>
</html>
