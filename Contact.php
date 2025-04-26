<?php 
$host = "localhost";
$user = "root";
$password = ""; // Change if you set a MySQL password
$dbname = "nox_apparel";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$imagePath = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["order_number"])) {
    $orderNumber = $conn->real_escape_string($_POST["order_number"]);
    $message = $conn->real_escape_string($_POST["message"]);

    if ($_FILES["review_image"]["error"] == 0) {
        $imageName = basename($_FILES["review_image"]["name"]);
        $targetDir = "uploads/";
        $targetFile = $targetDir . time() . "_" . $imageName;
        move_uploaded_file($_FILES["review_image"]["tmp_name"], $targetFile);
        $imagePath = $targetFile;
    }

    $sql = "INSERT INTO feedback (order_number, message, image_path) VALUES ('$orderNumber', '$message', '$imagePath')";
    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - Nox Apparel</title>
    <link rel="stylesheet" href="Contact.css">
</head>
<body>
<!-- Add your navbar and other sections here (unchanged) -->

<!-- Feedback Section -->
<section class="feedback-section">
    <h2>Report a Purchase Issue</h2>
    <form class="feedback-form" action="contact.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="order_number" placeholder="Order Number" required>
        <textarea name="message" placeholder="Describe your issue" required></textarea>
        <input type="file" name="review_image" accept="image/*">
        <button type="submit" class="btn">Submit Report</button>
    </form>

    <h3 style="margin-top: 30px;">Submitted Feedback</h3>
    <div class="feedback-display">
        <?php
        $result = $conn->query("SELECT * FROM feedback ORDER BY submitted_at DESC");
        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
            <div class="feedback-card">
                <strong>Order #<?php echo htmlspecialchars($row['order_number']); ?></strong>
                <p><?php echo nl2br(htmlspecialchars($row['message'])); ?></p>
                <?php if ($row['image_path']): ?>
                    <img src="<?php echo $row['image_path']; ?>" alt="Feedback Image" width="150">
                <?php endif; ?>
                <small>Submitted at: <?php echo $row['submitted_at']; ?></small>
            </div>
        <?php endwhile; else: ?>
            <p>No feedback submitted yet.</p>
        <?php endif; ?>
    </div>
</section>

</body>
</html>
