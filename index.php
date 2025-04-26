<?php include('header.php'); ?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1>Style That Speaks</h1>
        <p>Discover the latest trends in fashion. Shop now and redefine your wardrobe.</p>
        <a href="collection.php" class="btn">Shop Now</a>
    </div>
</section>

<!-- Featured Collections -->
<section class="featured" id="collections">
    <h2>Featured Collections</h2>
    <div class="collection-grid">
        <div class="collection-item">
            <img src="assets/img/24.png" alt="Men's Collection">
            <h3>Men’s Collection</h3>
        </div>
        <div class="collection-item">
            <img src="assets/img/12.png" alt="Women's Collection">
            <h3>Women’s Collection</h3>
        </div>
        <div class="collection-item">
            <img src="assets/img/1.png" alt="New Arrivals">
            <h3>New Arrivals</h3>
        </div>
    </div>
</section>

<!-- Trending Now -->
<section class="trending">
    <h2>Trending Now</h2>
    <div class="trending-grid">
        <div class="trending-item">
            <img src="assets/img/29.png" alt="Jacket">
            <p>Stylish Jacket</p>
        </div>
        <div class="trending-item">
            <img src="assets/img/19.png" alt="Sneakers">
            <p>Casual Sneakers</p>
        </div>
        <div class="trending-item">
            <img src="assets/img/30.png" alt="Bag">
            <p>Leather Bag</p>
        </div>
    </div>
</section>

<!-- Offers -->
<section class="offers">
    <h2>Limited-Time Offers</h2>
    <p>Exclusive discounts available for a limited period. Don't miss out!</p>
    <a href="shop.php" class="btn">Shop Deals</a>
</section>

<!-- Testimonials -->
<section class="testimonials">
    <h2>What Our Customers Say</h2>
    <p>⭐⭐⭐⭐⭐ "Amazing quality and style! Highly recommended." - Alex M.</p>
    <p>⭐⭐⭐⭐⭐ "The best fashion store with fast shipping!" - Jamie L.</p>
</section>

<!-- Sign In / Newsletter -->
<section class="newsletter" id="signup">
    <h2>Stay Updated</h2>
    <p>Sign up for our newsletter to get the latest updates and exclusive discounts.</p>
    <form>
        <input type="email" placeholder="Enter your email" required>
        <button type="submit" class="btn">Subscribe</button>
    </form>
</section>

<?php include('footer.php'); ?>
