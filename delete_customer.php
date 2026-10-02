<?php
require_once 'config/database.php';
require_once 'includes/auth.php';
require_login();

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM customers WHERE id = ?");
    $stmt->execute([$id]);
    
    header("Location: dashboard.php?success=deleted");
    exit;
}

header("Location: dashboard.php");
exit;
?>