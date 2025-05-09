<?php
require_once 'includes/header.php';

// Handle POST requests (add to cart)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $productId = $_POST['product_id'];
        $quantity = (int)$_POST['quantity'];
        
        // Initialize cart if not exists
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        // Add or update item in cart
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }
        
        // Redirect to prevent form resubmission
        header('Location: cart.php');
        exit;
    }
}

// Handle GET requests (update/remove items)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        $productId = $_GET['product_id'] ?? null;
        
        if ($productId && isset($_SESSION['cart'][$productId])) {
            switch ($_GET['action']) {
                case 'update':
                    $quantity = (int)$_GET['quantity'];
                    if ($quantity > 0) {
                        $_SESSION['cart'][$productId] = $quantity;
                    } else {
                        unset($_SESSION['cart'][$productId]);
                    }
                    break;
                    
                case 'remove':
                    unset($_SESSION['cart'][$productId]);
                    break;
            }
        }
        
        // Redirect to prevent form resubmission
        header('Location: cart.php');
        exit;
    }
}

// Calculate cart totals
$cartItems = [];
$subtotal = 0;
$shipping = 10; // Fixed shipping cost
$tax = 0.1; // 10% tax

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        $product = Product::getById($productId);
        if ($product) {
            $itemTotal = $product->getUnitCost() * $quantity;
            $subtotal += $itemTotal;
            
            $cartItems[] = [
                'product' => $product,
                'quantity' => $quantity,
                'total' => $itemTotal
            ];
        }
    }
}

$taxAmount = $subtotal * $tax;
$total = $subtotal + $shipping + $taxAmount;
?>

<div class="cart-page">
    <div class="container">
        <h1>Shopping Cart</h1>
        
        <?php if (empty($cartItems)): ?>
            <div class="empty-cart">
                <p>Your cart is empty.</p>
                <a href="products.php" class="btn btn-primary">Continue Shopping</a>
            </div>
        <?php else: ?>
            <div class="cart-content">
                <div class="cart-items">
                    <?php foreach ($cartItems as $item): ?>
                        <div class="cart-item">
                            <img src="<?php echo htmlspecialchars($item['product']->getImageUrl()); ?>" alt="<?php echo htmlspecialchars($item['product']->getProductName()); ?>" class="cart-item-image">
                            
                            <div class="cart-item-details">
                                <h3><?php echo htmlspecialchars($item['product']->getProductName()); ?></h3>
                                <p class="item-price">$<?php echo number_format($item['product']->getUnitCost(), 2); ?></p>
                                
                                <div class="quantity-controls">
                                    <form action="cart.php" method="GET" class="quantity-form">
                                        <input type="hidden" name="product_id" value="<?php echo $item['product']->getProductID(); ?>">
                                        <input type="hidden" name="action" value="update">
                                        <select name="quantity" onchange="this.form.submit()">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <option value="<?php echo $i; ?>" <?php echo $i === $item['quantity'] ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </form>
                                    
                                    <a href="cart.php?action=remove&product_id=<?php echo $item['product']->getProductID(); ?>" class="remove-item">Remove</a>
                                </div>
                            </div>
                            
                            <div class="cart-item-total">
                                $<?php echo number_format($item['total'], 2); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="cart-summary">
                    <h2>Order Summary</h2>
                    <div class="summary-item">
                        <span>Subtotal</span>
                        <span>$<?php echo number_format($subtotal, 2); ?></span>
                    </div>
                    <div class="summary-item">
                        <span>Shipping</span>
                        <span>$<?php echo number_format($shipping, 2); ?></span>
                    </div>
                    <div class="summary-item">
                        <span>Tax (10%)</span>
                        <span>$<?php echo number_format($taxAmount, 2); ?></span>
                    </div>
                    <div class="summary-item total">
                        <span>Total</span>
                        <span>$<?php echo number_format($total, 2); ?></span>
                    </div>
                    
                    <div class="checkout-actions">
                        <a href="products.php" class="btn btn-secondary">Continue Shopping</a>
                        <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
