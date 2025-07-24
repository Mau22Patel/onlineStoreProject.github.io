<?php
// Start session
session_start();

// Capture the redirect parameter if set in GET or POST
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : (isset($_POST['redirect']) ? $_POST['redirect'] : 'loginhome.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email or password is empty
    if (empty($email) || empty($password)) {
       // Store error message in session
       $_SESSION['error'] = 'Please enter both email and password.';
    } else {
        // Connect to the database
        require_once('conn_db.php');

        // Prepare SQL query to fetch user details by email
        $query = "SELECT * FROM user WHERE email = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $email); 
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        // Check if the email exists in the database
        if ($result->num_rows == 1) {
            $row = $result->fetch_array();

            // Verify the password using password_verify()
            if (password_verify($password, $row['password'])) {
                // Store user data in session
                $_SESSION["firstName"] = $row["firstName"];
                $_SESSION["lastName"] = $row["lastName"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["telephone"] = $row["telephone"];
                $_SESSION["logged_in"] = true; // Set logged-in status

                // Redirect to the specified page or to the default page
                header("Location: $redirect");
                exit();
            } else {
                // Password does not match, set error message
                $_SESSION['error'] = 'Invalid password. Please try again.';
            }
        } else {
            // Email not found, set error message
            $_SESSION['error'] = 'Email not found. Please try again or register.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - A Perfect Cuppa</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Login Form -->
    <div id="login">
        <div id="loginwrapper">
            <!-- Include the redirect parameter in the form action if it exists -->
            <form action="login.php" method="post">
                <legend>Log In</legend><br/>
                
                <!-- Display error message -->
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<p style="color:red;">' . htmlspecialchars($_SESSION['error']) . '</p>';
                    // Unset the error message after displaying it
                    unset($_SESSION['error']);
                }
                ?>

                <input type="email" id="email" name="email" placeholder="Email" required autofocus><br/>
                <input type="password" id="password" name="password" placeholder="Password" required><br/>
                
                <!-- Include the redirect as a hidden input to pass it through the POST request -->
                <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($redirect); ?>">

                <input type="submit" value="Log In">
            </form><br/>
            <a id="forpass" href="register.php">Register</a><br/>
            <a id="forpass" href="#">Reset Password</a>
        </div>
    </div>
</body>
</html>
