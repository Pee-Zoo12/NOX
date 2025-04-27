<?php
session_start();

// Function to get cart count (consistent with your other PHP files)
function getCartCount() {
    if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        return count($_SESSION['cart']);
    }
    return 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Nox Apparel</title>
    <link rel="stylesheet" href="Contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <!-- Navbar -->
    <header class="navbar">
        <div class="logo">
            <img src="img/noxlogo.png" alt="Nox Apparel Logo" class="logo-img">
        </div>
        <nav>
            <ul class="nav-list">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="collection.php">Collections</a></li>
                <li><a href="#" class="active">Contact</a></li>
                <li><a href="cart.php" class="cart-icon"><i class="fas fa-shopping-cart"></i><span class="cart-count"><?php echo getCartCount(); ?></span></a></li>
            </ul>
        </nav>
    </header>

    <!-- Contact Section -->
    <section class="contact-section">
        <h1>Contact Us</h1>
        <div class="contact-container">
            <div class="contact-form">
                <h2>Send us a Message</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>
                    <textarea name="message" placeholder="Your Message" required></textarea>
                    <button type="submit" name="contact_submit" class="btn">Send Message</button>
                </form>
                <?php
                // Simple form processing
                if(isset($_POST['contact_submit'])){
                    $name = htmlspecialchars($_POST['name']);
                    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                    $message = htmlspecialchars($_POST['message']);
                    
                    // In a real application, you would process this data (send email, save to database, etc.)
                    // For now, just display a confirmation message
                    echo "<p class='success-msg'>Thank you for your message, $name! We'll get back to you soon.</p>";
                }
                ?>
            </div>
            <div class="contact-details">
                <h2>Customer Support</h2>
                <p><i class="fas fa-phone"></i> +63 912 345 6789</p>
                <p><i class="fas fa-envelope"></i> <a href="mailto:support@noxapparel.com">support@noxapparel.com</a></p>
                <p><i class="fab fa-facebook"></i> <a href="#">Facebook: @NoxApparel</a></p>
                <p><i class="fab fa-instagram"></i> <a href="#">Instagram: @nox.apparel</a></p>
            </div>
        </div>
    </section>

    <!-- Feedback Section -->
    <section class="feedback-section">
        <h2>Report a Purchase Issue</h2>
        <form class="feedback-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <input type="text" name="order_number" placeholder="Order Number" required>
            <textarea name="issue" placeholder="Describe your issue" required></textarea>
            <input type="file" name="review_image" accept="image/*">
            <button type="submit" name="issue_submit" class="btn">Submit Report</button>
        </form>
        <?php
        // Process feedback form submission
        if(isset($_POST['issue_submit'])){
            $orderNumber = htmlspecialchars($_POST['order_number']);
            $issue = htmlspecialchars($_POST['issue']);
            
            // In a real application, process the uploaded file and issue report
            echo "<p class='success-msg'>Thank you for reporting this issue. Our team will investigate order #$orderNumber.</p>";
        }
        ?>
    </section>

    <!-- Reseller Section -->
    <section class="reseller-section">
        <h2>Apply as a Certified Reseller</h2>
        <form class="reseller-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="full_name" placeholder="Full Name" required>
            <input type="email" name="reseller_email" placeholder="Email Address" required>
            <input type="text" name="business_name" placeholder="Business Name (if any)">
            <textarea name="reseller_message" placeholder="Tell us why you want to be a reseller" required></textarea>
            <button type="submit" name="reseller_submit" class="btn">Apply Now</button>
        </form>
        <?php
        // Process reseller application
        if(isset($_POST['reseller_submit'])){
            $fullName = htmlspecialchars($_POST['full_name']);
            $resellerEmail = filter_var($_POST['reseller_email'], FILTER_SANITIZE_EMAIL);
            $businessName = htmlspecialchars($_POST['business_name']);
            
            // In a real application, process this data
            echo "<p class='success-msg'>Thank you for your application, $fullName! We'll review your details and contact you soon.</p>";
        }
        ?>
    </section>

    <!-- Live Chat Section -->
    <section class="live-chat">
        <h2>Live Chat</h2>
        <p>Chat with our support team in real-time.</p>
        <button class="btn">Start Chat</button>
    </section>

    <!-- Social Media & Official Stores -->
    <section class="social-links">
        <h2>Follow & Shop With Us</h2>
        <div class="social-icons">
            <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="#" target="_blank"><i class="fab fa-x-twitter"></i></a>
            <a href="#" target="_blank"><i class="fas fa-store"></i> Shopee</a>
            <a href="#" target="_blank"><i class="fas fa-shopping-bag"></i> Lazada</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; <?php echo date("Y"); ?> Nox Apparel. All Rights Reserved.</p>
    </footer>

</body>
</html>