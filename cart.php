<?php
session_start();

// Function to get cart count
function getCartCount() {
    if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        return count($_SESSION['cart']);
    }
    return 0;
}

// Process cart actions
if(isset($_POST['action']) && isset($_POST['index'])) {
    $action = $_POST['action'];
    $index = (int)$_POST['index'];
    
    if($action === 'update' && isset($_POST['field']) && isset($_POST['value'])) {
        $field = $_POST['field'];
        $value = $_POST['value'];
        
        if(isset($_SESSION['cart'][$index])) {
            if($field === 'quantity') {
                $_SESSION['cart'][$index][$field] = (int)$value;
            } else {
                $_SESSION['cart'][$index][$field] = $value;
            }
        }
    } elseif($action === 'remove') {
        if(isset($_SESSION['cart'][$index])) {
            array_splice($_SESSION['cart'], $index, 1);
        }
    } elseif($action === 'clear') {
        $_SESSION['cart'] = [];
    }
    
    // Redirect to avoid form resubmission
    header('Location: cart.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <header class="navbar">
        <div class="logo">
            <img src="img/noxlogo.png" alt="Nox Apparel Logo" class="logo-img">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="collection.php">Collections</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php" class="btn"><i class="fas fa-shopping-cart"></i> (<span id="cart-count"><?php echo getCartCount(); ?></span>)</a></li>
            </ul>
        </nav>
    </header>

    <h1>Your Shopping Cart</h1>
    <div id="cart-items">
        <?php
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $totalAmount = 0;
        
        if(empty($cart)) {
            echo "<p>Your cart is empty.</p>";
        } else {
            foreach($cart as $index => $item) {
                $itemTotal = $item['price'] * $item['quantity'];
                $totalAmount += $itemTotal;
                ?>
                <div class="cart-item">
                    <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="cart-img">
                    <div class="cart-details">
                        <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p>₱<?php echo number_format($item['price'], 2); ?> each</p>
                        
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            
                            <label>Size:</label>
                            <select name="value" onchange="this.form.field.value='size'; this.form.submit();">
                                <option value="S" <?php echo $item['size'] === "S" ? "selected" : ""; ?>>S</option>
                                <option value="M" <?php echo $item['size'] === "M" ? "selected" : ""; ?>>M</option>
                                <option value="L" <?php echo $item['size'] === "L" ? "selected" : ""; ?>>L</option>
                                <option value="XL" <?php echo $item['size'] === "XL" ? "selected" : ""; ?>>XL</option>
                            </select>
                            <input type="hidden" name="field" value="size">
                        </form>
                        
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            
                            <label>Color:</label>
                            <select name="value" onchange="this.form.field.value='color'; this.form.submit();">
                                <option value="red" <?php echo $item['color'] === "red" ? "selected" : ""; ?>>Red</option>
                                <option value="blue" <?php echo $item['color'] === "blue" ? "selected" : ""; ?>>Blue</option>
                                <option value="black" <?php echo $item['color'] === "black" ? "selected" : ""; ?>>Black</option>
                                <option value="white" <?php echo $item['color'] === "white" ? "selected" : ""; ?>>White</option>
                            </select>
                            <input type="hidden" name="field" value="color">
                        </form>
                        
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <input type="hidden" name="field" value="quantity">
                            
                            <label>Quantity:</label>
                            <input type="number" name="value" value="<?php echo $item['quantity']; ?>" min="1" onchange="this.form.submit();">
                        </form>
                        
                        <p>Total: ₱<?php echo number_format($itemTotal, 2); ?></p>
                        
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <input type="hidden" name="action" value="remove">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <button type="submit">Remove</button>
                        </form>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <h2>Total: <span id="cart-total">₱<?php echo number_format($totalAmount, 2); ?></span></h2>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style="display: inline;">
        <input type="hidden" name="action" value="clear">
        <input type="hidden" name="index" value="0">
        <button type="submit">Clear Cart</button>
    </form>
    
    <button onclick="window.location.href='checkout.php'">Proceed to Checkout</button>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; <?php echo date("Y"); ?> Nox Apparel. All Rights Reserved.</p>
    </footer>
</body>
</html>