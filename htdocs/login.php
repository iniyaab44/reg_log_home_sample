<?php
require_once 'config/database.php';

$error = '';
$success = '';

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

// Check if redirected from registration
if (isset($_GET['registered'])) {
    $success = 'Registration successful! Please login.';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = trim($_POST['login']); // Can be username or email
    $password = $_POST['password'];

    if (empty($login) || empty($password)) {
        $error = 'Please enter username/email and password';
    } else {
        // Check if user exists (by username or email)
        $stmt = $pdo->prepare("SELECT id, name, username, email, password FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$login, $login]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_username'] = $user['username'];
            
            header('Location: dashboard.php');
            exit();
        } else {
            $error = 'Invalid username/email or password';
        }
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="form-container">
    <h2>Login</h2>
    
    <?php if($error): ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>

    <form method="POST" action="" class="form">
        <div class="form-group">
            <label for="login">Username or Email:</label>
            <input type="text" id="login" name="login" required 
                   value="<?php echo isset($_POST['login']) ? htmlspecialchars($_POST['login']) : ''; ?>">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" class="btn">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>

<?php include 'includes/footer.php'; ?>