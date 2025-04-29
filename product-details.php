<?php
$name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : "Unknown Product";
$price = isset($_GET['price']) ? number_format((float)$_GET['price'], 2) : "0.00";
$image = isset($_GET['image']) ? htmlspecialchars($_GET['image']) : "img/default.png";
$serial = isset($_GET['serial']) ? htmlspecialchars($_GET['serial']) : strtoupper(uniqid("SN-"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $name; ?> | Nox Apparel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background-color: #f9f9f9;
        }
        .product-container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }
        img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        h1 {
            margin-top: 20px;
        }
        .price {
            font-size: 1.5rem;
            color: #444;
            margin: 10px 0;
        }
        .serial {
            font-family: monospace;
            font-size: 0.9rem;
            color: #888;
            margin-top: 5px;
        }
        a.back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #333;
            background-color: #eee;
            padding: 10px 20px;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div class="product-container">
        <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
        <h1><?php echo $name; ?></h1>
        <p class="price">₱<?php echo $price; ?></p>
        <p class="serial">Serial No: <?php echo $serial; ?></p>
        <a href="index.php" class="back">← Back to Home</a>
    </div>
</body>
</html>
