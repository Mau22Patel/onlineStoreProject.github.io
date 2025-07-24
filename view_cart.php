<link rel="stylesheet" href="css/styles.css">
<script src="js/script.js"> </script>

<?php
// Start the session
session_start();
include 'cart.php';
$cart = new Cart();

// Check if the cart is empty by checking the counter
if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
    $counter = 0;
} else {
    $counter = $_SESSION['counter'];
}
?>
<html>
<body>

<div id="login">
        <div id="loginwrapper">
            
<?php
// Check if the cart has items or is empty
if ($counter == 0) {
echo "<div id='emptyCartWrapper' class='empty-cart-message'>";
                echo "<h1>Shopping Cart</h1>";
                echo "<p><b>Your Shopping Cart is empty!!!</b></p>";
                echo "<p><b><a href='products.php'>Go back to products</a></b></p>";
                echo "</div>";
} else {
    $cart = unserialize($_SESSION['cart']);
  
    // Get the depth of the cart
    $depth = $cart->get_depth();
    echo "<h1>Shopping Cart</h1>";

    // Use a for loop to iterate through the cart
    for ($i = 0; $i < $depth; $i++) {
        $product = $cart->get_product($i);
        $product_id = $product->get_product_id();
        $product_name = $product->get_product_name();
        $qty = $product->get_qty();
        $unit_price = $product->get_unit_price();

        // Fetch the image path from the database
        require_once('conn_db.php'); // Include database connection
        $query = "SELECT imagePath FROM product WHERE productID = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $stmt->bind_result($image_path);
        $stmt->fetch();
        $stmt->close();
// Calculate the total price for the quantity selected
$total_price = $qty * $unit_price;

// Display the product details with the total price
echo "<div class='view-item'>";
echo "<form action='remove_from_cart.php' method='POST'>";
echo "<div class='product-image'><img src='$image_path' alt='$product_name' width='125' height='125'></div>";
echo "<div class='product-info'>";
echo "<p class='product-name'>$product_name</p>";
echo "<p class='product-qty'>Quantity: $qty</p>";
echo "<p class='product-price'>Price:$" . number_format($total_price, 2) . "</p>"; 
echo "</div>";
echo "<div class='add-to-cart'>";
echo "<input name='product_no' type='hidden' id='product_no' value='$i'>";
echo "<button type='submit' name='remove' class='add-to-cart'>Remove</button>";
echo "</div>";
echo "</form>";
echo "</div>";


    }

    echo "<a href='checkout.php' class='checkout-button'>BUY NOW</a>";
    echo "<p><b><a id = 'forpass' href='products.php'>Continue Shopping</a></b></p>";
}
?>
   </div>
    </div>
</body>
</html>
