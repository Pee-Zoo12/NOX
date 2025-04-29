<?php
session_start();
$feedbackFile = 'data/feedback.json';
$message = '';

// Create directory if it doesn't exist
if (!file_exists('data')) {
    mkdir('data', 0755, true);
}

// Create empty JSON file if it doesn't exist
if (!file_exists($feedbackFile)) {
    file_put_contents($feedbackFile, json_encode([]));
}

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Handle feedback submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["order_number"])) {
    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $message = '<div class="error-message">Invalid form submission.</div>';
    } else {
        $orderNumber = htmlspecialchars(trim($_POST["order_number"]));
        $feedbackMessage = htmlspecialchars(trim($_POST["message"]));
        $imagePath = "";
        
        // Handle file upload
        if (isset($_FILES["review_image"]) && $_FILES["review_image"]["error"] == 0) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $maxSize = 2 * 1024 * 1024; // 2MB
            
            if (in_array($_FILES["review_image"]["type"], $allowedTypes) && $_FILES["review_image"]["size"] <= $maxSize) {
                $imageName = basename($_FILES["review_image"]["name"]);
                $targetDir = "uploads/";
                
                // Create uploads directory if it doesn't exist
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }
                
                $targetFile = $targetDir . time() . "_" . $imageName;
                
                if (move_uploaded_file($_FILES["review_image"]["tmp_name"], $targetFile)) {
                    $imagePath = $targetFile;
                }
            } else {
                $message = '<div class="error-message">Invalid file. Please upload an image under 2MB.</div>';
            }
        }
        
        if (empty($message)) {
            // Load existing feedback
            $feedbacks = json_decode(file_get_contents($feedbackFile), true);
            
            // Add new feedback
            $newFeedback = [
                'order_number' => $orderNumber,
                'message' => $feedbackMessage,
                'image_path' => $imagePath,
                'submitted_at' => date('Y-m-d H:i:s')
            ];
            
            // Add to beginning of array to show newest first
            array_unshift($feedbacks, $newFeedback);
            
            // Save back to file
            file_put_contents($feedbackFile, json_encode($feedbacks, JSON_PRETTY_PRINT));
            
            $message = '<div class="success-message">Thank you for your feedback!</div>';
        }
    }
}

// Handle feedback deletion
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $deleteIndex = $_GET['delete'];
    
    // Load existing feedback
    $feedbacks = json_decode(file_get_contents($feedbackFile), true);
    
    // Ensure the feedback exists
    if (isset($feedbacks[$deleteIndex])) {
        // Delete feedback
        unset($feedbacks[$deleteIndex]);
        
        // Re-index array
        $feedbacks = array_values($feedbacks);
        
        // Save updated feedback to file
        file_put_contents($feedbackFile, json_encode($feedbacks, JSON_PRETTY_PRINT));
        
        $message = '<div class="success-message">Feedback deleted successfully!</div>';
    } else {
        $message = '<div class="error-message">Feedback not found.</div>';
    }
}

// Load feedback for display
$feedbacks = json_decode(file_get_contents($feedbackFile), true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Nox Apparel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="navbar">
        <div class="logo">
            <img src="img/noxlogo.png" alt="Nox Apparel Logo" class="logo-img">
            <span>Nox Apparel</span>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="collection.php">Collections</a></li>
                <li><a href="contact.php" class="active">Contact</a></li>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Contact Information -->
    <section class="contact-info">
        <h1>Contact Us</h1>
        <div class="contact-methods">
            <div class="contact-method">
                <i class="fas fa-envelope"></i>
                <h3>Email</h3>
                <p>support@noxapparel.com</p>
            </div>
            <div class="contact-method">
                <i class="fas fa-phone"></i>
                <h3>Phone</h3>
                <p>+63 (2) 8123 4567</p>
            </div>
            <div class="contact-method">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Address</h3>
                <p>123 Fashion Avenue, Makati City, Philippines</p>
            </div>
        </div>
    </section>

    <!-- Feedback Section -->
    <section class="feedback-section">
        <h2>Report a Purchase Issue</h2>
        
        <?php if (!empty($message)): ?>
            <?= $message ?>
        <?php endif; ?>
        
        <form class="feedback-form" action="contact.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            
            <div class="form-group">
                <label for="order_number">Order Number</label>
                <input type="text" id="order_number" name="order_number" placeholder="Enter your order number" required>
            </div>
            
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" placeholder="Describe your issue in detail" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="review_image">Attach an Image (Optional)</label>
                <input type="file" id="review_image" name="review_image" accept="image/*">
                <small>Maximum file size: 2MB</small>
            </div>
            
            <button type="submit" class="btn">Submit Report</button>
        </form>

        <h3>Recent Feedback</h3>
        <div class="feedback-display">
            <?php if (!empty($feedbacks)): ?>
                <?php foreach ($feedbacks as $index => $feedback): ?>
                    <div class="feedback-card">
                        <div class="feedback-header">
                            <strong>Order #<?= htmlspecialchars($feedback['order_number']) ?></strong>
                            <span class="feedback-date"><?= $feedback['submitted_at'] ?></span>
                        </div>
                        <p><?= nl2br(htmlspecialchars($feedback['message'])) ?></p>
                        <?php if (!empty($feedback['image_path'])): ?>
                            <img src="<?= htmlspecialchars($feedback['image_path']) ?>" alt="Feedback Image" class="feedback-image">
                        <?php endif; ?>
                        
                        <!-- Delete Button -->
                        <form action="contact.php" method="GET" onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                            <input type="hidden" name="delete" value="<?= $index ?>">
                            <button type="submit" class="delete-btn">Delete Feedback</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-feedback">No feedback submitted yet.</p>
            <?php endif; ?>
        </div>
    </section>

<!-- Authorized Resellers Section -->
<section class="resellers-section">
    <h2>Official & Authentic Resellers</h2>
    <p class="reseller-description">You can shop authentic Nox Apparel products from these trusted e-commerce platforms:</p>

    <div class="reseller-cards">
        <div class="reseller-card">
            <i class="fas fa-store"></i>
            <h3>Shopee Philippines</h3>
            <p>Shop directly from our official Shopee store with verified reviews and fast shipping.</p>
            <a href="https://shopee.ph/noxapparel.official" target="_blank" class="reseller-link">Visit Store</a>
        </div>

        <div class="reseller-card">
            <i class="fas fa-shopping-bag"></i>
            <h3>Lazada Philippines</h3>
            <p>Enjoy exclusive deals and bundles through our LazMall flagship store.</p>
            <a href="https://www.lazada.com.ph/shop/noxapparel" target="_blank" class="reseller-link">Visit Store</a>
        </div>

        <div class="reseller-card">
            <i class="fas fa-globe"></i>
            <h3>Website Direct</h3>
            <p>Order directly via our website with exclusive access to new drops and limited editions.</p>
            <a href="collection.php" class="reseller-link">Shop Now</a>
        </div>
    </div>
</section>








    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Nox Apparel</h3>
                <p>Delivering premium fashion since 2020. Quality, style, and satisfaction guaranteed.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    
                    <li><a href="collection.php">Collections</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Connect With Us</h3>
                <div class="social-icons">
                    <a href="https://www.facebook.com/share/12EJr7p8YTM/?mibextid=wwXIfr
"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.instagram.com/_nox.apparel?igsh=MTJ6ZmJxZ29ybWIwbg=="><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        <p class="copyright">&copy; 2025 Nox Apparel. All Rights Reserved.</p>
    </footer>
</body>
</html>
