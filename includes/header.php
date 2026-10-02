<?php
require_once __DIR__ . '/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management System</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="app-container">
        <!-- Mobile Header Navigation Toggle -->
        <div class="mobile-header">
            <button id="mobile-toggle" class="mobile-toggle-btn" aria-label="Toggle navigation">☰</button>
            <span class="mobile-title">Customer System</span>
            <span class="mobile-user"><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>
        </div>