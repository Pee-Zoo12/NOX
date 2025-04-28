<?php
$name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : "Product Name";
$price = isset($_GET['price']) ? htmlspecialchars($_GET['price']) : "0.00";
$image = isset($_GET['image']) ? htmlspecialchars($_GET['image']) : "img/default.png";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $name; ?> | Nox Apparel</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/535698f917.js" crossorigin="anonymous"></script>
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
                <li><a href="collection.php" class="active">Collections</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php" class="btn"><i class="fas fa-shopping-cart"></i> (<span id="cart-count">0</span>)</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="product-details">
            <div class="product-image">
                <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
            </div>
            <div class="product-info">
                <h1><?php echo $name; ?></h1>
                <p class="price">₱<?php echo number_format($price, 2); ?></p>

                <form id="add-to-cart-form">
                    <label for="color">Color:</label>
                    <select id="color" name="color" required>
                        <option value="Black">Black</option>
                        <option value="White">White</option>
                        <option value="Brown">Brown</option>
                    </select>

                    <label for="size">Size:</label>
                    <select id="size" name="size" required>
                        <option value="XS">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>

                    <button type="button" onclick="addToCart()" class="btn">Add to Cart</button>
                    <button type="button" onclick="buyNow()" class="btn buy-now-btn">Buy Now</button>
                </form>
            </div>
        </section>

        <!-- Related Products -->
        <section class="related-products">
            <h2>Related Products</h2>
            <div class="product-list">
                <?php
                $related = [
                    ["Denim Pants", 1299, "img/1.png"],
                    ["Casual Shorts", 899, "img/24.png"],
                    ["Formal Polo", 1599, "img/25.png"],
                    ["Stylish Jacket", 799, "img/30.png"]
                ];

                foreach ($related as $prod) {
                    $rName = htmlspecialchars($prod[0]);
                    $rPrice = htmlspecialchars($prod[1]);
                    $rImage = htmlspecialchars($prod[2]);
                    echo "
                    <div class='product-item'>
                        <img src='{$rImage}' alt='{$rName}'>
                        <h3>{$rName}</h3>
                        <p>₱" . number_format($rPrice, 2) . "</p>
                        <a href='product-details.php?name=" . urlencode($rName) . "&price={$rPrice}&image=" . urlencode($rImage) . "' class='btn'>View Details</a>
                    </div>
                    ";
                }
                ?>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2025 Nox Apparel. All Rights Reserved.</p>
    </footer>

    <script>
        function getProductDetailsFromURL() {
            const urlParams = new URLSearchParams(window.location.search);
            return {
                name: urlParams.get("name") || "Product",
                price: parseFloat(urlParams.get("price")) || 0,
                image: urlParams.get("image") || "img/default.png"
            };
        }

        function addToCart() {
            const product = getProductDetailsFromURL();
            const color = document.getElementById("color").value;
            const size = document.getElementById("size").value;

            const cartItem = {
                name: product.name,
                price: product.price,
                image: product.image,
                color: color,
                size: size
            };

            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            cart.push(cartItem);
            localStorage.setItem("cart", JSON.stringify(cart));

            alert("Added to cart!");
            updateCartCount();
        }

        function buyNow() {
            addToCart();
            window.location.href = "checkout.php"; // redirect to checkout after adding
        }

        function updateCartCount() {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            document.getElementById("cart-count").textContent = cart.length;
        }

        updateCartCount();
    </script>
</body>
</html>
