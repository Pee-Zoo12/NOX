<?php
require_once 'includes/header.php';

// Get product ID from URL
$productId = isset($_GET['id']) ? $_GET['id'] : null;

if (!$productId) {
    header('Location: products.php');
    exit;
}

// Get product details
$product = Product::getById($productId);

if (!$product) {
    header('Location: products.php');
    exit;
}
?>

<div class="product-details-page">
    <div class="container">
        <div class="product-details">
            <div class="product-gallery">
                <div class="main-image">
                    <img src="<?php echo htmlspecialchars($product->getImageUrl()); ?>" alt="<?php echo htmlspecialchars($product->getProductName()); ?>">
                </div>
                <!-- Additional images can be added here -->
            </div>

            <div class="product-info">
                <h1 class="product-title"><?php echo htmlspecialchars($product->getProductName()); ?></h1>
                <p class="product-price">$<?php echo number_format($product->getUnitCost(), 2); ?></p>
                
                <div class="product-description">
                    <h3>Description</h3>
                    <p><?php echo nl2br(htmlspecialchars($product->getDescription())); ?></p>
                </div>

                <div class="product-meta">
                    <p><strong>Product ID:</strong> <?php echo htmlspecialchars($product->getProductID()); ?></p>
                    <p><strong>Serial Number:</strong> <?php echo htmlspecialchars($product->getSerialNumber()); ?></p>
                    <p><strong>Category:</strong> <?php echo htmlspecialchars($product->getType()); ?></p>
                    <p><strong>Availability:</strong> 
                        <?php if ($product->getStockQuantity() > 0): ?>
                            <span class="in-stock">In Stock (<?php echo $product->getStockQuantity(); ?> available)</span>
                        <?php else: ?>
                            <span class="out-of-stock">Out of Stock</span>
                        <?php endif; ?>
                    </p>
                </div>

                <?php if ($product->getStockQuantity() > 0): ?>
                    <form action="cart.php" method="POST" class="add-to-cart-form">
                        <input type="hidden" name="product_id" value="<?php echo $product->getProductID(); ?>">
                        <div class="quantity-selector">
                            <label for="quantity">Quantity:</label>
                            <select name="quantity" id="quantity">
                                <?php for ($i = 1; $i <= min(5, $product->getStockQuantity()); $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                <?php else: ?>
                    <button class="btn btn-disabled" disabled>Out of Stock</button>
                <?php endif; ?>

                <div class="product-actions">
                    <button class="btn btn-secondary" onclick="window.history.back()">Back to Products</button>
                    <a href="products.php?category=<?php echo urlencode($product->getType()); ?>" class="btn btn-secondary">View Similar Products</a>
                </div>
            </div>
        </div>

        <!-- Related Products Section -->
        <section class="related-products">
            <h2>You May Also Like</h2>
            <div class="product-grid">
                <?php
                $relatedProducts = Product::getByCategory($product->getType());
                $relatedProducts = array_filter($relatedProducts, function($p) use ($product) {
                    return $p->getProductID() !== $product->getProductID();
                });
                $relatedProducts = array_slice($relatedProducts, 0, 4);
                
                foreach ($relatedProducts as $relatedProduct):
                ?>
                    <div class="product-card">
                        <img src="<?php echo htmlspecialchars($relatedProduct->getImageUrl()); ?>" alt="<?php echo htmlspecialchars($relatedProduct->getProductName()); ?>" class="product-image">
                        <div class="product-info">
                            <h3 class="product-title"><?php echo htmlspecialchars($relatedProduct->getProductName()); ?></h3>
                            <p class="product-price">$<?php echo number_format($relatedProduct->getUnitCost(), 2); ?></p>
                            <a href="product-details.php?id=<?php echo $relatedProduct->getProductID(); ?>" class="btn btn-secondary">View Details</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
