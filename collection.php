<?php
session_start();

// Function to get cart count
function getCartCount() {
    if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        return count($_SESSION['cart']);
    }
    return 0;
}

// Sample product data - in a real app, this would come from a database
$products = [
    'mens' => [
        ['id' => 1, 'name' => 'Classic Shirt', 'price' => 999, 'image' => 'img/1.png'],
        ['id' => 2, 'name' => 'Denim Pants', 'price' => 1299, 'image' => 'img/2.png'],
        ['id' => 3, 'name' => 'Casual Shorts', 'price' => 899, 'image' => 'img/3.png'],
        ['id' => 4, 'name' => 'Formal Polo', 'price' => 1599, 'image' => 'img/4.png'],
        ['id' => 5, 'name' => 'Business Suit', 'price' => 4999, 'image' => 'img/5.png'],
        ['id' => 6, 'name' => 'Casual Jacket', 'price' => 2199, 'image' => 'img/6.png']
    ],
    'womens' => [
        ['id' => 7, 'name' => 'Elegant Dress', 'price' => 2499, 'image' => 'img/7.png'],
        ['id' => 8, 'name' => 'Stylish Top', 'price' => 999, 'image' => 'img/8.png'],
        ['id' => 9, 'name' => 'Floral Skirt', 'price' => 1299, 'image' => 'img/9.png'],
        ['id' => 10, 'name' => 'Casual Shirt', 'price' => 899, 'image' => 'img/10.png'],
        ['id' => 11, 'name' => 'Chic Blouse', 'price' => 1199, 'image' => 'img/11.png'],
        ['id' => 12, 'name' => 'Trendy Jumpsuit', 'price' => 1599, 'image' => 'img/12.png']
    ],
    'accessories' => [
        ['id' => 13, 'name' => 'Luxury Watch', 'price' => 2999, 'image' => 'img/13.png'],
        ['id' => 14, 'name' => 'Leather Belt', 'price' => 999, 'image' => 'img/14.png'],
        ['id' => 15, 'name' => 'Fashion Sunglasses', 'price' => 1499, 'image' => 'img/15.png'],
        ['id' => 16, 'name' => 'Baseball Cap', 'price' => 499, 'image' => 'img/16.png'],
        ['id' => 17, 'name' => 'Leather Bag', 'price' => 3199, 'image' => 'img/17.png'],
        ['id' => 18, 'name' => 'Classic Wallet', 'price' => 899, 'image' => 'img/18.png']
    ],
    'shoes' => [
        ['id' => 19, 'name' => 'Sporty Sneakers', 'price' => 2499, 'image' => 'img/19.png'],
        ['id' => 20, 'name' => 'Comfy Slippers', 'price' => 799, 'image' => 'img/20.png'],
        ['id' => 21, 'name' => 'Stylish Sandals', 'price' => 1299, 'image' => 'img/21.png'],
        ['id' => 22, 'name' => 'Elegant Heels', 'price' => 2999, 'image' => 'img/22.png'],
        ['id' => 23, 'name' => 'Classic Mary Janes', 'price' => 1899, 'image' => 'img/23.png'],
        ['id' => 24, 'name' => 'Casual Flats', 'price' => 1199, 'image' => 'img/24.png']
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collections - Nox Apparel</title>
    <link rel="stylesheet" href="css/collection.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <!-- Header / Navbar -->
    <header class="navbar">
        <div class="logo">
            <img src="img/noxlogo.png" alt="Nox Apparel Logo" class="logo-img">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="#" class="active">Collections</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php" class="btn"><i class="fas fa-shopping-cart"></i> (<?php echo getCartCount(); ?>)</a></li>
            </ul>
        </nav>
    </header>

    <!-- Collections Hero Section -->
    <section class="collections-hero">
        <h1>Our Exclusive Collections</h1>
        <p>Explore our carefully curated selection of stylish apparel.</p>
    </section>

    <!-- Product Collection Grid -->
    <section class="collection-grid">
        <!-- Men Category -->
        <div class="category-title" id="men">Men's Collection</div>
        <div class="product-list">
            <?php foreach($products['mens'] as $product): ?>
            <div class="product-item">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p>₱<?php echo number_format($product['price']); ?></p>
                <a href="product-details.php?id=<?php echo $product['id']; ?>" class="btn">View Details</a>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Women Category -->
        <div class="category-title" id="women">Women's Collection</div>
        <div class="product-list">
            <?php foreach($products['womens'] as $product): ?>
            <div class="product-item">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p>₱<?php echo number_format($product['price']); ?></p>
                <a href="product-details.php?id=<?php echo $product['id']; ?>" class="btn">View Details</a>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Accessories Category -->
        <div class="category-title" id="accessories">Accessories Collection</div>
        <div class="product-list">
            <?php foreach($products['accessories'] as $product): ?>
            <div class="product-item">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p>₱<?php echo number_format($product['price']); ?></p>
                <a href="product-details.php?id=<?php echo $product['id']; ?>" class="btn">View Details</a>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Shoes Category -->
        <div class="category-title" id="shoes">Shoes Collection</div>
        <div class="product-list">
            <?php foreach($products['shoes'] as $product): ?>
            <div class="product-item">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p>₱<?php echo number_format($product['price']); ?></p>
                <a href="product-details.php?id=<?php echo $product['id']; ?>" class="btn">View Details</a>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; <?php echo date("Y"); ?> Nox Apparel. All Rights Reserved.</p>
    </footer>
</body>
</html>