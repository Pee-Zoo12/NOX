<?php
require_once 'includes/header.php';
require_once 'classes/Product.php';

// Get featured products
$featuredProducts = Product::getAll();
$featuredProducts = array_slice($featuredProducts, 0, 8); // Get first 8 products
?>

<div class="hero-section" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('assets/hero-bg.jpg'); background-size: cover; background-position: center; height: 80vh; display: flex; align-items: center; justify-content: center; text-align: center; color: white;">
    <div class="hero-content">
        <h1>Welcome to NOX Clothing</h1>
        <p>Discover our premium collection of sustainable fashion</p>
        <a href="products.php" class="btn btn-primary">Shop Now</a>
    </div>
</div>

<section class="featured-products">
    <div class="container">
        <h2>Featured Products</h2>
        <div class="product-grid">
            <?php foreach ($featuredProducts as $product): ?>
                <div class="product-card">
                    <img src="<?php echo htmlspecialchars($product->getImageUrl()); ?>" alt="<?php echo htmlspecialchars($product->getProductName()); ?>" class="product-image">
                    <div class="product-info">
                        <h3 class="product-title"><?php echo htmlspecialchars($product->getProductName()); ?></h3>
                        <p class="product-price">$<?php echo number_format($product->getUnitCost(), 2); ?></p>
                        <a href="product-details.php?id=<?php echo $product->getProductID(); ?>" class="btn btn-secondary">View Details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="categories">
    <div class="container">
        <h2>Shop by Category</h2>
        <div class="category-grid">
            <div class="category-card">
                <img src="assets/men.jpg" alt="Men's Collection">
                <h3>Men's Collection</h3>
                <a href="products.php?category=men" class="btn btn-primary">Shop Now</a>
            </div>
            <div class="category-card">
                <img src="assets/women.jpg" alt="Women's Collection">
                <h3>Women's Collection</h3>
                <a href="products.php?category=women" class="btn btn-primary">Shop Now</a>
            </div>
            <div class="category-card">
                <img src="assets/accessories.jpg" alt="Accessories">
                <h3>Accessories</h3>
                <a href="products.php?category=accessories" class="btn btn-primary">Shop Now</a>
            </div>
        </div>
    </div>
</section>

<section class="newsletter">
    <div class="container">
        <h2>Subscribe to Our Newsletter</h2>
        <p>Stay updated with our latest collections and exclusive offers</p>
        <form action="subscribe.php" method="POST" class="newsletter-form">
            <input type="email" name="email" placeholder="Enter your email" required>
            <button type="submit" class="btn btn-primary">Subscribe</button>
        </form>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
