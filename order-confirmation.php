<?php
session_start();

// Retrieve the last order from session
$order = $_SESSION['last_order'] ?? null;

// If no order found, redirect to home
if (!$order) {
    header("Location: index.php");
    exit;
}

// Clear the order from session after displaying once
unset($_SESSION['last_order']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Nox Apparel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<header class="navbar">
    <div class="logo">
        <img src="img/noxlogo.png" alt="Nox Apparel Logo" class="logo-img">
        <span>Nox Apparel</span>
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="collection.php">Collections</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="cart.php" class="btn"><i class="fas fa-shopping-cart"></i> (0)</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <div class="confirmation-box">
        <div class="confirmation-header">
            <i class="fas fa-check-circle"></i>
            <h1>Order Confirmed!</h1>
            <p>Thank you for your purchase. Your order has been received.</p>
        </div>
        
        <div class="order-details">
            <div class="order-info">
                <div class="info-item">
                    <span class="info-label">Order Number:</span>
                    <span class="info-value"><?= htmlspecialchars($order['order_id']) ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Date:</span>
                    <span class="info-value"><?= htmlspecialchars($order['order_date']) ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Payment Method:</span>
                    <span class="info-value"><?= htmlspecialchars($order['payment_method']) ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Total Amount:</span>
                    <span class="info-value">₱<?= number_format($order['total'], 2) ?></span>
                </div>
            </div>
            
            <div class="shipping-info">
                <h3>Shipping Information</h3>
                <p><strong>Name:</strong> <?= htmlspecialchars($order['customer']['fullname']) ?></p>
                <p><strong>Address:</strong> <?= htmlspecialchars($order['customer']['address']) ?></p>
                <p><?= htmlspecialchars($order['customer']['city']) ?>, <?= htmlspecialchars($order['customer']['postal_code']) ?></p>
                <p><?= htmlspecialchars($order['customer']['country']) ?></p>
                <p><strong>Phone:</strong> <?= htmlspecialchars($order['customer']['phone']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($order['customer']['email']) ?></p>
            </div>
        </div>
        
        <h3>Order Summary</h3>
        <div class="order-items">
            <?php foreach ($order['items'] as $item): ?>
                <div class="order-item">
                    <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="item-image">
                    <div class="item-details">
                        <h4><?= htmlspecialchars($item['name']) ?></h4>
                        <p>Size: <?= htmlspecialchars($item['size']) ?> | Color: <?= ucfirst(htmlspecialchars($item['color'])) ?></p>
                        <p>Quantity: <?= $item['quantity'] ?></p>
                    </div>
                    <div class="item-price">
                        ₱<?= number_format($item['price'] * $item['quantity'], 2) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="next-steps">
            <h3>What's Next?</h3>
            <ol>
                <li>You will receive an order confirmation email shortly.</li>
                <li>Our team will process your order within 24 hours.</li>
                <li>Once shipped, you'll receive tracking information.</li>
                <li>Delivery typically takes 3-5 business days within the Philippines.</li>
            </ol>
        </div>
        
        <div class="confirmation-actions">
            <a href="index.php" class="btn">Continue Shopping</a>
            <a href="#" class="btn btn-secondary" onclick="window.print(); return false;">Print Receipt</a>
        </div>
        
        <div class="support-contact">
            <p>Have questions about your order? <a href="contact.php">Contact our support team</a>.</p>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>About Nox Apparel</h3>
            <p>Premium fashion for everyone. Quality and style guaranteed.</p>
        </div>
        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="collection.php">Collections</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Connect With Us</h3>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>
    <p class="copyright">&copy; 2025 Nox Apparel. All Rights Reserved.</p>
</footer>
</body>
</html>