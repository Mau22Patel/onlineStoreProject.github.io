<?php
session_start();
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
   
            </div>      
            <nav role="navigation" class="primary-navigation">
                <ul>
                  <li><a href="" class="active">Home</a></li> <!-- Add 'active' class here -->
                  <li><a href="products.php">Tea Shop</a></li>
                  <li><a href="blog.html">Blog</a></li>
                  <li class="dropdown">
                    <a href="#">My Account &dtrif;</a>
                    <ul class="dropdown">
                            <?php
                            // Check if the user is logged in
                            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                                // Display Logout option if logged in
                                echo "<li><a href='logout.php'>Log out</a></li>";
                            } else {
                                // Display Login and Sign Up options if not logged in
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
            <h1>Hello Brew-tea-ful!</h1>
            <p>Get your chai high.</p>
            <a href="#now-brewing" class="btn">Featured Tea</a>
        </div>
    </header>
    
    
    <section class="now-brewing" id="now-brewing">
        <h2>Now Brewing</h2>
        <div class="tea-items">
            <div class="tea-item">
                <img src="images/peppermintTea.png" alt="Peppermint Loose Tea">
                <p>Peppermint Loose Tea</p>
                <p>$16.00</p>
             
            </div>
            <div class="tea-item">
                <img src="images/lemongrassTea.png" alt="Lemongrass Tea">
                <p>Lemongrass Tea</p>
                <p>$23.00</p>
            
            </div>
            <div class="tea-item">
                <img src="images/GreenTea.png" alt="Japanese Green Tea">
                <p>Japanese Green Tea</p>
                <p>$40.00</p>
            </div>
        </div>
    </section>

    <section class="our-story">
        <h2>Our Story</h2>
        <p>At "A Perfect Cuppa," we believe that every tea tells a story. Founded by a passionate tea lover, our shop was born from the desire to share the warmth and comfort found in a simple, perfect cup of tea. Each blend is carefully selected to offer a moment of tranquility in your busy day, whether you’re savoring a delicate green tea at sunrise or unwinding with a soothing herbal blend before bed. We’re dedicated to bringing you the finest teas from around the world, ensuring every sip is a step closer to your perfect cuppa.</p>
    </section>
    <h2>Why Choose Us?</h2>
    <section class="why-choose-us">
    
        <div class="reasons">
            <div class="reason">
                <img src="images/WhyChooseUs1.jpg" alt="Premium Quality Tea">

                <h3>Premium Quality Tea</h3>
                <p>We source only the finest teas from around the world to ensure top quality in every cup.</p>
            </div>
            <div class="reason">
                <img src="images/WhyChooseUs2.jpg" alt="Expertly Curated Blends">
                <h3>Expertly Curated Blends</h3>
                <p>Our blends are crafted by tea experts to bring you the perfect balance of flavor and aroma.</p>
            </div>
            <div class="reason">
                <img src="images/WhyChooseUs3.jpg" alt="Sustainably & Ethically Sourced">
                <h3>Sustainably & Ethically Sourced</h3>
                <p>We are committed to sustainable practices and ethical sourcing, supporting tea growers globally.</p>
            </div>
            <div class="reason">
                <img src="images/WhyChooseUs4.jpg" alt="Fast & Reliable Shipping">
                <h3>Fast & Reliable Shipping</h3>
                <p>Enjoy your perfect cuppa without the wait—fast and reliable shipping straight to your door.</p>
            </div>
            <div class="reason">
                <img src="images/WhyChooseUs5.jpg" alt="Saving Our Forests">
                <h3>Saving Our Forests</h3>
                <p>With every purchase, you help protect and restore forests, ensuring a greener future for generations to come.</p>
            </div>
        </div>
    </section>

    <section class="shop-now-section">
        <div class="shopNow">
            <a href="products.php" class="btn">Shop Now</a>
        </div>
    </section>
    

    <footer>
        <section class="contact-us">
            <h2>Contact Us</h2>
            <form>
                <input type="email" placeholder="Enter a valid email address" required>
                <input type="text" placeholder="Enter your Name" required>
                <input type="text" placeholder="Enter your address">
                <textarea placeholder="Enter your message"></textarea>
                <button type="submit">Submit</button>
            </form>
            <div class="contact-info">
                <p><strong>Call Us:</strong> 1 (234) 567-891, 1 (234) 987-654</p>
                <p><strong>Location:</strong> 121 Currie Street, Adelaide, SA, 5000</p>
                <p><strong>Business Hours:</strong> Mon - Fri: 10 am - 8 pm; Sat, Sun: Closed</p>
            </div>
        </section>
        <p>2024 A Perfect Cuppa</p>
    </footer>
</body>
</html>
