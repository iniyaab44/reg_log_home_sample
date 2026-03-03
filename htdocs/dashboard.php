<?php
require_once 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get user data from database
$stmt = $pdo->prepare("SELECT name, username, email, created_at FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<?php include 'includes/header.php'; ?>

<div class="dashboard">
    <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
    <p>You have successfully logged in.</p>

    <div class="user-info">
        <h2>Your Information</h2>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Member since:</strong> <?php echo date('F j, Y', strtotime($user['created_at'])); ?></p>
    </div>

    <a href="logout.php" class="btn">Logout</a>
</div>

<?php include 'includes/footer.php'; ?>