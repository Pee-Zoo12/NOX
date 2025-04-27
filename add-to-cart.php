<?php
session_start();

// CSRF protection
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Function to generate a unique product ID in cart
function generateProductId($product) {
    return md5($product['name'] . $product['size'] . $product['color']);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        http_response_code(403);
        echo json_encode(['error' => 'Invalid form submission']);
        exit;
    }
    
    // Validate required fields
    if (empty($_POST['name']) || !isset($_POST['price'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing required product information']);
        exit;
    }
    
    // Create product array with sanitized input
    $product = [
        'name' => htmlspecialchars($_POST['name'] ?? 'Unknown Product'),
        'price' => floatval($_POST['price'] ?? 0),
        'image' => htmlspecialchars($_POST['image'] ?? 'img/default.jpg'),
        'size' => htmlspecialchars($_POST['size'] ?? 'M'),
        'color' => htmlspecialchars($_POST['color'] ?? 'black'),
        'quantity' => max(1, intval($_POST['quantity'] ?? 1)), // Ensure quantity is at least 1
        'product_id' => '', // Will be set below
    ];
    
    // Generate a unique product ID
    $product['product_id'] = generateProductId($product);
    
    // Check if product already exists in cart (same product, size and color)
    $existingProductIndex = -1;
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['product_id'] === $product['product_id']) {
            $existingProductIndex = $index;
            break;
        }
    }
    
    // If product exists, update quantity instead of adding new item
    if ($existingProductIndex >= 0) {
        $_SESSION['cart'][$existingProductIndex]['quantity'] += $product['quantity'];
        $_SESSION['cart_message'] = 'Product quantity updated in cart!';
    } else {
        // Add new product to cart
        $_SESSION['cart'][] = $product;
        $_SESSION['cart_message'] = 'Product added to cart!';
    }
    
    // Return JSON if AJAX request
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
        echo json_encode([
            'success' => true,
            'message' => $_SESSION['cart_message'],
            'cart_count' => count($_SESSION['cart'])
        ]);
        exit;
    }
    
    // Otherwise redirect to cart page
    header("Location: cart.php");
    exit;
} else {
    // If not POST request
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method']);
    exit;
}