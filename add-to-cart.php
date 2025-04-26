<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product = [
        'name' => $_POST['name'] ?? 'Unknown Product',
        'price' => floatval($_POST['price'] ?? 0),
        'image' => $_POST['image'] ?? 'img/default.jpg',
        'size' => $_POST['size'] ?? 'M',
        'color' => $_POST['color'] ?? 'black',
        'quantity' => intval($_POST['quantity'] ?? 1),
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = $product;

    header("Location: cart.php");
    exit;
} else {
    echo "Invalid request.";
}
