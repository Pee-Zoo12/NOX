<?php
session_start();
$cart = $_SESSION['cart'] ?? [];
$total = 0;

// CSRF protection
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Redirect if cart is empty
if (empty($cart)) {
    $_SESSION['cart_message'] = 'Your cart is empty. Please add items before checkout.';
    header("Location: cart.php");
    exit;
}

// Process order
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['checkout_error'] = 'Invalid form submission.';
        header("Location: checkout.php");
        exit;
    }
    
    // Validate required fields
    $required = ['fullname', 'email', 'address', 'city', 'phone'];
    $errors = [];
    
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            $errors[] = ucfirst($field) . ' is required.';
        }
    }
    
    // Validate email
    if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }
    
    // Validate phone (simple validation)
    if (!empty($_POST['phone']) && !preg_match('/^\+?[0-9]{10,15}$/', $_POST['phone'])) {
        $errors[] = 'Please enter a valid phone number.';
    }
    
    if (empty($errors)) {
        // Create order data
        $orderData = [
            'order_id' => 'NOX' . time() . rand(1000, 9999),
            'order_date' => date('Y-m-d H:i:s'),
            'customer' => [
                'fullname' => htmlspecialchars($_POST['fullname']),
                'email' => htmlspecialchars($_POST['email']),
                'phone' => htmlspecialchars($_POST['phone']),
                'address' => htmlspecialchars($_POST['address']),
                'city' => htmlspecialchars($_POST['city']),
                'postal_code' => htmlspecialchars($_POST['postal_code'] ?? ''),
                'country' => htmlspecialchars($_POST['country'] ?? 'Philippines'),
            ],
            'items' => $cart,
            'total' => array_reduce($cart, function($sum, $item) {
                return $sum + ($item['price'] * $item['quantity']);
            }, 0),
            'payment_method' => htmlspecialchars($_POST['payment_method'] ?? 'Cash on Delivery'),
            'status' => 'Processing'
        ];
        
        // Store order in file (instead of database)
        $ordersDir = 'data/orders';
        if (!file_exists($ordersDir)) {
            mkdir($ordersDir, 0755, true);
        }
        
        file_put_contents(
            "$ordersDir/{$orderData['order_id']}.json", 
            json_encode($orderData, JSON_PRETTY_PRINT)
        );
        
        // Clear cart
        $_SESSION['cart'] = [];
        
        // Store order in session for confirmation page
        $_SESSION['last_order'] = $orderData;
        
        // Redirect to confirmation page
        header("Location: order-confirmation.php");
        exit;
    } else {
        $_SESSION['checkout_errors'] = $errors;
        $_SESSION['checkout_data'] = $_POST; // Save form data for repopulation
    }
}

// Get any errors from session
$errors = $_SESSION['checkout_errors'] ?? [];
$formData = $_SESSION['checkout_data'] ?? [];

// Clear session data after retrieving
if (isset($_SESSION['checkout_errors'])) unset($_SESSION['checkout_errors']);
if (isset($_SESSION['checkout_data'])) unset($_SESSION['checkout_data']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Nox Apparel</title>
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
            <li><a href="shop.php">Shop</a></li>
            <li><a href="collection.php">Collections</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="cart.php" class="btn"><i class="fas fa-shopping-cart"></i> (<?= count($cart) ?>)</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <h1>Checkout</h1>
    
    <div class="checkout-container">
        <div class="checkout-form">
            <?php if (!empty($errors)): ?>
                <div class="error-summary">
                    <h3>Please correct the following errors:</h3>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <form action="checkout.php" method="POST" id="checkout-form">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                
                <h2>Shipping Information</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label for="fullname">Full Name *</label>
                        <input type="text" id="fullname" name="fullname" value="<?= htmlspecialchars($formData['fullname'] ?? '') ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($formData['email'] ?? '') ?>" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($formData['phone'] ?? '') ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="address">Shipping Address *</label>
                    <textarea id="address" name="address" required><?= htmlspecialchars($formData['address'] ?? '') ?></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="city">City/Municipality *</label>
                        <input type="text" id="city" name="city" value="<?= htmlspecialchars($formData['city'] ?? '') ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" id="postal_code" name="postal_code" value="<?= htmlspecialchars($formData['postal_code'] ?? '') ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="country">Country</label>
                    <select id="country" name="country">
                        <option value="Philippines" selected>Philippines</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                
                <h2>Payment Method</h2>
                <div class="payment-methods">
                    <div class="payment-method">
                        <input type="radio" id="cod" name="payment_method" value="Cash on Delivery" checked>
                        <label for="cod">Cash on Delivery</label>
                    </div>
                    
                    <div class="payment-method">
                        <input type="radio" id="bank_transfer" name="payment_method" value="Bank Transfer">
                        <label for="bank_transfer">Bank Transfer</label>
                    </div>
                    
                    <div class="payment-method">
                        <input type="radio" id="gcash" name="payment_method" value="GCash">
                        <label for="gcash">GCash</label>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Place Order</button>
            </form>
        </div>
        
        <div class="order-summary">
            <h2>Order Summary</h2>
            <div class="summary-items">
                <?php foreach ($cart as $item): 
                    $itemTotal = $item['price'] * $item['quantity'];
                    $total += $itemTotal;
                ?>
                <div class="summary-item">
                    <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="summary-img">
                    <div class="summary-details">
                        <h3><?= htmlspecialchars($item['name']) ?></h3>
                        <p>Size: <?= htmlspecialchars($item['size']) ?> | Color: <?= ucfirst(htmlspecialchars($item['color'])) ?></p>
                        <p>₱<?= number_format($item['price'], 2) ?> × <?= $item['quantity'] ?></p>
                    </div>
                    <div class="summary-price">
                        ₱<?= number_format($itemTotal, 2) ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="summary-totals">
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>₱<?= number_format($total, 2) ?></span>
                </div>
                <div class="summary-row">
                    <span>Shipping:</span>
                    <span>FREE</span>
                </div>
                <div class="summary-row total">
                    <span>Total:</span>
                    <span>₱<?= number_format($total, 2) ?></span>
                </div>
            </div>
            
            <a href="cart.php" class="btn btn-secondary">Back to Cart</a>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Basic form validation
    document.getElementById('checkout-form').addEventListener('submit', function(e) {
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        
        let valid = true;
        const errors = [];
        
        // Email validation
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            valid = false;
            errors.push('Please enter a valid email address.');
        }
        
        // Phone validation
        if (!/^\+?[0-9]{10,15}$/.test(phone)) {
            valid = false;
            errors.push('Please enter a valid phone number.');
        }
        
        if (!valid) {
            e.preventDefault();
            alert('Please correct the following errors:\n' + errors.join('\n'));
        }
    });
});
</script>
</body>
</html>