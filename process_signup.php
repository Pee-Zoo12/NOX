                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
<?php
session_start(); // Start the session

// Collecting data from the signup form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming form data was sent via POST method
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Here we should usually validate and sanitize user input to avoid security risks (e.g., XSS, SQL injection)
    // We're assuming simple username and password handling for now.

    // Simulating successful signup and saving username in session
    $_SESSION['username'] = $username; // Store username in session

    // Redirect to the homepage (or wherever you want)
    header("Location: index.php"); // Redirect after signup
    exit(); // Make sure no further code runs after the redirect
} else {
    // If the request method is not POST, send the user back to the signup page
    header("Location: signup.php");
    exit();
}
?>