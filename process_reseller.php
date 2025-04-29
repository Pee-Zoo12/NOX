<?php
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $reseller_name = isset($_POST['reseller_name']) ? $_POST['reseller_name'] : '';
    $reseller_email = isset($_POST['reseller_email']) ? $_POST['reseller_email'] : '';
    $reseller_contact = isset($_POST['reseller_contact']) ? $_POST['reseller_contact'] : '';
    $reseller_message = isset($_POST['reseller_message']) ? $_POST['reseller_message'] : '';
    
    // Validate required fields (you could add more validation)
    if (empty($reseller_name) || empty($reseller_email) || empty($reseller_contact) || empty($reseller_message)) {
        $_SESSION['reseller_error'] = "All fields are required. Please fill in all information.";
        header("Location: signup.php");
        exit();
    }
    
    // Process the reseller application (here you would typically save to database)
    // This is where you'd add code to save the application data
    
    // Set success message
    $_SESSION['reseller_success'] = "Thank you for your interest in becoming a reseller! We will review your application and contact you via email at {$reseller_email}.";
    
    // Redirect back to the signup page
    header("Location: signup.php");
    exit();
}
else {
    // If someone tries to access this file directly without submitting the form
    header("Location: signup.php");
    exit();
}
?>