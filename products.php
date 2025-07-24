<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tea Store - A Perfect Cuppa</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="products-page">
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
                    <li><a href="products.php" class="active">Tea Shop</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li class="dropdown">
                        <a href="#">My Account &dtrif;</a>
                        <ul class="dropdown">
                            <?php
                            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                                echo "<li><a href='logout.php'>Log out</a></li>";
                            } else {
                                echo "<li><a href='login.php'>Login</a></li>";
                                echo "<li><a href='register.php'>Sign up</a></li>";
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
            </nav>
            
            <div class="search-cart">
                    <form action="search_products.php" method="post" class="search-wrapper cf">
                        <input type="text" placeholder="Search here..." name="productName">
                        <button type="submit">Search</button>
                    </form>
            
                </div>
        </div>
    </header>
    
    <section id="teaShop">
        <div id="product-title">
            <h2>Discover Your Perfect Brew</h2>
            <p>Explore our curated tea collection, offering bold blacks, delicate greens, <br>and soothing herbal blends. Discover the perfect tea to match every mood and moment.</p></br>
        </div>

        <div id="wrap">
            <?php
            require_once("conn_db.php"); 

            // Query to select all products
            $query = "SELECT * FROM product";
            $stmt = $mysqli->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();

            // Loop to display each product 
            while ($row = $result->fetch_assoc()) {
                $product_id = $row["productID"];
                $product_name = $row["productName"];
                $unit_price = $row["productPrice"];
                $qty = $row["qty"];
                $image_path = $row["imagePath"];
                //this is a product card 
                echo "
                <div class='card'>
                    <div class='thumb'>
                        <img src='$image_path' alt='$product_name' width='100%' height='auto'>
                    </div>
                    <div class='option'></div>
                    <h3>$product_name</h3>
                    <hr>
                    <p class='price'>$$unit_price</p>
                    <hr>
                    <form action='add_to_cart.php' method='POST'>
                        <input name='productID' type='hidden' value='$product_id'>
                        <div class='qty'>
                            <label for='qty-$product_id'>Quantity:</label>
                            <input type='number' id='qty-$product_id' name='qty' value='1' min='1' max='$qty' size='2'>
                        </div>
                        <div class='button-container'>
                            <button type='submit' name='add' class='add-to-cart'>Add to Cart</button>
                        </div>
                    </form>
                </div>";
            }
            ?>
        </div>
    </section>
</body>
</html>
