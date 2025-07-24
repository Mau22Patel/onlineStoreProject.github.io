<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - A Perfect Cuppa</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to the shared CSS file -->
</head>
<body>

<div id="login">
        <div id="loginwrapper">
        
<?php
// Start the session
session_start(); 
include 'cart.php';

$cart = new Cart();
$counter = isset($_SESSION['counter']) ? $_SESSION['counter'] : 0;

// Check whether the cart is empty or not
if ($counter == 0) {
    echo "<div id='emptyCartWrapper' class='empty-cart-message'>";
    echo "<h1>Checkout</h1>";
    echo "<p><b>Your Shopping Cart is empty !!!</b></p>";
    echo "<p><b><a href='products.php'>Go back to products</a></b></p>";
    echo "</div>";
} else {
    $cart = unserialize($_SESSION['cart']);
    $depth = $cart->get_depth();
    echo "<h1>Order Summary </h1>";

    // Display each product in the cart
    $total_price = 0;
    for ($i = 0; $i < $depth; $i++) {
        $product = $cart->get_product($i);
        $product_id = $product->get_product_id();
        $product_name = $product->get_product_name();
        $qty = $product->get_qty();
        $unit_price = $product->get_unit_price();

        // Fetch image path from the database based on product ID
        require_once('conn_db.php'); // Include database connection
        $query = "SELECT imagePath FROM product WHERE productID = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $stmt->bind_result($image_path);
        $stmt->fetch();
        $stmt->close();

        // Calculate the total price for the item
        $total_price_for_item = $qty * $unit_price;
        $total_price += $total_price_for_item;

        // Display the product details including the image
        echo "<div class='product-item'>";
        echo "<div class='product-image'><img src='$image_path' alt='$product_name' width='125' height='125'></div>";
        echo "<div class='product-info'>";
        echo "<p class='product-name'>$product_name</p>";
        echo "<p class='product-qty'>Quantity: $qty</p>";
        echo "<p class='product-price'>Price: $" . number_format($total_price_for_item, 2) . "</p>";
        echo "</div>";
        echo "</div>";
    }

    // Calculate GST (10%) and shipping charges ($10)
    $gst = $total_price * 0.10; 
    $shipping_charges = 10.00;  
    $grand_total = $total_price + $gst + $shipping_charges;

    // Store the grand total in session for later use
    $_SESSION["total_price"] = $grand_total;

    // Display the subtotal, GST, shipping, and grand total

  echo "<div class='price-breakdown'>";
  echo "<h2>Price Breakdown</h2>";
  echo "<div class='breakdown-row'>";
  echo "<span>Subtotal</span>";
  echo "<span>$" . number_format($total_price, 2) . "</span>";
  echo "</div>";
  echo "<div class='breakdown-row'>";
  echo "<span>GST (10%)</span>";
  echo "<span>$" . number_format($gst, 2) . "</span>";
  echo "</div>";
  echo "<div class='breakdown-row'>";
  echo "<span>Shipping</span>";
  echo "<span>$" . number_format($shipping_charges, 2) . "</span>";
  echo "</div>";
  echo "<hr>";
  echo "<div class='breakdown-row total-amount'>";
  echo "<span>Grand Total</span>";
  echo "<span>$" . number_format($grand_total, 2) . "</span>";
  echo "</div>";
  echo "<a href='payments.php' class='checkout-button'>CHECKOUT</a>";
  echo "</div>";

    echo "<p><b><a id = 'forpass' href='view_cart.php'>Remove items</a></b></p>";
    echo "<p><b><a id = 'forpass' href='products.php'>Continue Shopping</a></b></p>";
    echo "</div>";
}
?>
    </div>
</div>

</body>
</html>
