<?php include('header.php'); ?> <!-- Optional: Use this if you have a separate header file -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collections</title>
    <link rel="stylesheet" href="collection.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <!-- Header -->
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
                <li><a href="cart.php" class="btn"><i class="fas fa-shopping-cart"></i> (0)</a></li>
            </ul>
        </nav>
    </header>

    <!-- Collections Hero Section -->
    <section class="collections-hero">
        <h1>Our Exclusive Collections</h1>
        <p>Explore our carefully curated selection of stylish apparel.</p>
    </section>

    <!-- Product Categories -->
    <section class="collection-grid">
        <?php
        $collections = [
            'Men\'s Collection' => [
                ['Classic Shirt', 999, 'img/1.png'],
                ['Denim Pants', 1299, 'img/2.png'],
                ['Casual Shorts', 899, 'img/3.png'],
                ['Formal Polo', 1599, 'img/4.png'],
                ['Business Suit', 4999, 'img/5.png'],
                ['Casual Jacket', 2199, 'img/6.png'],
            ],
            'Women\'s Collection' => [
                ['Elegant Dress', 2499, 'img/7.png'],
                ['Stylish Top', 999, 'img/8.png'],
                ['Floral Skirt', 1299, 'img/9.png'],
                ['Casual Shirt', 899, 'img/10.png'],
                ['Chic Blouse', 1199, 'img/11.png'],
                ['Trendy Jumpsuit', 1599, 'img/12.png'],
            ],
            'Accessories Collection' => [
                ['Luxury Watch', 2999, 'img/13.png'],
                ['Leather Belt', 999, 'img/14.png'],
                ['Fashion Sunglasses', 1499, 'img/15.png'],
                ['Baseball Cap', 499, 'img/16.png'],
                ['Leather Bag', 3199, 'img/17.png'],
                ['Classic Wallet', 899, 'img/18.png'],
            ],
            'Shoes Collection' => [
                ['Sporty Sneakers', 2499, 'img/19.png'],
                ['Comfy Slippers', 799, 'img/20.png'],
                ['Stylish Sandals', 1299, 'img/21.png'],
                ['Elegant Heels', 2999, 'img/22.png'],
                ['Classic Mary Janes', 1899, 'img/23.png'],
                ['Casual Flats', 1199, 'img/24.png'],
            ]
        ];

        foreach ($collections as $category => $products) {
            echo "<div class='category-title'>$category</div>";
            echo "<div class='product-list'>";
            foreach ($products as [$name, $price, $image]) {
                $encodedName = urlencode($name);
                echo "
                    <div class='product-item'>
                        <img src='$image' alt='$name'>
                        <h3>$name</h3>
                        <p>₱$price</p>
                        <a href='product-details.php?name=$encodedName&price=$price&image=$image' class='btn'>View Details</a>
                    </div>
                ";
            }
            echo "</div>";
        }
        ?>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Nox Apparel. All Rights Reserved.</p>
    </footer>

</body>
</html>

<?php include('footer.php'); ?> <!-- Optional: Use this if you have a separate footer file -->
