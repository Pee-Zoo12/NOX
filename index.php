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
                    <img src="img/24.png" alt="Men's Collection">
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
                    <img src="img/12.png" alt="Women's Collection">
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
                    <img src="img/1.png" alt="New Arrivals">
                    <div class="quick-view">
                        <a href="collection.php?category=new" class="quick-btn">View Collection</a>
                    </div>
                </div>
                <div class="product-info">
                    <h3>New Arrivals</h3>
                </div>
            </div>
            <div class="collection-item">
                <div class="product-image">
                    <img src="img/15.png" alt="Accessories Collection">
                    <div class="quick-view">
                        <a href="collection.php?category=accessories" class="quick-btn">View Collection</a>
                    </div>
                </div>
                <div class="product-info">
                    <h3>Accessories</h3>
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

            <!-- Product 1 -->
            <div class="collection-item trending-item">
                <div class="product-image">
                    <img src="img/24.png" alt="Stylish Jacket">
                    <div class="quick-view">
                        <a href="product-details.php?name=Stylish+Jacket&price=800&image=img/24.png&serial=SN-JKT001" class="quick-btn">Quick View</a>
                    </div>
                </div>
                <div class="product-info">
                    <h3>Stylish Jacket</h3>
                    <div class="price">₱ 800</div>
                    <div class="product-actions">
                        <a href="product-details.php?name=Stylish+Jacket&price=800&image=img/24.png&serial=SN-JKT001" class="btn view-details-btn">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="collection-item trending-item">
                <div class="product-image">
                    <img src="img/19.png" alt="Casual Sneakers">
                    <div class="quick-view">
                        <a href="product-details.php?name=Casual+Sneakers&price=1000&image=img/19.png&serial=SN-SNK002" class="quick-btn">Quick View</a>
                    </div>
                </div>
                <div class="product-info">
                    <h3>Casual Sneakers</h3>
                    <div class="price">₱ 1,000</div>
                    <div class="product-actions">
                        <a href="product-details.php?name=Casual+Sneakers&price=1000&image=img/19.png&serial=SN-SNK002" class="btn view-details-btn">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="collection-item trending-item">
                <div class="product-image">
                    <img src="img/30.png" alt="Leather Bag">
                    <div class="quick-view">
                        <a href="product-details.php?name=Leather+Bag&price=500&image=img/30.png&serial=SN-BAG003" class="quick-btn">Quick View</a>
                    </div>
                </div>
                <div class="product-info">
                    <h3>Leather Bag</h3>
                    <div class="price">₱ 500</div>
                    <div class="product-actions">
                        <a href="product-details.php?name=Leather+Bag&price=500&image=img/30.png&serial=SN-BAG003" class="btn view-details-btn">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="collection-item trending-item">
                <div class="product-image">
                    <img src="img/8.png" alt="Stylish Top">
                    <div class="quick-view">
                        <a href="product-details.php?name=Stylish+Top&price=1500&image=img/8.png&serial=SN-TOP004" class="quick-btn">Quick View</a>
                    </div>
                </div>
                <div class="product-info">
                    <h3>Stylish Top</h3>
                    <div class="price">₱ 1,500</div>
                    <div class="product-actions">
                        <a href="product-details.php?name=Stylish+Top&price=1500&image=img/8.png&serial=SN-TOP004" class="btn view-details-btn">View Details</a>
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
        <a href="collection.php" class="btn">Shop Deals</a>
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
        <form class="newsletter-form" action="signup.php" method="POST">
            <input type="email" name="email" placeholder="Enter your email" required>
            <button type="submit" class="btn">Subscribe</button>
        </form>
    </div>
</section>

<!-- Contact Section -->
<section class="contact" id="contact">
    <div class="container">
        <h2>Contact Us</h2>
        <p>If you have any questions or concerns, feel free to reach out to us!</p>
        <a href="contact.php" class="btn">Contact Page</a>
    </div>
</section>

<?php include('footer.php'); ?>
