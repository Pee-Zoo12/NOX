<?php include('header.php'); ?>

<section class="signup-page">
    <div class="container">
        <h1 class="page-title">Join NOX Apparel</h1>

        <!-- User Signup Form -->
        <div class="form-section">
            <h2>Create an Account</h2>
            <form action="process_signup.php" method="POST" class="form">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required placeholder="Enter your username">
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required placeholder="Enter your password">
                </div>

                <button type="submit" class="btn">Sign Up</button>
            </form>
        </div>

        <!-- Reseller Application Form -->
        <div class="form-section">
            <h2>Apply as a Reseller</h2>
            <form action="process_reseller.php" method="POST" class="form">
                <div class="form-group">
                    <label for="reseller-name">Full Name:</label>
                    <input type="text" id="reseller-name" name="reseller_name" required placeholder="Enter your full name">
                </div>

                <div class="form-group">
                    <label for="reseller-email">Email Address:</label>
                    <input type="email" id="reseller-email" name="reseller_email" required placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="reseller-contact">Contact Number:</label>
                    <input type="text" id="reseller-contact" name="reseller_contact" required placeholder="Enter your contact number">
                </div>

                <div class="form-group">
                    <label for="reseller-message">Why do you want to become a reseller?</label>
                    <textarea id="reseller-message" name="reseller_message" rows="4" required placeholder="Tell us about your plans..."></textarea>
                </div>

                <button type="submit" class="btn">Submit Application</button>
            </form>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>
