<?php
session_start();
$cart = $_SESSION['cart'] ?? [];
$total = 0;
$cartMessage = $_SESSION['cart_message'] ?? '';

// Clear the message after displaying it once
if (isset($_SESSION['cart_message'])) {
    unset($_SESSION['cart_message']);
}

// CSRF protection
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['cart_message'] = 'Invalid form submission.';
        header("Location: cart.php");
        exit;
    }

    if (isset($_POST['update'])) {
        $index = (int)$_POST['index'];
        
        // Validate index
        if (isset($cart[$index])) {
            $cart[$index]['size'] = htmlspecialchars($_POST['size']);
            $cart[$index]['color'] = htmlspecialchars($_POST['color']);
            $cart[$index]['quantity'] = max(1, (int)$_POST['quantity']); // Ensure quantity is at least 1
            $_SESSION['cart_message'] = 'Cart updated successfully!';
        }
    } elseif (isset($_POST['remove'])) {
        $index = (int)$_POST['index'];
        
        // Validate index
        if (isset($cart[$index])) {
            unset($cart[$index]);
            $cart = array_values($cart); // Reindex
            $_SESSION['cart_message'] = 'Item removed from cart!';
        }
    } elseif (isset($_POST['clear'])) {
        $cart = [];
        $_SESSION['cart_message'] = 'Cart cleared!';
    }
    
    $_SESSION['cart'] = $cart;
    header("Location: cart.php"); // Avoid resubmission
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart - Nox Apparel</title>
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
            <li><a href="cart.php" class="btn active"><i class="fas fa-shopping-cart"></i> (<?= count($cart) ?>)</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <h1>Your Shopping Cart</h1>
    
    <?php if (!empty($cartMessage)): ?>
        <div class="message"><?= $cartMessage ?></div>
    <?php endif; ?>
    
    <div id="cart-items">
    <?php if (empty($cart)): ?>
        <div class="empty-cart">
            <i class="fas fa-shopping-cart fa-4x"></i>
            <p>Your cart is empty.</p>
            <a href="shop.php" class="btn">Continue Shopping</a>
        </div>
    <?php else: ?>
        <?php foreach ($cart as $index => $item): 
            $itemTotal = $item['price'] * $item['quantity'];
            $total += $itemTotal;
        ?>
        <div class="cart-item">
            <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="cart-img">
            <div class="cart-details">
                <h3><?= htmlspecialchars($item['name']) ?></h3>
                <p class="price">₱<?= number_format($item['price'], 2) ?> each</p>

                <form method="POST" class="cart-form">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="index" value="<?= $index ?>">

                    <div class="form-row">
                        <div class="form-group">
                            <label for="size-<?= $index ?>">Size:</label>
                            <select id="size-<?= $index ?>" name="size" class="form-control">
                                <?php foreach (["S", "M", "L", "XL"] as $size): ?>
                                    <option value="<?= $size ?>" <?= $item['size'] === $size ? 'selected' : '' ?>><?= $size ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="color-<?= $index ?>">Color:</label>
                            <select id="color-<?= $index ?>" name="color" class="form-control">
                                <?php foreach (["red", "blue", "black", "white"] as $color): ?>
                                    <option value="<?= $color ?>" <?= $item['color'] === $color ? 'selected' : '' ?>><?= ucfirst($color) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="quantity-<?= $index ?>">Quantity:</label>
                            <input type="number" id="quantity-<?= $index ?>" name="quantity" value="<?= $item['quantity'] ?>" min="1" class="form-control quantity">
                        </div>
                    </div>

                    <p class="item-total">Total: ₱<?= number_format($itemTotal, 2) ?></p>

                    <div class="cart-buttons">
                        <button type="submit" name="update" class="btn btn-update">Update</button>
                        <button type="submit" name="remove" class="btn btn-remove">Remove</button>
                    </div>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
        
        <div class="cart-summary">
            <h2>Order Summary</h2>
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
            
            <div class="cart-actions">
                <form method="POST" class="clear-form">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <button type="submit" name="clear" class="btn btn-secondary">Clear Cart</button>
                </form>
                <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
            </div>
        </div>
    <?php endif; ?>
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
    // Auto-hide message after 5 seconds
    const message = document.querySelector('.message');
    if (message) {
        setTimeout(function() {
            message.style.opacity = '0';
            setTimeout(function() {
                message.style.display = 'none';
            }, 500);
        }, 5000);
    }
    
    // Update item total when quantity changes
    const quantityInputs = document.querySelectorAll('.quantity');
    quantityInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            const form = this.closest('form');
            const index = form.querySelector('[name="index"]').value;
            const price = parseFloat(form.parentNode.querySelector('.price').textContent.replace('₱', '').replace(',', ''));
            const quantity = parseInt(this.value);
            const totalElement = form.querySelector('.item-total');
            
            totalElement.textContent = 'Total: ₱' + (price * quantity).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        });
    });
});
</script>
</body>
</html>