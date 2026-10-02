<?php
require_once 'config/database.php';
require_once 'includes/auth.php';
require_login();

$errors = [];
$full_name = '';
$email = '';
$phone = '';
$address = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');

    if (empty($full_name) || empty($email) || empty($phone) || empty($address)) {
        $errors[] = "All fields are required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (strlen($phone) < 7 || strlen($phone) > 25) {
        $errors[] = "Phone number must be between 7 and 25 characters.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO customers (full_name, email, phone, address) VALUES (?, ?, ?, ?)");
        $stmt->execute([$full_name, $email, $phone, $address]);
        
        header("Location: dashboard.php?success=added");
        exit;
    }
}

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="main-content">
    <header class="top-navbar">
        <div class="user-profile">
            <span>👤</span>
            <span><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>
        </div>
    </header>

    <div class="content-body">
        <h1 class="page-title" style="margin-bottom: 1.5rem;">Add Customer</h1>

        <div class="form-card">
            <?php if (!empty($errors)): ?>
                <div class="alert alert-error">
                    <?php foreach ($errors as $err): ?>
                        <div><?= htmlspecialchars($err) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="add_customer.php" method="POST" id="customerForm">
                <div class="form-group">
                    <label class="form-label" for="full_name">Full Name *</label>
                    <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Enter full name" value="<?= htmlspecialchars($full_name) ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Email *</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter email address" value="<?= htmlspecialchars($email) ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="phone">Phone *</label>
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter phone number" value="<?= htmlspecialchars($phone) ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="address">Address *</label>
                    <input type="text" id="address" name="address" class="form-control" placeholder="Enter address" value="<?= htmlspecialchars($address) ?>" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="search-btn">Save Customer</button>
                    <a href="dashboard.php" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>