<?php
session_start();
include_once("conn_db.php");
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
                <div class="search-cart">
                    <form action="search_products.php" method="post" class="search-wrapper cf">
                        <input type="text" placeholder="Search here..." name="productName">
                        <button type="submit">Search</button>
                    </form>
                </div>
            </div>
            <nav role="navigation" class="primary-navigation">
                <ul>
                    <li><a href="" class="active">Home</a></li>
                    <li><a href="products.php">Tea Shop</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li class="dropdown">
                        <a href="#">My Account &dtrif;</a>
                        <ul class="dropdown">
                            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                                <li><a href="logout.php">Log out</a></li>
                            <?php else: ?>
                                <li><a href="login.php">Login</a></li>
                                <li><a href="register.php">Sign up</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <?php
        $search_key = $_POST["productName"] ?? '';

        if (empty(trim($search_key))) {
            echo "<div class='search-message'><p>Please enter a search term.</p></div>";

        } else {
            $query = "SELECT * FROM product WHERE productName LIKE ?";
            $stmt = $mysqli->prepare($query);
            $search_key = "%" . $search_key . "%";
            $stmt->bind_param("s", $search_key);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0): ?>
                <div class="search-results-list">
                    <?php while ($row = $result->fetch_assoc()): ?>
                    
                        <div class="card-container">
        <div class="search-result-item">
            <div class="search-result-image-container">
                <img src="<?= htmlspecialchars($row['imagePath']) ?>" alt="Product Image" class="search-result-image">
            </div>
            <div class="search-result-details">
                <p class="search-result-name"><?= htmlspecialchars($row['productName']) ?></p>
                <p class="search-result-price">$<?= htmlspecialchars($row['productPrice']) ?></p>
                <p class="search-result-quantity">Quantity: <?= htmlspecialchars($row['qty']) ?></p>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="productID" value="<?= htmlspecialchars($row['productID']) ?>">
                    <div class="search-result-button-container">
                        <button type="submit" name="add" class="add-to-cart">Add to Cart</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
                            </form>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif;

            $stmt->close();
        }

        $mysqli->close();
        ?>
    </main>
</body>
</html>

