<?php
// Include database connection
require_once('conn_db.php');

// Initialize variables
$email = $firstName = $lastName = $telephone = $password = $repassword = "";
$error_message = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture and sanitize inputs
    $email = trim($_POST['email']);
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $telephone = trim($_POST['telephone']);
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);

    // Validate inputs
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($repassword) || empty($telephone)) {
        $error_message = "Please fill all the required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email.";
    } elseif ($password !== $repassword) {
        $error_message = "Passwords do not match, please try again.";
    } elseif (!is_numeric($telephone)) {
        $error_message = "Phone number must be numeric.";
    } else {
        // Encrypt the password
        $key = "abcdefgh123456";
        $encrypted_password = crypt($password, $key);

        // Define the insert query
        $query = "INSERT INTO user (password, email, firstName, lastName, telephone) VALUES (?, ?, ?, ?, ?)";
        
        // Execute query
        try {
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("sssss", $encrypted_password, $email, $firstName, $lastName, $telephone);
            $stmt->execute();
            $stmt->close();

            // Success message and email confirmation
            $success_message = "Thank you for registering. <a href='login.php'>Click here to login</a>";
            $email_message = "Thank you for registering with us. Your details are: <br>Name: $firstName $lastName<br>Email: $email<br>Phone Number: $telephone";
            @mail($email, "Website Registration", $email_message);

        } catch (Exception $e) {
            error_log($e->getMessage());
            $error_message = "Error inserting data into the table.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - A Perfect Cuppa</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header class="products-header">
        <div class="products-hero">
            <div class="top-bar">
                <a href="index.php" class="logo">
                    <img src="images/logo.png" alt="A Perfect Cuppa Logo">
                </a>
            </div>
            <nav role="navigation" class="primary-navigation">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="products.php">Tea Shop</a></li>
                    <li><a href="blog.html">Blog</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div id="register">
        <div id="registerwrapper">
            <?php
            // Display error message if any
            if (!empty($error_message)) {
                echo "<p style='color:red;'>$error_message</p>";
            }
            // Display success message if registration successful
            if (!empty($success_message)) {
                echo "<p style='color:green;'>$success_message</p>";
            }
            ?>
            <form action="register.php" method="post">
                <legend>Sign Up</legend><br/>
                <input type="text" id="firstName" name="firstName" placeholder="First Name" value="<?php echo htmlspecialchars($firstName); ?>" required><br/>
                <input type="text" id="lastName" name="lastName" placeholder="Last Name" value="<?php echo htmlspecialchars($lastName); ?>" required><br/>
                <input type="text" id="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required><br/>
                <input type="text" id="telephone" name="telephone" placeholder="Phone Number" value="<?php echo htmlspecialchars($telephone); ?>" required><br/>
                <input type="password" id="password" name="password" placeholder="Password" required><br/>
                <input type="password" id="repassword" name="repassword" placeholder="Re-type Password" required><br/>
                <input type="submit" value="Sign up"><br/>
                <hr class="divider"> <!-- Adds a line -->
                <button type="reset" class="reset-link">Reset</button>
            </form>
        </div>
    </div>
</body>
</html>
