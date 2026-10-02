<?php
require_once 'config/database.php';
require_once 'includes/auth.php';
require_login();

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    header("Location: dashboard.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM customers WHERE id = ?");
$stmt->execute([$id]);
$customer = $stmt->fetch();

if (!$customer) {
    header("Location: dashboard.php");
    exit;
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
        <h1 class="page-title" style="margin-bottom: 1.5rem;">Customer Details</h1>

        <div class="detail-card">
            <div class="detail-header">
                <div class="avatar-circle">👤</div>
                <div>
                    <h3 style="font-size: 1.15rem; font-weight: 600;"><?= htmlspecialchars($customer['full_name']) ?></h3>
                    <span style="font-size: 0.85rem; color: var(--text-muted); background: var(--bg-light); padding: 0.2rem 0.5rem; border-radius: 4px; display: inline-block; margin-top: 0.25rem;">Customer ID: <?= $customer['id'] ?></span>
                </div>
            </div>
            <div class="detail-body">
                <div class="detail-item">
                    <div class="detail-label">Email</div>
                    <div class="detail-value"><?= htmlspecialchars($customer['email']) ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Phone</div>
                    <div class="detail-value"><?= htmlspecialchars($customer['phone']) ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Address</div>
                    <div class="detail-value"><?= htmlspecialchars($customer['address']) ?></div>
                </div>
            </div>
            <div class="detail-footer">
                <a href="dashboard.php" class="btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">← Back to List</a>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>