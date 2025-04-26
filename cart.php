<?php
session_start();
$cart = $_SESSION['cart'] ?? [];
$total = 0;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['update'])) {
        $index = $_POST['index'];
        $cart[$index]['size'] = $_POST['size'];
        $cart[$index]['color'] = $_POST['color'];
        $cart[$index]['quantity'] = (int)$_POST['quantity'];
    } elseif (isset($_POST['remove'])) {
        $index = $_POST['index'];
        unset($cart[$index]);
        $cart = array_values($cart); // Reindex
    } elseif (isset($_POST['clear'])) {
        $cart = [];
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
    <title>Your Cart</title>
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
            <li><a href="cart.php" class="btn"><i class="fas fa-shopping-cart"></i> (<?= count($cart) ?>)</a></li>
        </ul>
    </nav>
</header>

<h1>Your Shopping Cart</h1>

<div id="cart-items">
<?php if (empty($cart)): ?>
    <p>Your cart is empty.</p>
<?php else: ?>
    <?php foreach ($cart as $index => $item): 
        $itemTotal = $item['price'] * $item['quantity'];
        $total += $itemTotal;
    ?>
    <div class="cart-item">
        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="cart-img">
        <div class="cart-details">
            <h3><?= htmlspecialchars($item['name']) ?></h3>
            <p>₱<?= number_format($item['price'], 2) ?> each</p>

            <form method="POST">
                <input type="hidden" name="index" value="<?= $index ?>">

                <label>Size:</label>
                <select name="size">
                    <?php foreach (["S", "M", "L", "XL"] as $size): ?>
                        <option value="<?= $size ?>" <?= $item['size'] === $size ? 'selected' : '' ?>><?= $size ?></option>
                    <?php endforeach; ?>
                </select>

                <label>Color:</label>
                <select name="color">
                    <?php foreach (["red", "blue", "black", "white"] as $color): ?>
                        <option value="<?= $color ?>" <?= $item['color'] === $color ? 'selected' : '' ?>><?= ucfirst($color) ?></option>
                    <?php endforeach; ?>
                </select>

                <label>Quantity:</label>
                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1">

                <p>Total: ₱<?= number_format($itemTotal, 2) ?></p>

                <button type="submit" name="update">Update</button>
                <button type="submit" name="remove">Remove</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>
</div>

<h2>Total: <span id="cart-total">₱<?= number_format($total, 2) ?></span></h2>

<form method="POST">
    <button type="submit" name="clear">Clear Cart</button>
</form>

<button onclick="window.location.href='checkout.php'">Proceed to Checkout</button>

</body>
</html>
