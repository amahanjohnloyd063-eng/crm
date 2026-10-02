<?php
require_once 'config/database.php';
require_once 'includes/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Customer Management System</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="login-body">
        <div class="login-banner">
            <h1>Customer Management<br>System</h1>
            <p>Manage your customers easily and efficiently.</p>
            <div class="login-banner-illustration">👥</div>
        </div>
        <div class="login-form-container">
            <div class="login-card">
                <h2>Welcome Back!</h2>
                <p>Please log in to continue.</p>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                            <button type="button" id="togglePassword" class="password-toggle">👁️</button>
                        </div>
                    </div>
                    <button type="submit" class="search-btn" style="width: 100%; justify-content: center; padding: 0.75rem;">Log In</button>
                </form>

                <div class="demo-credentials">
                    <strong>Default Account (for setup testing):</strong><br>
                    Username: <code>admin</code><br>
                    Password: <code>admin</code>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>