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
    <link rel="stylesheet" href="Pdetails.css">
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
                <li><a href="index.html">Home</a></li>
                <li><a href="shop.html">Shop</a></li>
                <li><a href="collection.php" class="active">Collections</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="cart.html" class="btn"><i class="fas fa-shopping-cart"></i> (<span id="cart-count">0</span>)</a></li>
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
                <p class="price">₱<?php echo $price; ?></p>

                <label for="color">Color:</label>
                <select id="color">
                    <option>Black</option>
                    <option>White</option>
                    <option>Brown</option>
                </select>

                <label for="size">Size:</label>
                <select id="size">
                    <option>XS</option>
                    <option>S</option>
                    <option>M</option>
                    <option>L</option>
                    <option>XL</option>
                </select>

                <button onclick="addToCart()" class="btn">Add to Cart</button>
                <button class="btn">Buy Now</button>
            </div>
        </section>

        <section class="related-products">
            <h2>Related Products</h2>
            <div class="product-list">
                <?php
                $related = [
                    ["Denim Pants", 1299, "img/1.png"],
                    ["Casual Shorts", 899, "img/24.png"],
                    ["Formal Polo", 1599, "img/25.png"]
                ];

                foreach ($related as $prod) {
                    $rName = htmlspecialchars($prod[0]);
                    $rPrice = htmlspecialchars($prod[1]);
                    $rImage = htmlspecialchars($prod[2]);
                    echo "
                    <div class='product-item'>
                        <img src='{$rImage}' alt='{$rName}'>
                        <h3>{$rName}</h3>
                        <p>₱{$rPrice}</p>
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

        function updateCartCount() {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            document.getElementById("cart-count").textContent = cart.length;
        }

        updateCartCount();
    </script>
</body>
</html>
