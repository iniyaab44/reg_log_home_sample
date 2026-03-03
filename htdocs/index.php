<?php require_once 'config/database.php'; ?>
<?php include 'includes/header.php'; ?>

<div class="home">
    <h1>Welcome to Our Website</h1>
    
    <?php if(isset($_SESSION['user_id'])): ?>
        <p>Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?>! You are logged in.</p>
        <p><a href="dashboard.php" class="btn">Go to Dashboard</a></p>
    <?php else: ?>
        <p>Please login or register to access your account.</p>
        <div class="cta-buttons">
            <a href="register.php" class="btn">Register</a>
            <a href="login.php" class="btn">Login</a>   
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>