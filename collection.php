<?php
session_start();

// CSRF protection
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Define collections with proper structure
$collections = [
    "Men's Collection" => [
        ['id' => 'mens-classic-shirt', 'name' => 'Classic Shirt', 'price' => 999, 'image' => 'img/1.png', 'category' => 'mens'],
        ['id' => 'mens-denim-pants', 'name' => 'Denim Pants', 'price' => 1299, 'image' => 'img/2.png', 'category' => 'mens'],
        ['id' => 'mens-casual-shorts', 'name' => 'Casual Shorts', 'price' => 899, 'image' => 'img/3.png', 'category' => 'mens'],
        ['id' => 'mens-formal-polo', 'name' => 'Formal Polo', 'price' => 1599, 'image' => 'img/4.png', 'category' => 'mens'],
        ['id' => 'mens-business-suit', 'name' => 'Business Suit', 'price' => 4999, 'image' => 'img/5.png', 'category' => 'mens'],
        ['id' => 'mens-casual-jacket', 'name' => 'Casual Jacket', 'price' => 2199, 'image' => 'img/6.png', 'category' => 'mens'],
    ],
    "Women's Collection" => [
        ['id' => 'womens-elegant-dress', 'name' => 'Elegant Dress', 'price' => 2499, 'image' => 'img/7.png', 'category' => 'womens'],
        ['id' => 'womens-stylish-top', 'name' => 'Stylish Top', 'price' => 999, 'image' => 'img/8.png', 'category' => 'womens'],
        ['id' => 'womens-floral-skirt', 'name' => 'Floral Skirt', 'price' => 1299, 'image' => 'img/9.png', 'category' => 'womens'],
        ['id' => 'womens-casual-shirt', 'name' => 'Casual Shirt', 'price' => 899, 'image' => 'img/10.png', 'category' => 'womens'],
        ['id' => 'womens-chic-blouse', 'name' => 'Chic Blouse', 'price' => 1199, 'image' => 'img/11.png', 'category' => 'womens'],
        ['id' => 'womens-trendy-jumpsuit', 'name' => 'Trendy Jumpsuit', 'price' => 1599, 'image' => 'img/12.png', 'category' => 'womens'],
    ],
    "Accessories Collection" => [
        ['id' => 'acc-luxury-watch', 'name' => 'Luxury Watch', 'price' => 2999, 'image' => 'img/13.png', 'category' => 'accessories'],
        ['id' => 'acc-leather-belt', 'name' => 'Leather Belt', 'price' => 999, 'image' => 'img/14.png', 'category' => 'accessories'],
        ['id' => 'acc-fashion-sunglasses', 'name' => 'Fashion Sunglasses', 'price' => 1499, 'image' => 'img/15.png', 'category' => 'accessories'],
        ['id' => 'acc-baseball-cap', 'name' => 'Baseball Cap', 'price' => 499, 'image' => 'img/16.png', 'category' => 'accessories'],
        ['id' => 'acc-leather-bag', 'name' => 'Leather Bag', 'price' => 3199, 'image' => 'img/17.png', 'category' => 'accessories'],
        ['id' => 'acc-classic-wallet', 'name' => 'Classic Wallet', 'price' => 899, 'image' => 'img/18.png', 'category' => 'accessories'],
    ],
    "Shoes Collection" => [
        ['id' => 'shoes-sporty-sneakers', 'name' => 'Sporty Sneakers', 'price' => 2499, 'image' => 'img/19.png', 'category' => 'shoes'],
        ['id' => 'shoes-comfy-slippers', 'name' => 'Comfy Slippers', 'price' => 799, 'image' => 'img/20.png', 'category' => 'shoes'],
        ['id' => 'shoes-stylish-sandals', 'name' => 'Stylish Sandals', 'price' => 1299, 'image' => 'img/21.png', 'category' => 'shoes'],
        ['id' => 'shoes-elegant-heels', 'name' => 'Elegant Heels', 'price' => 2999, 'image' => 'img/22.png', 'category' => 'shoes'],
        ['id' => 'shoes-classic-mary-janes', 'name' => 'Classic Mary Janes', 'price' => 1899, 'image' => 'img/23.png', 'category' => 'shoes'],
        ['id' => 'shoes-casual-flats', 'name' => 'Casual Flats', 'price' => 1199, 'image' => 'img/27.png', 'category' => 'shoes'],
    ]
];

