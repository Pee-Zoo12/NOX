<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nox Apparel</title>
    <link rel="stylesheet" href="css/index.css">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="logo">
            <img src="img/noxlogo.png" alt="Nox Apparel Logo" class="logo-img">
        </div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="collection.php">Collections</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php" class="btn"><i class="fas fa-shopping-cart"></i> 
                    <?php 
                    // Display cart count if it exists in session
                    if(isset($_SESSION['cart_count'])) {
                        echo "(".$_SESSION['cart_count'].")";
                    } else {
                        echo "(0)";
                    }
                    ?>
                </a></li>
            </ul>
        </nav>
    </header>
    <section class="hero">
        <div class="hero-content">
            <h1>Style That Speaks</h1>
            <p>Discover the latest trends in fashion. Shop now and redefine your wardrobe.</p>
            <a href="collection.php" class="btn">Shop Now</a>
        </div>
    </section>
    <section class="featured" id="collections">
        <h2>Featured Collections</h2>
        <div class="collection-grid">
            <div class="collection-item">
                <img src="img/24.png" alt="Men's Collection">
                <h3>Men's Collection</h3>
            </div>
            <div class="collection-item">
                <img src="img/12.png" alt="Women's Collection">
                <h3>Women's Collection</h3>
            </div>
            <div class="collection-item">
                <img src="img/1.png" alt="New Arrivals">
                <h3>New Arrivals</h3>
            </div>
        </div>
    </section>

    <!-- Best Sellers / Trending Items -->
    <section class="trending">
        <h2>Trending Now</h2>
        <div class="trending-grid">
            <div class="trending-item">
                <img src="img/29.png" alt="Jacket">
                <p>Stylish Jacket</p>
            </div>
            <div class="trending-item">
                <img src="img/19.png" alt="Sneakers">
                <p>Casual Sneakers</p>
            </div>
            <div class="trending-item">
                <img src="img/30.png" alt="Bag">
                <p>Leather Bag</p>
            </div>
        </div>
    </section>
    <section class="offers">
        <h2>Limited-Time Offers</h2>
        <p>Exclusive discounts available for a limited period. Don't miss out!</p>
        <a href="shop.php" class="btn">Shop Deals</a>
    </section>
    
    <section class="testimonials">
        <h2>What Our Customers Say</h2>
        <p>⭐⭐⭐⭐⭐ "Amazing quality and style! Highly recommended." - Alex M.</p>
        <p>⭐⭐⭐⭐⭐ "The best fashion store with fast shipping!" - Jamie L.</p>
    </section>

    <!-- Newsletter Signup (Used as Sign In Section) -->
    <section class="newsletter" id="signup">
        <h2>Stay Updated</h2>
        <p>Sign up for our newsletter to get the latest updates and exclusive discounts.</p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="email" name="email" placeholder="Enter your email" required>
            <button type="submit" name="subscribe" class="btn">Subscribe</button>
        </form>
        <?php
        // Simple form processing
        if(isset($_POST['subscribe'])){
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                // Success message (in a real app, you'd save to database)
                echo "<p class='success-msg'>Thank you for subscribing!</p>";
            } else {
                echo "<p class='error-msg'>Please enter a valid email address.</p>";
            }
        }
        ?>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; <?php echo date("Y"); ?> Nox Apparel. All Rights Reserved.</p>
    </footer>

</body>
</html>