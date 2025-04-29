<?php session_start(); // Start session at the VERY TOP ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nox Apparel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>

<header class="navbar">
    <div class="logo">
        <img src="img/noxlogo.png" alt="Nox Apparel Logo" class="logo-img">
        <span>Nox Apparel</span>
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="collection.php">Collections</a></li>
            <li><a href="contact.php">Contact</a></li>
            
            <?php if (isset($_SESSION['username'])): ?>
                <!-- If logged in, show user icon + username with link to signup.php -->
                <li>
                    <a href="signup.php" class="user-info">
                        <i class="fas fa-user"></i>
                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </a>
                </li>
            <?php else: ?>
                <!-- If not logged in, show Sign In button -->
                <li><a href="signup.php" class="btn">Sign In</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>