// Get active filter if set
$activeCategory = isset($_GET['category']) ? $_GET['category'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collections - Nox Apparel</title>
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
                <li><a href="collection.php" class="active">Collections</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li>
                    <a href="cart.php" class="btn">
                        <i class="fas fa-shopping-cart"></i> 
                        <span id="cart-count">(<?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>)</span>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Collections Hero Section -->
    <section class="collections-hero">
        <h1>Our Exclusive Collections</h1>
        <p>Explore our carefully curated selection of stylish apparel.</p>
    </section>

    <!-- Collection Filters -->
    <section class="collection-filters">
        <div class="filter-container">
            <button class="filter-btn <?= empty($activeCategory) ? 'active' : '' ?>" data-filter="all">All Collections</button>
            <button class="filter-btn <?= $activeCategory === 'mens' ? 'active' : '' ?>" data-filter="mens">Men's</button>
            <button class="filter-btn <?= $activeCategory === 'womens' ? 'active' : '' ?>" data-filter="womens">Women's</button>
            <button class="filter-btn <?= $activeCategory === 'accessories' ? 'active' : '' ?>" data-filter="accessories">Accessories</button>
            <button class="filter-btn <?= $activeCategory === 'shoes' ? 'active' : '' ?>" data-filter="shoes">Shoes</button>
        </div>
    </section>

    <!-- Product Categories -->
    <section class="collections-container">
    <?php foreach ($collections as $category => $products): ?>
        <div class="collection-section <?= !empty($activeCategory) && $products[0]['category'] !== $activeCategory ? 'hidden' : '' ?>" data-category="<?= $products[0]['category'] ?>">
            <h2><?= htmlspecialchars($category) ?></h2>
            <div class="collection-grid">
                <?php foreach ($products as $product): ?>
                    <div class="collection-item">
                        <div class="product-image">
                            <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                            <div class="quick-view">
                                <a href="product.php?id=<?= urlencode($product['id']) ?>" class="quick-btn">Quick View</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3><?= htmlspecialchars($product['name']) ?></h3>
                            <p class="price">₱<?= number_format($product['price'], 2) ?></p>
                            <div class="product-actions">
                                <form action="add-to-cart.php" method="POST" class="add-to-cart-form">
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                    <input type="hidden" name="name" value="<?= htmlspecialchars($product['name']) ?>">
                                    <input type="hidden" name="price" value="<?= $product['price'] ?>">
                                    <input type="hidden" name="image" value="<?= htmlspecialchars($product['image']) ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn add-to-cart-btn">Add to Cart</button>
                                </form>
                                <a href="product.php?id=<?= urlencode($product['id']) ?>" class="btn view-details-btn">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="newsletter-content">
            <h2>Join Our Newsletter</h2>
            <p>Subscribe to receive updates on new arrivals and special offers.</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Enter your email address" required>
                <button type="submit" class="btn">Subscribe</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    const collectionSections = document.querySelectorAll('.collection-section');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            
            // Show/hide collection sections based on filter
            collectionSections.forEach(section => {
                if (filter === 'all' || section.getAttribute('data-category') === filter) {
                    section.classList.remove('hidden');
                } else {
                    section.classList.add('hidden');
                }
            });
            
            // Update URL with filter parameter
            const url = new URL(window.location);
            if (filter === 'all') {
                url.searchParams.delete('category');
            } else {
                url.searchParams.set('category', filter);
            }
            window.history.pushState({}, '', url);
        });
    });
    
    // AJAX add to cart functionality
    const addToCartForms = document.querySelectorAll('.add-to-cart-form');
    
    addToCartForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('add-to-cart.php', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update cart count
                    document.getElementById('cart-count').textContent = `(${data.cart_count})`;
                    
                    // Show success message
                    const button = this.querySelector('.add-to-cart-btn');
                    const originalText = button.textContent;
                    button.textContent = 'Added!';
                    button.classList.add('added');
                    
                    setTimeout(() => {
                        button.textContent = originalText;
                        button.classList.remove('added');
                    }, 2000);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
</script>
</body>
</html>