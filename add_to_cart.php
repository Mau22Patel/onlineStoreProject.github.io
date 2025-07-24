<?php
// Start the session
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect to login with the product info in the URL
    $redirect_url = "view_cart.php?productID=" . urlencode($_POST['productID']) . "&qty=" . urlencode($_POST['qty']);
    header("Location: login.php?redirect=" . urlencode($redirect_url));
    exit();
}

// Include cart functionality
include 'cart.php';

// Get product ID and quantity from form
$product_id = $_POST["productID"] ?? null;
$qty = $_POST["qty"] ?? 1; // Default to 1 if not provided

// Validate inputs
if (empty($product_id) || $qty < 1) {
    // Redirect back to the products page if input is invalid
    header("Location: products.php");
    exit();
}

// Initialize or retrieve the cart
$cart = isset($_SESSION['cart']) ? unserialize($_SESSION['cart']) : new Cart();

// Connect to the database
require_once("conn_db.php");

// Prepare SQL query to retrieve product details
$query = "SELECT productName, productPrice FROM product WHERE productID = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the product exists
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $product_name = $row["productName"];
    $product_price = $row["productPrice"];

    // Add the product to the cart
    $new_product = new Product($product_id, $product_name, $product_price, $qty);
    $cart->add_product($new_product);

    // Update session variables
    $_SESSION['counter'] = isset($_SESSION['counter']) ? $_SESSION['counter'] + 1 : 1;
    $_SESSION['cart'] = serialize($cart);

    // Redirect to the cart page
    header("Location: view_cart.php");
    exit();
} else {
    // Redirect back to products page if product not found
    header("Location: products.php");
    exit();
}

// Close the database connection
$stmt->close();
$mysqli->close();
?>
