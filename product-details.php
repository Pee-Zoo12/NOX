<?php
session_start();

// Function to get cart count
function getCartCount() {
    if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        return count($_SESSION['cart']);
    }
    return 0;
}
$allProducts = [
    1 => ['id' => 1, 'name' => 'Classic Shirt', 'price' => 999, 'image' => 'img/1.png', 'stock' => 30],
    2 => ['id' => 2, 'name' => 'Denim Pants', 'price' => 1299, 'image' => 'img/2.png', 'stock' => 25],
    3 => ['id' => 3, 'name' => 'Casual Shorts', 'price' => 899, 'image' => 'img/3.png', 'stock' => 40],

];

$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = isset($allProducts[$productId]) ? $allProducts[$productId] : null;

if (!$product && isset($_GET['name']) && isset($_GET['price']) && isset($_GET['image'])) {
    $product = [
        'id' => 0,
        'name' => $_GET['name'],
        'price' => (float)$_GET['price'],
        'image' => $_GET['image'],
        'stock' => 30 // Default stock
    ];
}

if (isset($_POST['add_to_cart']) && $product) {
    // Initialize cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    

    $cartItem = [
        'id' => $product['id'],
        'name' => $product['name'],
        'price' => $product['price'],
        'image' => $product['image'],
        'size' => $_POST['size'],
        'color' => $_POST['color'],
        'quantity' => 1
    ];
    
  
    $_SESSION['cart'][] = $cartItem;
    
    // Redirect to cart page
    header('Location: cart.php');
    exit;
}

// Related products - in a real app, these would be dynamically generated
$relatedProducts = [
    ['id' => 1, 'name' => 'Denim Pants', 'price' => 1299, 'image' => 'img/1.png'],
    ['id' => 24, 'name' => 'Casual Shorts', 'price' => 899, 'image' => 'img/24.png'],
    ['id' => 25, 'name' => 'Formal Polo', 'price' => 1599, 'image' => 'img/25.png']
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product ? htmlspecialchars($product['name']) : 'Product Not Found'; ?> - Nox Apparel</title>
    <link rel="stylesheet" href="css/Pdetails.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <header class="navbar">
        <div class="logo">
            <img src="img/noxlogo.png" alt="Nox Apparel Logo" class="logo-img">
            Nox Apparel
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="collection.php" class="active">Collections</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php" class="btn"><i class="fas fa-shopping-cart"></i> (<?php echo getCartCount(); ?>)</a></li>
            </ul>
        </nav>
    </header>

    <?php if ($product): ?>
    <section id="product-details" class="product-details">
        <div class="product-image">
            <img id="product-image" src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        </div>
        <div class="product-info">
            <h1 id="product-name"><?php echo htmlspecialchars($product['name']); ?></h1>
            <p id="product-price">₱<?php echo number_format($product['price']); ?></p>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?id=' . $productId); ?>">
                <div class="options">
                    <div class="size">
                        <label for="size">Size:</label>
                        <select id="size" name="size">
                            <option value="S">Small</option>
                            <option value="M">Medium</option>
                            <option value="L">Large</option>
                            <option value="XL">X-Large</option>
                        </select>
                    </div>
                    <div class="color">
                        <label for="color">Color:</label>
                        <select id="color" name="color">
                            <option value="red">Red</option>
                            <option value="blue">Blue</option>
                            <option value="black">Black</option>
                            <option value="white">White</option>
                        </select>
                    </div>
                </div>

                <p class="stock">In Stock: <span><?php echo $product['stock']; ?> items</span></p>

                <div class="action-buttons">
                    <button type="submit" name="add_to_cart" class="btn add-to-cart">Add to Cart</button>
                    <button type="button" class="btn buy-now" onclick="window.location.href='checkout.php?id=<?php echo $productId; ?>'">Buy Now</button>
                </div>
            </form>

            <a href="collection.php" class="btn">Back to Collections</a>
        </div>
    </section>

    <!-- Customer Reviews Section -->
    <section class="customer-reviews">
        <h3>Customer Reviews</h3>
        <div class="review">
            <span class="rating">★★★★★</span>
            <p class="review-text">Great quality shirt! Fits perfectly.</p>
        </div>
        <div class="review">
            <span class="rating">★★★★☆</span>
            <p class="review-text">Good material but a little tight in size M.</p>
        </div>
        <div class="review">
            <span class="rating">★★★★★</span>
            <p class="review-text">Amazing color and fabric. Highly recommend!</p>
        </div>
        <a href="#">Write a Review</a>
    </section>

    <!-- Related Products Section -->
    <section class="related-products">
        <h2>You May Also Like</h2>
        <div class="product-list">
            <?php foreach($relatedProducts as $related): ?>
            <div class="product-item">
                <img src="<?php echo htmlspecialchars($related['image']); ?>" alt="<?php echo htmlspecialchars($related['name']); ?>">
                <h3><?php echo htmlspecialchars($related['name']); ?></h3>
                <p>₱<?php echo number_format($related['price']); ?></p>
                <a href="product-details.php?id=<?php echo $related['id']; ?>" class="btn">View Details</a>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php else: ?>
    <section class="error-section">
        <h2>Product Not Found</h2>
        <p>Sorry, the product you are looking for is not available.</p>
        <a href="collection.php" class="btn">Back to Collections</a>
    </section>
    <?php endif; ?>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; <?php echo date("Y"); ?> Nox Apparel. All Rights Reserved.</p>
    </footer>
</body>
</html>