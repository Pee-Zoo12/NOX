<?php
session_start();

$categories = ["All Categories", "Men", "Women", "Accessories"];

// Sample function to get cart count
function getCartCount() {
    if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        return count($_SESSION['cart']);
    }
    return 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Nox Apparel</title>
    <link rel="stylesheet" href="css/shop.css">
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
                <li><a href="shop.php" class="active">Shop</a></li>
                <li><a href="collection.php">Collections</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php" class="btn"><i class="fas fa-shopping-cart"></i> (<?php echo getCartCount(); ?>)</a></li>
            </ul>
        </nav>
    </header>

    <!-- Shop Hero Section -->
    <section class="shop-hero">
        <h1>Explore Our Collection</h1>
        <p>Find the latest styles and best deals.</p>
    </section>

    <!-- Filter & Search Section -->
    <section class="filter-bar">
        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="search" placeholder="Search for products..." class="search-bar" 
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            
            <select name="category" class="filter-dropdown">
                <?php
                foreach($categories as $category) {
                    $value = strtolower($category);
                    $selected = (isset($_GET['category']) && $_GET['category'] == $value) ? 'selected' : '';
                    echo "<option value=\"$value\" $selected>$category</option>";
                }
                ?>
            </select>
            <button type="submit" class="filter-btn">Filter</button>
        </form>
    </section>

    <!-- Product Grid -->
    <section class="product-grid">
        <a href="product-details.php?product=mens" class="product-item">
            <img src="img/24.png" alt="Men's Collection">
            <h3>Men's Collection</h3>
            <p>explore</p>
        </a>
        <a href="product-details.php?product=womens" class="product-item">
            <img src="img/25.png" alt="Women's Collection">
            <h3>Women's Collection</h3>
            <p>explore</p>
        </a>
        <a href="product-details.php?product=accessories" class="product-item">
            <img src="img/26.png" alt="Accessories">
            <h3>Accessories</h3>
            <p>explore</p>
        </a>
        <a href="product-details.php?product=footwear" class="product-item">
            <img src="img/27.png" alt="Footwear Collection">
            <h3>Footwear Collection</h3>
            <p>explore</p>
        </a>
    </section>
    <footer class="footer">
        <p>&copy; <?php echo date("Y"); ?> Nox Apparel. All Rights Reserved.</p>
    </footer>

</body>
</html>