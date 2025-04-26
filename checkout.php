<?php
session_start();
$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Nox Apparel</title>
    <link rel="stylesheet" href="cart.css">
</head>
<body>
<header class="navbar">
    <div class="logo">
        <img src="img/noxlogo.png" alt="Nox Apparel Logo" class="logo-img">
    </div>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="shop.html">Shop</a></li>
            <li><a href="collection.html">Collections</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
    </nav>
</header>

<h1>Order Summary</h1>

<div id="checkout-summary">
<?php if (empty($cart)): ?>
    <p>Your cart is empty.</p>
<?php else: ?>
    <?php foreach ($cart as $item): 
        $itemTotal = $item['price'] * $item['quantity'];
        $total += $itemTotal;
    ?>
    <div class="checkout-item">
        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="checkout-img">
        <div>
            <h3><?= htmlspecialchars($item['name']) ?></h3>
            <p>Size: <?= htmlspecialchars($item['size']) ?></p>
            <p>Color: <?= htmlspecialchars($item['color']) ?></p>
            <p>Qty: <?= $item['quantity'] ?></p>
            <p>₱<?= number_format($itemTotal, 2) ?></p>
        </div>
    </div>
    <?php endforeach; ?>

    <h2>Total Amount: ₱<?= number_format($total, 2) ?></h2>

    <form action="place-order.php" method="POST">
        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" id="fullname" required>

        <label for="address">Shipping Address:</label>
        <textarea name="address" id="address" required></textarea>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <button type="submit">Place Order</button>
    </form>
<?php endif; ?>
</div>

</body>
</html>
