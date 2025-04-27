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
    <div class="container">
        <h2>Featured Collections</h2>
        <div class="collection-grid">
            <div class="collection-item">
                <div class="product-image">
                    <img src="assets/img/24.png" alt="Men's Collection">
                    <div class="quick-view">
                        <a href="collection.php?category=men" class="quick-btn">View Collection</a>
                    </div>
                </div>
                <div class="product-info">
                    <h3>Men's Collection</h3>
                </div>
            </div>
            <div class="collection-item">
                <div class="product-image">
                    <img src="assets/img/12.png" alt="Women's Collection">
                    <div class="quick-view">
                        <a href="collection.php?category=women" class="quick-btn">View Collection</a>
                    </div>
                </div>
                <div class="product-info">
                    <h3>Women's Collection</h3>
                </div>
            </div>
            <div class="collection-item">
                <div class="product-image">
                    <img src="assets/img/1.png" alt="New Arrivals">
                    <div class="quick-view">
                        <a href="collection.php?category=new" class="quick-btn">View Collection</a>
                    </div>
                </div>
                <div class="product-info">
                    <h3>New Arrivals</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trending Now -->
<section class="trending">
    <div class="container">
        <h2>Trending Now</h2>
        <div class="collection-grid trending-grid">
            <div class="collection-item trending-item">
                <div class="product-image">
                    <img src="assets/img/29.png" alt="Jacket">
                    <div class="quick-view">
                        <a href="product.php?id=jacket" class="quick-btn">Quick View</a>
                    </div>
                </div>
                <div class="product-info">
                    <h3>Stylish Jacket</h3>
                    <div class="price">$129.99</div>
                    <div class="product-actions">
                        <a href="product.php?id=jacket" class="btn view-details-btn">View Details</a>
                    </div>
                </div>
            </div>
            <div class="collection-item trending-item">
                <div class="product-image">
                    <img src="assets/img/19.png" alt="Sneakers">
                    <div class="quick-view">
                        <a href="product.php?id=sneakers" class="quick-btn">Quick View</a>
                    </div>
                </div>
                <div class="product-info">
                    <h3>Casual Sneakers</h3>
                    <div class="price">$89.99</div>
                    <div class="product-actions">
                        <a href="product.php?id=sneakers" class="btn view-details-btn">View Details</a>
                    </div>
                </div>
            </div>
            <div class="collection-item trending-item">
                <div class="product-image">
                    <img src="assets/img/30.png" alt="Bag">
                    <div class="quick-view">
                        <a href="product.php?id=bag" class="quick-btn">Quick View</a>
                    </div>
                </div>
                <div class="product-info">
                    <h3>Leather Bag</h3>
                    <div class="price">$149.99</div>
                    <div class="product-actions">
                        <a href="product.php?id=bag" class="btn view-details-btn">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Offers -->
<section class="offers">
    <div class="container">
        <h2>Limited-Time Offers</h2>
        <p>Exclusive discounts available for a limited period. Don't miss out!</p>
        <a href="shop.php" class="btn">Shop Deals</a>
    </div>
</section>

<!-- Testimonials -->
<section class="testimonials">
    <div class="container">
        <h2>What Our Customers Say</h2>
        <p>⭐⭐⭐⭐⭐ "Amazing quality and style! Highly recommended." - Alex M.</p>
        <p>⭐⭐⭐⭐⭐ "The best fashion store with fast shipping!" - Jamie L.</p>
    </div>
</section>

<!-- Newsletter -->
<section class="newsletter" id="signup">
    <div class="container">
        <h2>Stay Updated</h2>
        <p>Sign up for our newsletter to get the latest updates and exclusive discounts.</p>
        <form class="newsletter-form">
            <input type="email" placeholder="Enter your email" required>
            <button type="submit" class="btn">Subscribe</button>
        </form>
    </div>
</section>

<?php include('footer.php'); ?>